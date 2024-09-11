<?php

namespace app\modules\control\modules\spygame\api\controllers;

use app\modules\control\modules\spygame\models\Category;
use app\modules\control\modules\spygame\models\Word;
use yii\filters\Cors;

class DataController extends \app\modules\control\base\AuthApiController
{
    public function actions()
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Allow-Origin' => ['*'],
                    'Access-Control-Request-Method' => ['POST', 'GET'],
                ],

            ],
        ]);
    }

    /**
     * @return void
     */
    public function actionWords()
    {
        return Word::find()
            ->select(['name', 'category_id'])
            ->all();
    }

    public function actionCategories()
    {
        $categoryIds = Word::find()
            ->select(['category_id'])
            ->distinct()
            ->column();

        return Category::find()
            ->select(['id', 'name'])
            ->where(['id' => $categoryIds])
            ->all();
    }
}
