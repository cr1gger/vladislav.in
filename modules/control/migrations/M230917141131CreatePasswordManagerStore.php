<?php

namespace app\modules\control\migrations;

use yii\db\Migration;

/**
 * Class M230917140818CreatePasswordManagerStore
 */
class M230917141131CreatePasswordManagerStore extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pm_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'owner' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('fk-category-user', 'pm_category', 'owner', 'user', 'id', 'CASCADE', 'CASCADE');

        $this->createTable('pm_store', [
            'id' => $this->primaryKey(),
            'owner' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'resource' => $this->string()->notNull(),
            'identifier' => $this->string()->notNull(),
            'password_hash' => $this->text(), // Если мы шифруем пароль
            'password_open' => $this->string(), // Если хотим сохранить открытым
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('fk-category_id', 'pm_store', 'category_id', 'pm_category', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-owner-user', 'pm_store', 'owner', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pm_store');
        $this->dropTable('pm_category');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M230917140818CreatePasswordManagerStore cannot be reverted.\n";

        return false;
    }
    */
}
