<?php

namespace app\modules\control\modules\users\models\forms;

use app\common\models\User;
use app\common\services\RbacService;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserUpdateForm extends Model
{
    public $username;
    public $password;
    public $status;
    public $roles;
    public $permissions;
    public $user;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'roles', 'status'], 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'username', 'when' => function ($model) {
                return $model->user->username != $model->username;
            }],
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

        return ArrayHelper::map($permissions, 'name', 'description');
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
    public function update()
    {
        if (!$this->validate()) {
            return false;
        }

        $transaction = \Yii::$app->db->beginTransaction();

        try {

            $user = $this->user;
            if ($user->username != $this->username) {
                $user->username = $this->username;
            }
            if (!empty($this->password)) {
                $user->setPassword($this->password);
            }

            if ($user->save()) {
                RbacService::removeAll($user->id);
                $rolesAssigned = RbacService::assignRolesList($user->id, $this->roles);
                $permissionsAssigned = RbacService::assignPermissionList($user->id, $this->permissions ?: []);

                if (!$rolesAssigned || !$permissionsAssigned) {
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

    public static function create(User $user)
    {
        return new self([
            'username' => $user->username,
            'password' => '',
            'status' => $user->status,
            'roles' => RbacService::getUserRolesList($user->id),
            'permissions' => RbacService::getUserPermissionList($user->id),
            'user' => $user,
        ]);
    }


}
