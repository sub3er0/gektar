<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$container = new \yii\di\Container;

//$container->set('backend\modules\plot\services\CadastrialApiService');

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'plot' => [
            'class' => 'backend\modules\plot\Plot',
            // ... другие настройки модуля ...
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.*', 'XXX.XXX.XXX.XXX'] // adjust this to your needs
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=dbname',
            'username' => 'username',
            'password' => 'password',
        ],
        'urlManager' => [
            //'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'rules' => [
                'plot' => '<module>/plot/index',
                'plot/getData' => '<module>/plot/getData'
            ],
        ],
        'container' => [
            'definitions' => 'backend\modules\plot\services\CadastrialApiService',
            'class' => 'backend\modules\plot\services\CadastrialApiService'
        ],
    ],
    'params' => $params,
];
