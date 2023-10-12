<?php

namespace app\modules\control\modules\passwordManager\models;

use app\common\models\User;
use Yii;

/**
 * This is the model class for table "pm_category".
 *
 * @property int $id
 * @property string $name
 * @property int $owner
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $owner0
 * @property PmStore[] $pmStores
 */
class PmCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pm_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'owner'], 'required'],
            [['owner'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['owner'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['owner' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'owner' => 'Owner',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

    /**
     * Gets query for [[PmStores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPmStores()
    {
        return $this->hasMany(PmStore::class, ['category_id' => 'id']);
    }

    public function getPasswordCount()
    {
        return $this->hasMany(PmStore::class, ['category_id' => 'id'])->count();
    }
}
