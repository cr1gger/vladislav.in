<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список паролей';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    a>.info-box {
        color: black;
    }
</style>

<div class="container-fluid">
    <p>
        <?= Html::a('Добавить пароль', ['create'], ['class' => 'btn btn-outline-success']) ?>
    </p>
    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">

                    <?php if (empty($categoryList)): ?>
                        <div class="w-100 text-center">Добавьте ваш первый пароль</div>
                    <?php endif;?>

                    <?php foreach($categoryList as $category): ?>
                        <div class="col-md-3 col-sm-6 col-12">
                            <a href="<?=Url::to(['store/folder', 'id' => $category->id])?>">

                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="far fa-folder"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?=$category->name?></span>
                                    <span class="info-box-number">Паролей: <?=$category->passwordCount?></span>
                                </div>
                            </div>
                            </a>

                        </div>
                    <?php endforeach;?>
                </div>
            </div>


        </div>
    </div>

</div>
