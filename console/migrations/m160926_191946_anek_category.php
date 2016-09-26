<?php

use yii\db\Migration;

class m160926_191946_anek_category extends Migration
{
    public function safeUp()
    {
        $this->addColumn("{{%aneks}}","category_id",$this->integer(2). ' AFTER user_id');
    }

    public function safeDown()
    {
        $this->dropColumn("{{%aneks}}","category_id");
    }
}
