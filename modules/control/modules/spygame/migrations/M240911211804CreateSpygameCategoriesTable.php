<?php

namespace app\modules\control\modules\spygame\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%spygame_categories}}`.
 */
class M240911211804CreateSpygameCategoriesTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $defaultData = '[{"id":1,"name":"Фильмы","created_at":"2023-12-27 18:16:02","updated_at":"2023-12-27 18:16:02"},{"id":2,"name":"Транспорт","created_at":"2023-12-27 18:16:02","updated_at":"2023-12-27 18:16:02"},{"id":3,"name":"Еда","created_at":"2023-12-27 18:16:02","updated_at":"2023-12-27 18:16:02"},{"id":4,"name":"Музыка","created_at":"2023-12-27 18:16:02","updated_at":"2023-12-27 18:16:02"},{"id":5,"name":"Компьютеры","created_at":"2023-12-27 18:16:02","updated_at":"2023-12-27 18:16:02"},{"id":6,"name":"Города","created_at":"2023-12-27 18:18:11","updated_at":"2023-12-27 18:18:11"},{"id":7,"name":"Напитки","created_at":"2023-12-27 18:18:11","updated_at":"2023-12-27 18:18:11"},{"id":8,"name":"Страны","created_at":"2023-12-27 18:18:11","updated_at":"2023-12-27 18:18:11"},{"id":9,"name":"В доме","created_at":"2023-12-27 18:33:32","updated_at":"2023-12-27 18:33:32"},{"id":10,"name":"Публичные места","created_at":"2023-12-27 18:34:22","updated_at":"2023-12-27 18:34:22"}]';
        $data = json_decode($defaultData, true);

        $this->createTable('{{%spygame_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        $this->batchInsert('{{%spygame_categories}}', ['id', 'name', 'created_at', 'updated_at'], $data);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%spygame_categories}}');
    }
}
