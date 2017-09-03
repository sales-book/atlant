<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'urlManager' => [
            'rules' => [
                'contact' => 'site/contact',
                'login' => 'site/login',
                'signup' => 'site/signup',
                'about' => 'site/about',
                'lead' => 'site/lead',
                'lead-sended' => 'site/lead-sended',
                'sitemap.xml' => 'site/sitemap',
                'lead-form' => 'site/lead-form',
                'main' => 'lk/index',
                '/' => 'site/index',
                'index' => 'site/index',
                'купить кассу ККТ' => 'site/index',
                'купить контрольно-кассовую технику' => 'site/index',
                'аттестация объектов информатизации' => 'site/attestation',
                'средства вибороакустической защиты Бекар' => 'site/svaz',
                'лицензирование по требованиям ФСБ' => 'site/licensing',
                'электронная подпись для торгов ОФД ЕГАИС' => 'site/kep',
                'сопровождение торгов' => 'site/torgi',
                'банковская гарантия' => 'site/banki',
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
