<?php

use app\modules\control\modules\passwordManager\assets\CryptoAssets;
use app\modules\control\modules\passwordManager\services\CategoryService;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\modules\control\modules\passwordManager\models\forms\CreatePmStoreForm $model */
/** @var yii\widgets\ActiveForm $form */
CryptoAssets::register($this);

?>

<div class="pm-store-form">

    <?php $form = ActiveForm::begin([
            'options' => ['id' => 'create-pm-store-form'],
    ]); ?>

    <?= $form->field($model, 'categoryName')->widget(Select2::class, [
        'data' => CategoryService::instance()->getUserCategoryListNames(Yii::$app->user->id),
        'options' => ['placeholder' => 'Категория...'],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [],
//            'maximumInputLength' => 10
        ],
    ])->hint('Напишите в это поле название новой категории или выберите одну из существующей категории...') ?>
    <?= $form->field($model, 'resource')->textInput(['class' => 'form-control form-control-border border-width-2']) ?>
    <?= $form->field($model, 'identifier')->textInput(['class' => 'form-control form-control-border border-width-2']) ?>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="text" class="form-control form-control-border border-width-2" id="password" placeholder="Введите ваш новый пароль">
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="checkbox_password_closed" name="CreatePmStoreForm[isCryptPassword]"  disabled="disabled">
            <label class="custom-control-label" for="checkbox_password_closed">Зашифровать пароль</label>
        </div>
    </div>

    <div class="form-group d-none" id="passphrase-block">
        <label for="passphrase">Секретная фраза для расшифровки пароля</label>
        <input type="text" class="form-control form-control-border border-width-2" id="passphrase" placeholder="Введите секретную фразу, которая позволит расшифровать ваш пароль">
    </div>

    <?= $form->field($model, 'password')->hiddenInput()->label('') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить пароль', ['class' => 'btn btn-success', 'id' => 'btn-submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>
let tempPasswordInput = document.querySelector('#password')
let passphraseBlock = document.querySelector('#passphrase-block')
let passphraseInput = document.querySelector('#passphrase')
let originalPasswordInput = document.querySelector('[name="CreatePmStoreForm[password]"]')
let checkboxPasswordHash = document.querySelector('#checkbox_password_closed')
let btnSubmit = document.querySelector('#btn-submit')
let form = $('#create-pm-store-form')
let isEncrypt = false

const encryptPassword = () => {
    return CryptoJS.AES.encrypt(tempPasswordInput.value, passphraseInput.value).toString()
}

tempPasswordInput.addEventListener('input', function(e) {
    if (e.target.value.length > 0) {
        checkboxPasswordHash.removeAttribute('disabled')
    } else {
        checkboxPasswordHash.setAttribute('disabled', 'disabled')
    }
    originalPasswordInput.value = e.target.value
})

passphraseInput.addEventListener('input', function(e) {
    originalPasswordInput.value = encryptPassword()
})

checkboxPasswordHash.addEventListener('change', function() {
    isEncrypt = this.checked

    if (this.checked) {
        tempPasswordInput.setAttribute('disabled', 'disabled')
        passphraseBlock.classList.remove('d-none')
        originalPasswordInput.value = encryptPassword()
    } else {
        tempPasswordInput.removeAttribute('disabled')
        passphraseBlock.classList.add('d-none')
        originalPasswordInput.value = tempPasswordInput.value;

    }
})

form.on('beforeSubmit', function(e) {

    if (isEncrypt && (!(passphraseInput.value.length > 0) || !(originalPasswordInput.value.length > 0) || !(tempPasswordInput.value.length > 0))) {
        Toast.fire({
            icon: 'error',
            title: 'Заполнены не все поля!'
        })
        return false;
    }

    return true;
})
</script>
