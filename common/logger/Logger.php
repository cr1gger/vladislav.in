<?php

namespace app\common\logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Yii;

class Logger implements LoggerInterface
{
    public function log($level, $message, array $context = array())
    {
        Yii::getLogger()->log($message, $level, $context['category'] ?? 'default');
    }

    public function emergency($message, array $context = array())
    {
        $this->customLog($message, $context, LogLevel::EMERGENCY);
    }

    public function alert($message, array $context = array())
    {
        $this->customLog($message, $context, LogLevel::ALERT);
    }

    public function critical($message, array $context = array())
    {
        $this->customLog($message, $context, LogLevel::CRITICAL);
    }

    public function error($message, array $context = array())
    {
        $this->customLog($message, $context, \yii\log\Logger::LEVEL_ERROR);
    }

    public function warning($message, array $context = array())
    {
        $this->customLog($message, $context, \yii\log\Logger::LEVEL_WARNING);
    }

    public function notice($message, array $context = array())
    {
        $this->customLog($message, $context, LogLevel::NOTICE);
    }

    public function info($message, array $context = array())
    {
        $this->customLog($message, $context, \yii\log\Logger::LEVEL_INFO);
    }

    public function debug($message, array $context = array())
    {
        $this->customLog($message, $context, \yii\log\Logger::LEVEL_TRACE);
    }

    public function customLog($message, $context, $level) {
        $context['message'] = $message;
        $category = $context['category'] ?? 'default';


        $context['category'] = sprintf('app\%s', $category);

        $this->log($level, $message, $context);
    }


}