<?php

namespace app\modules\control\components;

use Yii;
use yii\web\JsExpression;

class Toast
{
    private const TEXT_KEY = 'control.toast.text';
    private const ICON_KEY = 'control.toast.icon';

    /**
     *
     */
    public function __construct()
    {
        $this->render();
    }

    /**
     * @param $text
     * @return void
     */
    public static function success($text)
    {
        self::writeCookie($text, 'success');
    }

    /**
     * @param $text
     * @return void
     */
    public static function error($text)
    {
        self::writeCookie($text, 'error');
    }

    /**
     * @param $text
     * @return void
     */
    public static function warning($text)
    {
        self::writeCookie($text, 'warning');
    }

    /**
     * @param $text
     * @return void
     */
    public static function info($text)
    {
        self::writeCookie($text, 'info');
    }

    /**
     * @param $text
     * @param $icon
     * @return void
     */
    private static function writeCookie($text, $icon)
    {
        Yii::$app->session->setFlash(self::TEXT_KEY, $text);
        Yii::$app->session->setFlash(self::ICON_KEY, $icon);
    }

    /**
     * @return void
     */
    private function render()
    {
        $text = Yii::$app->session->getFlash(self::TEXT_KEY);
        $icon = Yii::$app->session->getFlash(self::ICON_KEY, 'success');

        if (!$text) {
            return;
        }

        $expression = new JsExpression("
            <script>
            (() => {
                Toast.fire({
                    icon: '{$icon}',
                    title: '{$text}'
                })
            })();
            </script>
        ");

        echo $expression;
    }
}
