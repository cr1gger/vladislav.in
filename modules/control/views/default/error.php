<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="error-page">
    <h2 class="headline text-danger"><?= $exception->statusCode ?? 9999 ?></h2>
    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! <?= Html::encode($name) ?></h3>
        <strong>
            <?= nl2br(Html::encode($message)) ?>
        </strong>

        <p>
            Вышеупомянутая ошибка произошла во время обработки вашего запроса веб-сервером. Пожалуйста, свяжитесь с
            нами, если вы считаете, что это ошибка сервера. Спасибо.
            Тем временем, вы можете <?= Html::a('вернуться на главную страницу', Yii::$app->homeUrl); ?>
        </p>

    </div>
</div>
