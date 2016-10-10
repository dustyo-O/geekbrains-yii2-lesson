<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 10.10.16
 * Time: 22:11
 */

namespace frontend\models;

use Yii;
use yii\base\Model;
use PHPExcel_IOFactory;
use yii\web\UploadedFile;

class ExcelForm extends Model
{
    public $word;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'word' => 'Документ',
        ];
    }

    /**
     * @param $file UploadedFile
     */
    public static function getContent($file)
    {
        $inputFileName = $file->tempName;

        //  Read your Excel workbook
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(\Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

//  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $rowData = $sheet->getCell('A1')->getValue();

        return $rowData;
    }
}