<?php

namespace app\modules\control\modules\users\models\forms;

use app\common\models\User;
use app\common\services\RbacService;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserCreateForm extends Model
{
    public $username;
    public $password;
    public $status;
    public $roles;
    public $permissions;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'password', 'roles', 'status'], 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
            [['roles', 'permissions'], 'safe'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'status' => 'Статус',
            'roles' => 'Роль',
            'permissions' => 'Разрешения',
        ];
    }

    /**
     * @return array|string[]
     */
    public function getRolesList()
    {
        $permissions = \Yii::$app->getAuthManager()->getRoles();

        return ArrayHelper::map($permissions, 'name', 'description');
    }

    /**
     * @return array|string[]
     */
    public function getPermissionsList()
    {
        $permissions = \Yii::$app->getAuthManager()->getPermissions();

        return ArrayHelper::map($permissions,'name', 'description');
    }

    /**
     * @return string[]
     */
    public function getStatuses(): array
    {
        return [
            User::STATUS_ACTIVE => 'Активен',
            User::STATUS_INACTIVE => 'Заблокирован',
        ];
    }

    /**
     * @return bool
     */
    public function create()
    {
        if (!$this->validate()) {
            return false;
        }

        $transaction = \Yii::$app->db->beginTransaction();

        try {
            $user = new User();
            $user->username = $this->username;
            $user->status = User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            $user->access_token = $user->generateAccessToken();

            if ($user->save()) {
                $roleAssigned = RbacService::assignRolesList($user->id, $this->roles);
                $permissionsAssigned = RbacService::assignPermissionList($user->id, $this->getPermissions());

                if (!$roleAssigned || !$permissionsAssigned) {
                    $this->addError('username', 'Ошибка при назначении роли или разрешений');
                    $transaction->rollBack();

                    return false;
                }

                $transaction->commit();

                return true;
            }
            $this->addError('username', 'Ошибка создания пользователя');
            $transaction->rollBack();

            return false;

        } catch (\Throwable $e) {
            $transaction->rollBack();
            $this->addError('username', $e->getMessage());

            return false;
        }
    }

    /**
     * @return null|array
     */
    protected function getPermissions(): ?array
    {
        if (empty($this->permissions)) {
            return null;
        }

        return $this->permissions;
    }

}
