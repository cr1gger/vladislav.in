<?php

namespace app\modules\control\migrations;

use yii\db\Migration;

/**
 * Class M240215115242CreateNoteTables
 */
class M240215115242CreateNoteTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Таблица заметок
        $this->createTable('control_notes', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'body' => $this->text(),
            'created_at' => $this->dateTime(),
            'update_at' => $this->dateTime()
        ]);

        $this->createIndex('idx-user_id', 'control_notes', 'user_id');
        $this->addForeignKey('fk-cn-user_id', 'control_notes', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

        // Таблица тэгов заметок
        $this->createTable('control_notes_tags', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'color' => $this->string()
        ]);

        $this->createIndex('idx-user_id', 'control_notes_tags', 'user_id');
        $this->addForeignKey('fk-cnt-user_id', 'control_notes_tags', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

        // Таблица связи заметок и тегов
        $this->createTable('control_notes_tags_relation', [
            'id' => $this->primaryKey(),
            'note_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
            'color' => $this->string()
        ]);

        $this->createIndex('idx-note_id', 'control_notes_tags_relation', 'note_id');
        $this->createIndex('idx-tag_id', 'control_notes_tags_relation', 'tag_id');

        $this->addForeignKey('fk-cntr-note_id', 'control_notes_tags_relation', 'note_id', 'control_notes', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-cntr-tag_id', 'control_notes_tags_relation', 'tag_id', 'control_notes_tags', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('control_notes_tags_relation');
        $this->dropTable('control_notes_tags');
        $this->dropTable('control_notes');
    }
}
