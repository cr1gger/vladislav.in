<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\control\modules\passwordManager\models\PmStore $model */

$this->title = 'Создать пароль';
$this->params['breadcrumbs'][] = ['label' => 'Список паролей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pm-store-create card">

    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
