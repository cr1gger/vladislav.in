<?php

namespace app\modules\control\modules\users\models;

class User extends \app\common\models\User
{

    /**
     * @return array
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        $labels['statusName'] = 'Статус пользователя';

        return $labels;
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return $this->status == self::STATUS_ACTIVE ? 'Активен' : 'Заблокирован';
    }
}
