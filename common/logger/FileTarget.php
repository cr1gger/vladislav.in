<?php

namespace app\common\logger;

use DateTimeZone;
use samdark\log\PsrTarget;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;
use yii\log\Logger;
use yii\log\LogRuntimeException;
use yii\log\Target;
use yii\web\Request;

/**
 * @deprecated
 */
class FileTarget extends \yii\log\FileTarget
{
    public function init()
    {
        $fileName = Yii::$app->getRuntimePath() . '/logs/' . date('Y-m-d') . '.log';

        if ($this->logFile === null) {
            $this->logFile = $fileName;
        } else {
            $this->logFile = Yii::getAlias($this->logFile);
        }
        if ($this->maxLogFiles < 1) {
            $this->maxLogFiles = 1;
        }
        if ($this->maxFileSize < 1) {
            $this->maxFileSize = 1;
        }
    }

    public function export()
    {
        $text = implode("\n", array_map([$this, 'formatMessage'], $this->messages)) . "\n";
        $trimmedText = trim($text);

        if (empty($trimmedText)) {
            return; // No messages to export, so we exit the function early
        }

        if (strpos($this->logFile, '://') === false || strncmp($this->logFile, 'file://', 7) === 0) {
            $logPath = dirname($this->logFile);
            FileHelper::createDirectory($logPath, $this->dirMode, true);
        }

        if (($fp = @fopen($this->logFile, 'a')) === false) {
            throw new InvalidConfigException("Unable to append to log file: {$this->logFile}");
        }
        @flock($fp, LOCK_EX);
        if ($this->enableRotation) {
            // clear stat cache to ensure getting the real current file size and not a cached one
            // this may result in rotating twice when cached file size is used on subsequent calls
            clearstatcache();
        }
        if ($this->enableRotation && @filesize($this->logFile) > $this->maxFileSize * 1024) {
            $this->rotateFiles();
        }
        $writeResult = @fwrite($fp, $trimmedText);
        if ($writeResult === false) {
            $error = error_get_last();
            throw new LogRuntimeException("Unable to export log through file ({$this->logFile})!: {$error['message']}");
        }
        $textSize = strlen($trimmedText);
        if ($writeResult < $textSize) {
            throw new LogRuntimeException("Unable to export whole log through file ({$this->logFile})! Wrote $writeResult out of $textSize bytes.");
        }
        @fflush($fp);
        @flock($fp, LOCK_UN);
        @fclose($fp);

        if ($this->fileMode !== null) {
            @chmod($this->logFile, $this->fileMode);
        }
    }

    public function formatMessage($message)
    {
        [$text, $level, $category, $timestamp] = $message;
        $level = Logger::getLevelName($level);

        if (!is_string($text) && !is_array($text)) {
            if ($text instanceof \Throwable) {
                $text = (string) $text;
            } else {
                $text = VarDumper::export($text);
            }
        }

        $traces = [];
        if (isset($message[4])) {
            foreach ($message[4] as $trace) {
                $traces[$trace['file']] = $trace['line'];
            }
        }

        $request = Yii::$app->getRequest();
        $ip = $request instanceof Request ? $request->getUserIP() : '-';

        $user = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
        if ($user && ($identity = $user->getIdentity(false))) {
            $userID = $identity->getId();
        } else {
            $userID = '-';
        }

        $timestamp = intval($timestamp) ?: time();

        $arrayMessage = [
            'datetime' => date('Y-m-d H:i:s'),
            'message' => $text,
            'level' => $level,
            'category' => $category,
            'timestamp' => $timestamp,
            'traces' => $traces,
            'ip' => $ip,
            'userID' => $userID,
        ];

        return json_encode($arrayMessage);
    }
}