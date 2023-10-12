<?php

namespace app\modules\control\modules\passwordManager\models\forms;

use app\modules\control\modules\passwordManager\models\PmStore;
use app\modules\control\modules\passwordManager\services\CategoryService;
use Yii;

class CreatePmStoreForm extends \yii\base\Model
{
    public ?string $categoryName = null;
    public ?string $resource = null;
    public ?string $identifier = null;
    public ?string $isCryptPassword = null;
    public ?string $password = null;
    public ?PmStore $model;

    public function rules()
    {
        return [
            [['categoryName', 'resource', 'identifier', 'password'], 'required'],
            [['categoryName', 'resource', 'identifier', 'isCryptPassword', 'password'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categoryName' => 'Категория',
            'resource' => 'Ссылка/Имя ресурса',
            'identifier' => 'Логин/Email',
            'password' => 'Пароль',
            'isCryptPassword' => 'Зашифровать пароль',
        ];
    }

    /**
     * @return bool
     */
    public function isEncrypt(): bool
    {
        return $this->isCryptPassword === 'on';
    }

    public function create()
    {
        $category = CategoryService::instance()->getCategory($this->categoryName, Yii::$app->user->identity->id);

        $this->model = new PmStore();
        $this->model->owner = Yii::$app->user->identity->id;
        $this->model->resource = $this->resource;
        $this->model->identifier = $this->identifier;
        $this->model->category_id = $category->id;

        if ($this->isEncrypt()) {
            $this->model->password_hash = $this->password;
            $this->model->password_open = null;
        } else {
            $this->model->password_open = $this->password;
            $this->model->password_hash = null;
        }

        return $this->model->save();
    }
}
