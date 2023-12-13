<?php

use app\common\enums\DefaultRoles;
use app\common\models\User;
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
            // TODO: Вынести в отдельный виджет всю эту кашу
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'username',
                'statusName',
                [
                    'attribute' => 'roles',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $roles = $model->roles;
                        $html = '';
                        foreach ($roles as $roleName => $roleDescription) {
                            $classes = ['badge', 'mr-1'];
                            if ($roleName == DefaultRoles::ROOT) {
                                $classes[] = 'badge-danger';
                            } else {
                                $classes[] = 'badge-primary';
                            }

                            $html .= Html::tag('span', $roleDescription, ['class' => implode(' ', $classes)]);
                        }
                        return $html;
                    }
                ],
                [
                    'attribute' => 'permissions',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $permissions = $model->permissions;
                        $html = '';
                        foreach ($permissions as $permission) {
                            $html .= Html::tag('span', $permission, ['class' => 'badge badge-warning mr-1']);
                        }
                        return $html;
                    }
                ],
                'last_login',
                'created_at',
                'updated_at',
                [
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']);
                    }
                ]
            ],
            'rowOptions' => function ($model) {
                if ($model->status == User::STATUS_INACTIVE) {
                    return ['class' => 'bg-danger disabled'];
                }
            },
        ]) ?>
    </div>
</div>

