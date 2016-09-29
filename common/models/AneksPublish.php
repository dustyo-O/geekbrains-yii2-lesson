<?php

namespace common\models;

use common\models\Aneks;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * .
 */
class AneksPublish extends Model
{
    public $text;
    public $image;
    public $category_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text' => 'Текст анекдота',
            'image' => 'Картинка'
        ];
    }

    public function createAnek()
    {
        if (!$this->validate())
        {
            return null;
        }

        $anek = new Aneks();
        $anek->text = $this->text;
        $anek->image = $this->image;
        $anek->category_id = $this->category_id;
        $anek->user_id = Yii::$app->getUser()->id;
        return $anek->save() ? $anek : null;
    }

    /**
     * @param $picture UploadedFile
     * @return bool результат загрузки
     */
    public static function uploadImage($picture)
    {
        $picture_filename = Aneks::getImageDir() . $picture->name;

        if ($picture->saveAs($picture_filename))
        {
            return Aneks::IMAGE_PATH . $picture->name;
        }
        else
        {
            return null;
        }
    }
}
