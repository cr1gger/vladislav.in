<?php

namespace app\modules\control\base;

use yii\filters\auth\HttpBearerAuth;

abstract class AuthApiController extends AbstractApiController
{
    /**
     * @return array[]
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }
}