<?php

use yii\db\Migration;

class m161009_175734_user_roles extends Migration
{

    public function safeUp()
    {
        $this->addColumn("{{%user}}", "role", $this->integer()->notNull()->defaultValue(20). " AFTER username");
        $this->update("{{%user}}", ["role" => \common\models\User::ROLE_ADMIN], ['username' => 'admin']);
    }

    public function safeDown()
    {
        $this->dropColumn("{{%user}}", "role");
    }

}
