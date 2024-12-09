<?php

namespace app\modules\control\commands;

use yii\helpers\Console;

class GameController
{
    public $sleep = 0;

    public function actionStart()
    {
        while (true) {
            if (!$this->getIsSleep()) {
                Console::output('Собираем звезды!');
                $this->collect();
                $this->enableSleep();
            } else {
                Console::output(sprintf('Ожидание: %s сек.', $this->sleep));
            }

            sleep(1);
        }
    }

    private function enableSleep()
    {
        $sleepSec = 3600 - rand(100, 800);

        $this->sleep = $sleepSec;
    }

    private function getIsSleep()
    {
        if ($this->sleep <= 0) {
            return false;
        }

        $this->sleep--;

        return true;
    }

    private function collect()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.tonverse.app/galaxy/collect');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: */*',
            'Accept-Language: ru,en;q=0.9',
            'Connection: keep-alive',
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
            'Origin: https://app.tonverse.app',
            'Referer: https://app.tonverse.app/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 YaBrowser/24.10.0.0 Safari/537.36',
            'X-Application-Version: 0.6.30',
            'X-Requested-With: XMLHttpRequest',
            'sec-ch-ua: "Chromium";v="128", "Not;A=Brand";v="24", "YaBrowser";v="24.10", "Yowser";v="2.5"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
        ]);

        $sessionId = getenv('GAME_SESSION_ID');

        curl_setopt($ch, CURLOPT_POSTFIELDS, sprintf('session=%s', $sessionId));

        $response = curl_exec($ch);

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

}