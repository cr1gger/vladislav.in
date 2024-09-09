<?php

use yii\helpers\Html;

$publicWeb = Yii::$app->getModule('control')->params['publicWeb'];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="<?=$publicWeb . '/images/avatar.png'?>"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center"><?=$user->username?></h3>
                    <p class="text-muted text-center"> </p>
                    <hr>
                    <strong><i class="fas fa-star mr-1"></i> Роли</strong>
                    <p class="text-muted">
                        <?php foreach($roles as $role): ?>
                            <span class="badge badge-primary"><?=$role?></span>
                        <?php endforeach;?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-bolt mr-1"></i> Разрешения</strong>
                    <p class="text-muted">
                        <?php foreach($permissions as $permission): ?>
                            <span class="badge badge-info"><?=$permission?></span>
                        <?php endforeach;?>
                    </p>

                </div>

            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Информация</h3>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Последний вход</b> <a class="float-right"><?=$user->last_login ?? '-'?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Дата регистрации</b> <a class="float-right"><?=$user->created_at ?? '-'?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Дата изменения</b> <a class="float-right"><?=$user->updated_at ?? '-'?></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item d-none">
                            <a class="nav-link" href="#activity" data-toggle="tab">Активность</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#settings" data-toggle="tab">Настройки</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#api" data-toggle="tab">API</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane" id="activity">
                            Здесь пока что пусто...
                        </div>

                        <div class="active tab-pane" id="settings">
                            <p>Если вы решили изменить ваши данные для входа, это можно сделать здесь!</p>
                            <p>Введите новые данные и нажмите кнопку "Изменить"</p>
                            <p>Можно изменить что-то одно или сразу все =)</p>
                            <?= Html::beginForm('/control/account/change', 'post', [
                                    'class' => 'form-horizontal', // TODO: Переделать на ActiveForm
                            ])?>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Логин</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Введите новый логин">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new-password" class="col-sm-2 col-form-label">Пароль</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="new-password" name="new-password" placeholder="Введите новый пароль">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Изменить</button>
                                    </div>
                                </div>
                            <?=Html::endForm()?>
                        </div>

                        <div class="tab-pane" id="api">
                            <p>Для доступа к API вам потребуется ключ</p>
                            <p>Его нужно передавать в заголовках вместе с запросом: Bearer <Token></p>
                            <?= Html::beginForm('/control/account/generate-api-token', 'post', [
                                'class' => 'form-horizontal', // TODO: Переделать на ActiveForm
                            ])?>
                            <div class="form-group row">
                                <label for="token" class="col-sm-2 col-form-label">Ключ</label>
                                <div class="col-sm-10">
                                    <textarea name="token" id="token" cols="80" rows="10" disabled="disabled"><?=$user->access_token?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Пересоздать токен</button>
                                </div>
                            </div>
                            <?=Html::endForm()?>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
