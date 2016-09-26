<?php

use yii\db\Migration;

class m160926_182455_aneks_time_publish extends Migration
{

    public function safeUp()
    {
        $this->addColumn("{{%aneks}}","publish_time",$this->timestamp());
    }

    public function safeDown()
    {
        $this->dropColumn("{{%aneks}}","publish_time");
    }

}
