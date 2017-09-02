<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\LeadForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'Отправить заявку';
?>

<div class="site-signup">

    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-8 col-xs-12">
            <?php $form = ActiveForm::begin(['id' => 'form-lead']); ?>

				<?= $form->field($model, 'OrgName')->textInput(['autofocus' => true]) ?>

				<?= $form->field($model, 'Name') ?>

				<?= $form->field($model, 'Phone') ?>

				<?= $form->field($model, 'Email') ?>

				<?= $form->field($model, 'City') ?>

				<?= $form->field($model, 'Description')->textarea(['rows' => 2]) ?>

                <?php if (Yii::$app->user->isGuest) { ?>
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ])->label('Введите символы с картинки') ?>
                <?php } ?>

				<div class="form-group">
					<?= Html::submitButton('Отправить', ['class' => 'btn btn-success pull-right', 'name' => 'signup-button']) ?>
				</div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
