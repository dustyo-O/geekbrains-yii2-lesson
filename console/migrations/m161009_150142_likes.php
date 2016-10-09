<?php

use yii\db\Migration;

class m161009_150142_likes extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%likes}}', [
            'user_id' => $this->integer()->notNull(),
            'anek_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('like_PK', "{{%likes}}", ['user_id', 'anek_id']);

        $this->createIndex("user_like", "{{%likes}}", "user_id");
        $this->createIndex("anek_like", "{{%likes}}", "anek_id");

        $this->addForeignKey("FK_user_like", "{{%likes}}", "user_id", "{{%user}}", "id");
        $this->addForeignKey("FK_anek_like", "{{%likes}}", "anek_id", "{{%aneks}}", "id");
    }

    public function safeDown()
    {
        $this->dropForeignKey("FK_user_like", "{{%likes}}");
        $this->dropForeignKey("FK_anek_like", "{{%likes}}");

        $this->dropTable("{{%likes}}");
    }

}
