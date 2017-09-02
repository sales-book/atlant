<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Добрый день, <?= Html::encode($user->additional_name) ?>!</p>

    <p>Перейдя по следующей ссылке, Вы сможете изменить свой пароль:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
	
	С уважением,<br>
	Сайт "Дневник тренировок"
</div>
