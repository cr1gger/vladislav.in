<?php

namespace app\modules\control\modules\passwordManager\models;

use app\common\models\User;
use Yii;

/**
 * This is the model class for table "pm_store".
 *
 * @property int $id
 * @property int $owner
 * @property int $category_id
 * @property string|null $resource
 * @property string|null $identifier
 * @property string|null $password_hash
 * @property string|null $password_open
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $owner0
 */
class PmStore extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pm_store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['owner', 'resource','identifier'], 'required'],
            [['owner'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['password_hash', 'password_open'], 'string', 'max' => 255],
            [['password_hash'], 'string'],
            [['owner'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['owner' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['owner' => 'id']],
//            [['passwordForDecrypt', 'passwordToEncrypt'], 'required', 'on' => self::SCENARIO_CRYPT_PASSWORD],
//            [['password_open'], 'required', 'on' => self::SCENARIO_CRYPT_OPEN],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'owner' => 'Владелец',
            'category_id' => 'Категория',
            'resource' => 'Ссылка/Имя ресурса',
            'identifier' => 'Логин/Email',
            'password_hash' => 'Зашифрованный пароль',
//            'passwordToEncrypt' => 'Пароль',
//            'passwordForDecrypt' => 'Ключ для дешифровки пароля',
            'password_open' => 'Не зашифрованный пароль',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Owner0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner0()
    {
        return $this->hasOne(User::class, ['id' => 'owner']);
    }

    public function getCategory()
    {
        return $this->hasOne(PmCategory::class, ['id' => 'category_id']);
    }


}
