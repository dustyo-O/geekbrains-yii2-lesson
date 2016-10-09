<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%likes}}".
 *
 * @property integer $user_id
 * @property integer $anek_id
 *
 * @property Aneks $anek
 * @property User $user
 */
class Likes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%likes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'anek_id'], 'required'],
            [['user_id', 'anek_id'], 'integer'],
            [['anek_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aneks::className(), 'targetAttribute' => ['anek_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'anek_id' => 'Anek ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnek()
    {
        return $this->hasOne(Aneks::className(), ['id' => 'anek_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
