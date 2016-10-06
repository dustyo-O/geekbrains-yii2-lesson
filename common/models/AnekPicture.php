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

        $i = 0;
        $parts = pathinfo($picture_filename);
        while(file_exists($picture_filename))
        {
            $i++;
            $picture_filename = $parts['dirname'].'/'.$parts['filename'].'_'.$i.'.'.$parts['extension'];
        }

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

    public static function getImageHtml($image)
    {
        if ((!$image)||(!file_exists(self::getImageDir().$image)))
        {
            $src = 'data:image/png;base64,'.base64_encode(file_get_contents(self::getImageDir().'no-image.png'));
        }
        else
        {
            $src = 'data:image/png;base64,'.base64_encode(self::readPicture($image));
        }

        return "<img class=\"anek-picture\" src=\"$src\"/>";
    }
}
