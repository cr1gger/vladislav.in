<?php

use app\modules\control\modules\passwordManager\assets\ClipboardAssets;
use app\modules\control\modules\passwordManager\assets\CryptoAssets;
use app\modules\control\modules\passwordManager\models\PmStore;
use hail812\adminlte3\yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

ClipboardAssets::register($this);
CryptoAssets::register($this);

$this->title = 'Папка: ' . $category->name;
?>
<div class="container-fluid">
    <div class="row">
        <div class="btn-group">
            <a href="/control/passwordManager/store" class="btn btn-outline-success">Список папок</a>
            <?php if (!$dataProvider->totalCount): ?>
                <a href="<?=Url::to(['store/remove-folder', 'id' => $category->id])?>" class="btn btn-outline-danger">Удалить пустую папку</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="card mt-2">
    <div class="card-body">
        <div class="card-text">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'resource',
                    'identifier',
                    [
                        'attribute' => 'identifier',
                        'format' => 'raw',
                        'value' => function ($model) {
                            if (!$model->identifier) {
                                return '(не задано)';
                            }

                            $copy = "<i class='fas fa-copy' data-copy='{$model->identifier}' data-toggle='tooltip' data-placement='top' title='Скопировать'></i>";
                            return "{$model->identifier} {$copy}";

                        }
                    ],
                    [
                        'attribute' => 'password_hash',
                        'format' => 'raw',
                        'value' => function ($model) {
                            if ($model->password_hash) {
                                return "<button class='btn btn-warning btn-sm' data-password-hash='{$model->password_hash}'>Открыть пароль</button>";
                            }

                            return '(не задано)';
                        },
                    ],
                    [
                        'attribute' => 'password_open',
                        'format' => 'raw',
                        'value' => function ($model) {
                            if (!$model->password_open) {
                                return '(не задано)';
                            }

                            $copy = "<i class='fas fa-copy' data-copy='{$model->password_open}' data-toggle='tooltip' data-placement='top' title='Скопировать'></i>";
                            return "{$model->password_open} {$copy}";

                        }
                    ],
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, PmStore $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<!-- Модальное окно -->
<div class="modal fade" id="decryptPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Пароль зашифрован</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h3>Введите ключ для дешифровки пароля</h3>
                </div>
                <div class="form-group">
                    <input id="decryptInputKey" type="text" class="form-control" placeholder="Ключ для дешифровки">
                </div>
                <div class="form-group">
                    <button class="btn btn-outline-success w-100" onclick="decryptPassword()">Открыть пароль</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('click', (e) => {
        let target = e.target
        if (target.hasAttribute('data-password-hash')) {
            setCurrentPasswordHash(target.getAttribute('data-password-hash'))
            $('#decryptPassword').modal()
        }
    })

    window.decryptModule = {
        passwordHash: null,
    }

    const decryptPassword = () => {
        let decryptKey = document.querySelector('#decryptInputKey').value;
        let result = CryptoJS.AES.decrypt(window.decryptModule.passwordHash, decryptKey).toString(CryptoJS.enc.Utf8)
        if (result.length === 0) {
            Swal.fire({
                icon: 'error',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                title: 'Не верный ключ!'
            })
            return
        }
        let passwordButton = document.querySelector('[data-password-hash="' + window.decryptModule.passwordHash + '"]')
        let td = passwordButton.parentElement
        passwordButton.replaceWith(result + " ")
        window.decryptModule.passwordHash = null
        $('#decryptPassword').modal('hide')
        td.classList.add('animate__flash')
        td.classList.add('animate__animated')
        td.insertAdjacentHTML('beforeend', `<i class='fas fa-copy' data-copy='${result}' data-toggle='tooltip' data-placement='top' title='Скопировать'></i>`)
    }

    const setCurrentPasswordHash = (hash) => {
        window.decryptModule.passwordHash = hash
    }
</script>
