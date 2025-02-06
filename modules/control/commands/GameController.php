<?php

namespace app\modules\control\commands;

use app\modules\control\commands\Game\Config;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use aki\telegram\Telegram;

class GameController extends Controller
{
    public $sleep = 0;
    public Telegram $telegram;

    public function init()
    {
        parent::init();
        $this->telegram = Yii::$app->telegram;
    }

    public function actionStart()
    {
        $this->sendTgMessage('Запущено!');
        $this->checkEnv();

        while (true) {
            $config = $this->getConfig();

            if (!$config->isEnabled()) {
                continue;
            }

            if (!$this->getIsSleep()) {
                Console::output('Собираем звезды!');
                $this->collect($config);
                $this->enableSleep();
            } else {
                Console::output(sprintf('Ожидание: %s сек.', $this->sleep));
            }

            sleep(1);
        }
    }


    public function getConfig(): Config
    {
        if (!file_exists('game_config.txt')) {
            file_put_contents('game_config.txt', serialize(new Config()));
        }

        $configTxt = file_get_contents('game_config.txt');

        return unserialize($configTxt);
    }

    public function setConfig(Config $config)
    {
        file_put_contents('game_config.txt', serialize($config));
    }


    private function enableSleep()
    {
        $sleepSec = 3600 - rand(100, 800);

        $this->sleep = $sleepSec;

        $this->sendTgMessage(sprintf('Следующий сбор через: %s', $this->sleep));
    }

    private function getIsSleep()
    {
        if ($this->sleep <= 0) {
            return false;
        }

        $this->sleep--;

        return true;
    }

    private function collect(Config $config): void
    {
        $headerClientTime = sprintf('X-Client-Time-Diff: %s-0', time());
        $version = sprintf('X-Application-Version: %s', $config->getVersion());

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.tonverse.app/galaxy/collect');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: */*',
            'Accept-Language: ru,en;q=0.9',
            'Cache-Control: no-cache',
            'Connection: keep-alive',
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
            'Origin: https://app.tonverse.app',
            'Pragma: no-cache',
            'Referer: https://app.tonverse.app/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 YaBrowser/24.12.0.0 Safari/537.36',
            $version,
            'X-Requested-With: XMLHttpRequest',
            $headerClientTime,
            'sec-ch-ua: "Chromium";v="130", "YaBrowser";v="24.12", "Not?A_Brand";v="99", "Yowser";v="2.5"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
        ]);

        $sessionId = getenv('GAME_SESSION_ID');

        curl_setopt($ch, CURLOPT_POSTFIELDS, sprintf('session=%s', $sessionId));

        $response = curl_exec($ch);

        $this->sendTgMessage($response);

        curl_close($ch);
    }

    private function sendTgMessage($message)
    {
        $botId = env('GAME_TG_BOT_ID');
        $chatId = env('GAME_TG_CHAT_ID');

        file_get_contents(sprintf(
                'https://api.telegram.org/bot%s/sendMessage?chat_id=%s&text=%s',
                $botId, $chatId, $message
            )
        );
    }

    private function checkEnv()
    {
        $botId = env('GAME_TG_BOT_ID');
        $chatId = env('GAME_TG_CHAT_ID');
        $sessionId = getenv('GAME_SESSION_ID');

        dump($botId, $chatId, $sessionId);

        if (!$botId || !$chatId || !$sessionId) {
            throw new \Exception('Не установлены обязательные переменные!');
        }
    }

    public function actionLongPoll()
    {
        $lastUpdateId = 0;

        while (true) {
            try {
                $updates = $this->telegram->getUpdates(['offset' => $lastUpdateId + 1]);
                if (!empty($updates['result'])) {
                    $results = $updates['result'];
                    foreach ($results as $result) {
                        $updateId = $result['update_id'];
                        $chatId = $result['message']['chat']['id'] ?? null;

                        if (is_null($chatId)) {
                            continue;
                        }

                        $message = $result['message']['text'] ?? '';
                        $this->execCommand($message, $chatId);
                        $lastUpdateId = $updateId;
                    }
                }
            } catch (\Exception $e) {
                $this->telegram->sendMessage([
                    'chat_id' => '304760316',
                    'text' => sprintf("Я упал: %s\n%s", $e->getMessage(), $e->getTraceAsString())
                ]);
                break;
            }

            sleep(1);
        }
    }

    public function execCommand($message, $chatId)
    {
        $data = explode(' ', $message, 2);
        $command = $data[0] ?? null;
        $args = $data[1] ?? null;

        switch ($command) {
            case '/enable':
                $config = $this->getConfig();
                $config->setIsEnabled(true);
                $this->setConfig($config);
                $this->telegram->sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Бот включен!'
                ]);
                break;
            case '/disable':
                $config = $this->getConfig();
                $config->setIsEnabled(false);
                $this->setConfig($config);
                $this->telegram->sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Бот выключен!'
                ]);
                break;
            case '/setversion':
                if (empty($args)) {
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Укажи версию!'
                    ]);
                    break;
                }
                $config = $this->getConfig();
                $config->setVersion($args);
                $this->setConfig($config);
                $this->telegram->sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Версия изменена!'
                ]);
                break;
            case '/collect':
                $this->collect($this->getConfig());
                break;
            case '/config':
                $this->telegram->sendMessage([
                    'chat_id' => $chatId,
                    'text' => $this->getConfig()->toString()
                ]);
                break;
            default:
                $this->telegram->sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Неизвестная команда'
                ]);
        }
    }


}
