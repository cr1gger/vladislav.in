<?php
/** @var yii\web\View $this */
/** @var yii\gii\generators\module\Generator $generator */
?>

<?="<?php\n" ?>
$this->title = '<?=$generator->moduleName?>';
$this->params['breadcrumbs'] = [['label' => $this->title]];
<?= "?>"?>

<div class="<?= $generator->moduleID . '-default-index' ?> card">
    <div class="card-body">
        <h1>Модуль <strong><?=$generator->moduleName?></strong> успешно создан!</h1>
        <p>
            Контент для экшена: <code><?= "<?= " ?>$this->context->action->id ?></code>.<br>
            Действие принадлежит контролеру: <code><?= "<?= " ?>get_class($this->context) ?></code>
        </p>
        <p>
            Вы можете настроить эту страницу, отредактировав следующий файл:<br>
            <code><?= "<?= " ?>__FILE__ ?></code>
        </p>
    </div>
</div>

