<?php

namespace app\modules\control\helpers;

use Yii;

final class ControlHelper
{
    /**
     * @return bool
     */
    public static function isApiRequest()
    {
        if (!Yii::$app->controller) {
            return false;
        }

        return (Yii::$app->controller->id === 'api' && Yii::$app->controller->action->id === 'index');
    }

    /**
     * @param $app
     * @return bool
     */
    public static function isConsoleApp($app = null): bool
    {
        if (!$app) {
            $app = Yii::$app;
        }

        return ($app instanceof \yii\console\Application);
    }

    /**
     * @param $app
     * @return bool
     */
    public static function isWebApp($app = null): bool
    {
        if (!$app) {
            $app = Yii::$app;
        }

        return ($app instanceof \yii\web\Application);
    }
}