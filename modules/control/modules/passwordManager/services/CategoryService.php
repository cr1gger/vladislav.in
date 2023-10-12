<?php

namespace app\modules\control\modules\passwordManager\services;


use app\modules\control\modules\passwordManager\models\PmCategory;
use yii\base\StaticInstanceInterface;
use yii\base\StaticInstanceTrait;

class CategoryService implements StaticInstanceInterface
{
    use StaticInstanceTrait;

    /**
     * @param int $userId
     * @return array
     */
    public function getCategoryByUser(int $userId): array
    {
        return PmCategory::find()
            ->where(['owner' => $userId])
            ->all();
    }

    /**
     * @param int $userId
     * @return array
     */
    public function getUserCategoryListNames(int $userId): array
    {
        return PmCategory::find()
            ->select('name')
            ->where(['owner' => $userId])
            ->indexBy('name')
            ->column();
    }

    public function getCategory(string $name, int $userId): PmCategory
    {
        $category = PmCategory::find()
            ->where(['name' => $name])
            ->andWhere(['owner' => $userId])
            ->one();
        if (!$category) {
            $category = new PmCategory();
            $category->name = $name;
            $category->owner = $userId;
            $category->save();
        }

        return $category;
    }


}
