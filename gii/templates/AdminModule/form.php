<?php
/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */
/** @var \app\gii\templates\AdminModule\Generator $generator */

?>
<div class="module-form">
<?php
    echo $form->field($generator, 'moduleClass');
    echo $form->field($generator, 'moduleID');
    echo $form->field($generator, 'moduleName');
?>
</div>
