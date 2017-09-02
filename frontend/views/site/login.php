<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните эти поля для входа:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?php if($model->scenario === 'loginWithEmail'): ?>
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Ваш Email') ?>
                <?php else: ?>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Ваш логин') ?>
                <?php endif ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

                <div class="form-group">
                    Если Вы еще не зарегистрированы у нас, <?= Html::a('зарегистрируйтесь',['site/signup'] ) ?>
                </div>

                <div style="color:#999;margin:1em 0">
                    Если Вы забыли пароль, Вы можете <?= Html::a('восстановить его', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
