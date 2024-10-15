<?php

namespace app\modules\control\base;

use Yii;
use yii\rest\Controller;
use yii\rest\OptionsAction;

abstract class AbstractApiController extends Controller
{
    public function actions()
    {
        return [
            'options' => OptionsAction::class,
        ];
    }

    /**
     * @return array[]
     */
    public function behaviors() {
        return [
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::class,
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
                'cors' => [
                    'Origin' => [
                        '*',
                    ],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => false,
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Max-Age' => 3600 * 5,
                ],
            ]
        ];
    }
}
