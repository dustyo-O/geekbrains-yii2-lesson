<?php

use yii\db\Migration;

class m161006_175525_aneks_is_visible extends Migration
{
    public function safeUp()
    {
        $this->addColumn("{{%aneks}}",'is_visible',$this->boolean()->defaultValue(0)->notNull() . ' AFTER user_id');
    }

    public function safeDown()
    {
        $this->dropColumn("{{%aneks}}",'is_visible');
    }

}
