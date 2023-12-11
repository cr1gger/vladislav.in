<?php

namespace app\modules\control\models\forms;

use app\common\models\User;
use Yii;

class Login extends \yii\base\Model
{
    public $username;
    public $password;
    public $rememberMe;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],

        ];
    }

    /**
     * @param $attribute
     * @param $params
     * @return void
     */
    public function validatePassword($attribute, $params)
    {
        $user = User::findByUsername($this->username);
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Неправильный логин или пароль');
        }
    }

    public function authorize(): bool
    {
        if ($this->validate()) {
            $user = User::findByUsername($this->username);
            $isAuthorize = Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);

            if ($isAuthorize) {
                $user->touch('last_login');
            }

            return $isAuthorize;
        }

        return false;

    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }
}
