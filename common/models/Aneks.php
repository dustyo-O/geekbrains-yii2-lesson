<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%aneks}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $is_visible
 * @property integer $category_id
 * @property string $text
 * @property string $image
 * @property string $publish_time
 *
 * @property User $user
 * @property Likes[] $likes
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

    const REPACK_ODD = 1;
    const REPACK_EVEN = 2;


    public static $categories = [
        10 => [
            'id' => 10,
            'title' => 'Теща'
        ],
        20 => [
            'id' => 20,
            'title' => 'Вовочка'
        ],
        30 => [
            'id' => 30,
            'title' => 'Пошлые'
        ],
        40 => [
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
//            [['user_id'], 'default', 'value' => Yii::$app->user ? Yii::$app->user->id : 1],
            [['user_id', 'category_id', 'is_visible'], 'integer'],
            [['is_visible'], 'default', 'value' => 0],
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
            'is_visible' => 'Видимость',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::className(), ['anek_id' => 'id']);
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
        $aneks_query = static::find()
            ->where(['is_visible' => 1])
            ->leftJoin(User::tableName(), static::tableName().'.user_id = '.User::tableName().'.id')
            ->leftJoin(Likes::tableName(), static::tableName().'.id = '.Likes::tableName().'.anek_id')
            ->groupBy(static::tableName().'.id')
            ->with('user')
            ->with('likes');

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


        $aneks_query->offset(($page-1) * Yii::$app->params['aneks_per_page'])->limit(Yii::$app->params['aneks_per_page']);

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

    /**
     * Определяем, ставил ли текущий пользователь лайк
     * @param null|int $user_id ID пользователя - если не указано, то текущий пользователь
     * @return bool|null статус - лайкал или нет, или null, если текущий юзер гость при поиске для текущего
     */
    public function userLikes($user_id = null)
    {
        if ($user_id === null)
        {
            if (Yii::$app->user->isGuest) return null; // Гость не лайкает
            $user_id = \Yii::$app->user->id;
        }

        foreach ($this->likes as $like)
        {
            if ($user_id === $like->user_id) return true;
        }

        return false;
    }

    /**
     * Удаление лайков перед удалением анекдота
     * @return bool
     */
    public function beforeDelete()
    {

        Likes::deleteAll(['anek_id' => $this->id]);

        return parent::beforeDelete();

    }

  /*  public function afterSave($insert, $changed)
    {
        if ($insert)
        {
            $this->id;
        }


        return parent::afterSave($insert, $changed);
    }*/

}
