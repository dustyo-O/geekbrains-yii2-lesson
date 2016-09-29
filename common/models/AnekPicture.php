<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 29.09.16
 * Time: 19:42
 */

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class AnekPicture extends Model
{
    public static $image_dir;

    public static function getImageDir()
    {
        if (self::$image_dir === null)
        {
            self::$image_dir = Yii::getAlias("@root"). "/upload/";
        }
        return self::$image_dir;
    }

    /**
     * @param $picture UploadedFile
     * @return null|string результат загрузки
     */
    public static function uploadImage($picture)
    {
        $picture_filename = self::getImageDir() . $picture->name;

        if ($picture->saveAs($picture_filename))
        {
            return $picture->name;
        }
        else
        {
            return null;
        }
    }

    public static function readPicture($picture)
    {
        if (file_exists(self::getImageDir().$picture))
        {
            return file_get_contents(self::getImageDir().$picture);
        }
        else
        {
            return null;
        }
    }
}