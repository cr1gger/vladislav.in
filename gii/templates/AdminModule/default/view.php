<?php
/** @var yii\web\View $this */
/** @var yii\gii\generators\module\Generator $generator */
?>
<div class="<?= $generator->moduleID . '-default-index' ?>">
    <h1><?= "<?= " ?>$this->context->action->uniqueId ?></h1>
    <p>
        Контент для экшена "<?= "<?= " ?>$this->context->action->id ?>".
        Действие принадлежит контролеру "<?= "<?= " ?>get_class($this->context) ?>"
        в "<?= "<?= " ?>$this->context->module->id ?>" модуле.
    </p>
    <p>
        Вы можете настроить эту страницу, отредактировав следующий файл:<br>
        <code><?= "<?= " ?>__FILE__ ?></code>
    </p>
</div>
