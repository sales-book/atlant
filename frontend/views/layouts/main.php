<?php
header( 'Cache-Control: no-cache, no-store, max-age=0, must-revalidate' );
header( 'Expires: Mon, 1 Apr 2001 01:02:03 GMT' );
header( 'Pragma: no-cache' );
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="yandex-verification" content="9a1378fb99901482" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

	if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Отправить заявку', 'url' => ['/lead-form']];
    }
	
	
	$menuItems[] = ['label' => 'Услуги', 'items' => [
		['label' => 'Автоматизация бизнеса', 'url' => ['/']],
		['label' => 'Аттестация объектов информатизации', 'url' => ['/attestation']],
		['label' => 'Средства вибороакустической защиты', 'url' => ['/svaz']],
		['label' => 'Лицензирование по требованиям ФСБ', 'url' => ['/licensing']],
		['label' => 'Выдача электронных подписей', 'url' => ['/kep']],
		['label' => 'Сопровождение торгов', 'url' => ['/torgi']],
		['label' => 'Выдача банковской гарантии', 'url' => ['/torgi']],
	]];

    $menuItems[] = ['label' => 'Контакты', 'url' => ['/contact']];

    if (!Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Личный кабинет', 'url' => ['/lk']];
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Вход / Регистрация', 'url' => ['/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выход (' . Yii::$app->user->identity->additional_name . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    //isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'][1] = 'Xnj' : []
    ?>
	<div class="container">

		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			'homeLink' => [
				'label' => Yii::t('yii', 'Главная'),
				'url' => Yii::$app->homeUrl,
			],
		]) ?>
		<?= Alert::widget() ?>
		<?= $content ?>

    </div>
</div>

<footer class="footer" >
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>


    </div>
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
