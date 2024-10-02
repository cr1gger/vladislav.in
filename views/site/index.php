<?php

/** @var yii\web\View $this */

$this->title = 'VLADISLAV.IN - Personal site';
?>
<div class="box brand">
    <h1>VLADISLAV.IN</h1>
</div>

<div class="box nav-menu">
    <div class="button inline-block">
        <a class="animated-button thar-one" href="#" data-vin-modal="modal-about">ОБО МНЕ</a>
    </div>
    <div class="button inline-block">
        <a class="animated-button thar-one" href="#">ПОРТФОЛИО</a>
    </div>
    <div class="button inline-block" data-vin-modal="modal-contact">
        <a class="animated-button thar-one" href="#">КОНТАКТЫ</a>
    </div>
    <div class="button inline-block">
        <a class="animated-button thar-one" href="/editor" target="_blank">Онлайн редактор</a>
    </div>
</div>
<div class="box footer-social">
    <a class="inline-block" href="https://vk.com/cr1gger" target="_blank">
        <img src="/frontend/svg/vk.svg" alt="Ссылка на ВК" width="35">
    </a>
    <a class="inline-block" href="https://t.me/cr1gger" target="_blank">
        <img src="/frontend/svg/telegram.svg" alt="Ссылка на телеграм" width="35">
    </a>
    <a class="inline-block" href="mailto:cr1gger@ya.ru">
        <img src="/frontend/svg/maildotru.svg" alt="Почта" width="35">
    </a>
</div>

<div id="container" class="container">
    <canvas style="min-width: 100%; min-height:100vh"></canvas>
</div>

<div class="vin-modal-container" id="modal-contact">
    <div class="vin-modal">
        <div class="vin-modal-header">
            <div class="vin-modal-title">Контакты</div>
            <div class="vin-modal-close">&times;</div>
        </div>
        <div class="vin-modal-body">
            Все контакты указаны в низу страницы =)
        </div>
    </div>
</div>
<div class="vin-modal-container" id="modal-about">
    <div class="vin-modal">
        <div class="vin-modal-header">
            <div class="vin-modal-title">Обо мне</div>
            <div class="vin-modal-close">&times;</div>
        </div>
        <div class="vin-modal-body">
            Скоро здесь что-то появиться...
        </div>
    </div>
</div>
