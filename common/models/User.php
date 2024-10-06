<?php

namespace app\common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $status
 * @property string $access_token
 * @property string $auth_key
 * @property string $created_at
 * @property string $updated_at
 * @property string $last_login
 * @method TimestampBehavior touch($attribute)
 */
class User extends ActiveRecord implements IdentityInterface
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['status'], 'integer'],
            [['access_token', 'auth_key'], 'string'],
            [['created_at', 'updated_at', 'last_login'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'status' => 'Статус',
            'access_token' => 'Access Token',
            'auth_key' => 'Auth Key',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'last_login' => 'Дата последнего входа',
        ];
    }

    /**
     * @param $id
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id): ?User
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
            ->andWhere(['access_token' => $token])
            ->one();

    }

    /**
     * @return int|mixed|string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed|string|null
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername(string $username): ?self
    {
        return self::find()->where(['username' => $username])->one();
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password): void
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * todo: вынести в user service
     * @return string
     */
    public function generateAccessToken()
    {
        $head = json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]);

        $payload = json_encode([
            'expired_at' => time() + 60 * 60 * 24 * 7,
            'username' => $this->username,
        ]);

        $sign = hash_hmac(
            'sha256',
            sprintf('%s.%s', $head, $payload),
            $_ENV['USER_TOKEN_SECRET_KEY']
        );


        return sprintf('%s.%s.%s', base64_encode($head), base64_encode($payload), base64_encode($sign));
    }
}
