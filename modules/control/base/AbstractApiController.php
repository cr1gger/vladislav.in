<?php

namespace app\modules\control\base;

use Psr\Log\LoggerInterface;
use yii\rest\Controller;

abstract class AbstractApiController extends Controller
{
    /**
     * @return array[]
     */
    public function behaviors() {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::class,
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }
}
