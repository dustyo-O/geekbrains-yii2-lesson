<?php

use yii\db\Migration;

class m160926_173226_aneks extends Migration
{

    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%aneks}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->text(),
            'image' => $this->string(255)
        ], $tableOptions);

        $this->createIndex("aneks_user", "{{%aneks}}", "user_id");
        $this->addForeignKey("FK_aneks_user", "{{%aneks}}", "user_id", "{{%user}}", "id");
    }

    public function safeDown()
    {
        $this->dropForeignKey("FK_aneks_user", "{{%aneks}}");
        $this->dropTable('{{%aneks}}');
    }

}
