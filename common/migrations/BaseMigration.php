<?php

namespace app\common\migrations;

use yii\db\Migration;

class BaseMigration extends Migration
{
    public function createTable($table, $columns, $options = null)
    {
        $c = \Yii::$app->controller;
        dd($c->getBasePath());
        $table = 'asdasd_' . $table;
        parent::createTable($table, $columns, $options);
    }
}