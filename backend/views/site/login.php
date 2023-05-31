<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model common\models\User */

use common\components\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

$this->title = t("Добро пожаловать👋");
?>

<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
    <div class="content-header row"></div>
    <div class="content-body">
        <div class="auth-wrapper auth-v1 px-2">
            <div class="auth-inner py-2">
                <div class="card mb-0">
                    <div class="card-body">
                        <h4 class="card-title font-weight-medium mb-3"><?= ($this->title) ?></h4>
                        <p class="card-text mb-4">Пожалуйста, войдите в свою учетную запись</p>
                        <?php $form = ActiveForm::begin([
                            'enableAjaxValidation' => false,
                            'enableClientValidation' => true,
                            'options' => [
                                'class' => 'auth-login-form mt-2'
                            ]
                        ]); ?>

                        <?= $form->field($model, 'username', [
                            'options' => ['class' => 'form-group']
                        ])->textInput([
                            'placeholder' => $model->getAttributeLabel('Логин')
                        ])->label('Логин') ?>

                        <?= $form->field($model, 'password', [
                            'options' => ['class' => 'form-group']
                        ])->passwordInput([
                            'placeholder' => $model->getAttributeLabel('password')
                        ])->label('Пароль') ?>

                        <?= Html::submitButton(t('Войти'), ['class' => 'btn-custom theme-bg w-100', 'name' => 'login-button']) ?>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
