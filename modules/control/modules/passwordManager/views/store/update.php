<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \app\modules\control\modules\passwordManager\models\forms\CreatePmStoreForm $modelForm */

$this->title = 'Update Pm Store: ' . $modelForm->model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pm Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelForm->model->id, 'url' => ['view', 'id' => $modelForm->model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pm-store-update card">

    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $modelForm,
        ]) ?>
    </div>
</div>
