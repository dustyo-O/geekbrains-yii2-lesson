<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%aneks}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $text
 * @property string $image
 * @property string $publish_time
 *
 * @property User $user
 */
class Aneks extends \yii\db\ActiveRecord
{
    const IMAGE_DIR = '../../frontend/web/images/';
    const IMAGE_PATH = '/images/';

    const NO_CATEGORY = 'Без категории';

    const MODE_BOTH = 10;
    const MODE_IMAGE = 20;
    const MODE_TEXT = 30;


    public static $categories = [
        [
            'id' => 10,
            'title' => 'Теща'
        ],
        [
            'id' => 20,
            'title' => 'Вовочка'
        ],
        [
            'id' => 30,
            'title' => 'Пошлые'
        ],
        [
            'id' => 40,
            'title' => 'Программистские'
        ]
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%aneks}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'category_id'], 'integer'],
            [['text'], 'string'],
            [['image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getImageDir()
    {
        if (!is_dir(self::IMAGE_DIR))
        {
            mkdir(self::IMAGE_DIR);
        }

        return self::IMAGE_DIR;
    }

    public function getCategory()
    {
        foreach (static::$categories as $cat)
        {
            if ((int)$cat['id'] === $this->category_id)
            {
                return $cat['title'];
            }
        }

        return self::NO_CATEGORY;
    }

    public function getContent()
    {
        $result = new \stdClass();

        if ($this->image)
        {
            $result->image = $this->image;
            $result->mode = self::MODE_IMAGE;
        }
        if ($this->text)
        {
            $result->text = $this->text;
            $result->mode = self::MODE_TEXT;
        }

        if ($this->image && $this->text)
        {
            $result->mode = self::MODE_BOTH;
        }

        return $result;
    }

}
