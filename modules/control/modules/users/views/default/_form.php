<?php

use app\modules\control\modules\users\models\forms\UserCreateForm;
use app\modules\control\modules\users\models\forms\UserUpdateForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/** @var UserCreateForm|UserUpdateForm $model */

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput() ?>
<?= $form->field($model, 'password')->textInput() ?>
<?= $form->field($model, 'roles')->checkboxList($model->getRolesList(), [
    'value' => $model->roles
]) ?>
<?= $form->field($model, 'permissions')->checkboxList($model->getPermissionsList(), [
        'value' => $model->permissions
    ]
) ?>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
