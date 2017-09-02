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
                'index' => 'site/index',
                'contact' => 'site/contact',
                //'contact/<wk:\w+>' => 'site/contact',
                'login' => 'site/login',
                'signup' => 'site/signup',
                'about' => 'site/about',
                'lead' => 'site/lead',
                'lead-sended' => 'site/lead-sended',
                'lead-form' => 'site/lead-form',
                'main' => 'lk/index',
                '/' => 'site/index',
                'workoutsets' => 'workoutsets/workoutsets',
                'workoutsets/' => 'workoutsets/workoutsets',
                'allexercisenames' => 'workoutsets/allexercisenames',
                'workoutsets/add_new_exercise_name_to_db' => 'workoutsets/add_new_exercise_name_to_db',
                'workoutsets/create_workoutset' => 'workoutsets/create_workoutset',
                'workoutsets/update_workoutset' => 'workoutsets/update_workoutset',
                'workoutsets/delete_workoutset' => 'workoutsets/delete_workoutset',
                'workoutsets/create_workoutsetname' => 'workoutsets/create_workoutsetname',
                'workoutsets/update_workoutsetname' => 'workoutsets/update_workoutsetname',
                'workoutsets/delete_workoutsetname' => 'workoutsets/delete_workoutsetname',
                'workoutsets/create_exercisename' => 'workoutsets/create_exercisename',
                'workoutsets/update_exercisename' => 'workoutsets/update_exercisename',
                'workoutsets/delete_exercisename' => 'workoutsets/delete_exercisename',
                //'workoutsets/<workoutset:\w+>' => 'workoutsets/exercisenames',
                'workoutsets/<workoutset:\w+>' => 'workoutsets/exerciseslist',
                //'workoutsets/<workoutset:\w+>/<exercisename:\w+>' => 'workoutsets/exercisename_detail',
                'workouts' => 'workouts/workouts',
                'workouts/' => 'workouts/workouts',
                'workouts/create_workout' => 'workouts/create_workout',
                'workouts/create_exercise' => 'workouts/create_exercise',
                'workouts/create_attempt' => 'workouts/create_attempt',
                'workouts/update_workout' => 'workouts/update_workout',
                'workouts/update_exercise' => 'workouts/update_exercise',
                'workouts/update_attempt' => 'workouts/update_attempt',
                'workouts/delete_workout' => 'workouts/delete_workout',
                'workouts/delete_exercise' => 'workouts/delete_exercise',
                'workouts/delete_attempt' => 'workouts/delete_attempt',
                'workouts/<workout:\w+>' => 'workouts/exercises',
                'workouts/<workout:\w+>/<exercise:\w+>' => 'workouts/attempts',
                'workouts/<workout:\w+>/<exercise:\w+>/<attempt:\w+>' => 'workouts/update_attempt',
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
