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

    const MODE_UNKNOWN = 0;
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

    public static $modes = [
        self::MODE_BOTH => "И текст и картинка",
        self::MODE_IMAGE => "Картинка",
        self::MODE_TEXT => "Текст",
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
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['user_id', 'category_id'], 'integer'],
            [['text'], 'string'],
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
            'user_id' => 'Пользователь',
            'category_id' => 'Категория',
            'text' => 'Текст анекдота',
            'image' => 'Картинка',
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

        $result->mode = self::MODE_UNKNOWN;

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


    /**
     * @param int $page
     * @param $filter \frontend\models\FilterForm
     * @return \yii\db\ActiveQuery
     */
    public static function getFeedQuery($page = 1, $filter = null)
    {
        $aneks_query = static::find()->leftJoin(User::tableName(), static::tableName().'.user_id = '.User::tableName().'.id')->with('user');

        //var_dump($filter);

        if ($filter)
        {

            $aneks_query->filterWhere([
                    'user_id' => $filter->user,
                    'category_id' => $filter->category_id
                ]
            );

            $mode_filter = [];

            if ($filter->mode)
            {
                if (in_array(Aneks::MODE_IMAGE, $filter->mode))
                {
                    $mode_filter[] = ['and',
                        ['text' => ''],
                        ['NOT', ['image' => NULL]]
                    ];

                }
                if (in_array(Aneks::MODE_TEXT, $filter->mode))
                {
                    $mode_filter[] = ['and',
                        ['!=', 'text', ''],
                        ['image' => NULL]
                    ];
                }
                if (in_array(Aneks::MODE_BOTH, $filter->mode))
                {
                    $mode_filter[] = ['and',
                        ['!=', 'text', ''],
                        ['NOT', ['image' => NULL]]
                    ];
                }

            }


            if (count($mode_filter))
            {
                array_unshift($mode_filter,'or');
            }

            $aneks_query->andWhere($mode_filter);

        }

        return $aneks_query;
    }

    public function getImage()
    {
        $image = AnekPicture::readPicture($this->image);
        if ($image)
        {
            return 'data:image/jpg;base64,'.base64_encode($image);
        }
        else
        {
            return null;
        }
    }

    /*public function beforeSave($insert)
    {
        if ($insert)
        {
            $this->user_id = Yii::$app->user->id;
        }
    }*/


}
