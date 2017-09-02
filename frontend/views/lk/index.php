<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WorkoutsSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Личный кабинет партнера';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leads-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php
    $baseURL = Url::base(true);
?>
    <p>
        <strong> Партнерская ссылка:</strong><br>
        <?= htmlspecialchars("<a href=\"$baseURL/lead-form?id=") ?><?= $userGUID ?><?= htmlspecialchars("\">Заполнить заявку</a>"); ?>
    </p>

    <p>
        <strong>Код формы заявки для размещения на сайте партнера:</strong><br>
        <?= htmlspecialchars("<iframe id =\"iframeform\" width=\"100%\" height=\"550\" src=\"$baseURL/lead?id=") ?><?= $userGUID ?><?= htmlspecialchars("\" scrolling=\"no\" frameborder=\"0\" ></iframe>"); ?>
    </p>

    <p>
        <?= Html::a('Создать новую заявку', ['/lead-form'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //'user_id',
            [
                'attribute' => 'CreateDate',
                'value' => function($model, $key, $index, $column){
                    $myText = $model->{$column->attribute};
                    if (isset($myText)) {return date("d.m.Y H:i:s", strtotime($myText));} else{return '';}
                },
            ],
            //'statuses.StatusName',
            'OrgName',
            'Name',
            'Phone',
            'Email',
            'City',
            'Description',
            [
                'attribute' => 'StatusName',
                'value' => 'statuses.StatusName',
            ],
        ],
    ]); ?>
</div>
