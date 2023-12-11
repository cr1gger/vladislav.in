<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Пользователи';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<p>
    <?= Html::a('Новый пользователь', ['create'], ['class' => 'btn btn-outline-success']) ?>
</p>

<div class="users-default-index card">
    <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'username',
                'statusName',
                'last_login',
                'created_at',
                'updated_at',
                [
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-outline-primary']);
                    }
                ]
            ]
        ]) ?>
    </div>
</div>

