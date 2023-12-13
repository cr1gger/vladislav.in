<?php

namespace app\common\dto;

use yii\base\BaseObject;

class CreateUserDto extends BaseObject
{
    public string $username;
    public string $password;
    public string $role;
    public ?array $permissions;
    public int $status;
}
