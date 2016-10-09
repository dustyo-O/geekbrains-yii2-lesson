<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 09.10.16
 * Time: 20:53
 */

namespace backend\models;

use common\models\LoginForm;
use common\models\User;

class AdminLoginForm extends LoginForm
{
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            /* @var $user \common\models\User */

            if (!$user || !$user->validatePassword($this->password) || ($user->role !== User::ROLE_ADMIN)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

}
