<?php

use app\modules\control\modules\users\models\forms\UserCreateForm;

/** @var UserCreateForm $model */

$this->title = 'Новый пользователь';
$this->params['breadcrumbs'] = [['label' => 'Пользователи', 'url' => ['index']], ['label' => $this->title]];
?>

<div class="user-create card">
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>

