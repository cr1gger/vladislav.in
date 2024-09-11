
<?php
$this->title = 'Игра шпион';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="spygame-default-index card">
    <div class="card-body">
        <h1>Модуль <strong>Игра шпион</strong> успешно создан!</h1>
        <p>
            Контент для экшена: <code><?= $this->context->action->id ?></code>.<br>
            Действие принадлежит контролеру: <code><?= get_class($this->context) ?></code>
        </p>
        <p>
            Вы можете настроить эту страницу, отредактировав следующий файл:<br>
            <code><?= __FILE__ ?></code>
        </p>
    </div>
</div>

