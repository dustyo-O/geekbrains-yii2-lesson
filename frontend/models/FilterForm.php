<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 29.09.16
 * Time: 17:54
 */

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * FilterForm is the model behind the contact form.
 */
class FilterForm extends Model
{
    public $user;
    public $mode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'mode'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user' => 'Автор',
            'mode' => 'Содержимое',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
}
