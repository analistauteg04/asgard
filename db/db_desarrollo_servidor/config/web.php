<?php

Yii::setAlias('@views', dirname(__DIR__) . '/views');
Yii::setAlias('@assets', dirname(__DIR__) . '/assets');
Yii::setAlias('@widgets', dirname(__DIR__) . '/widgets');
Yii::setAlias('@themes', dirname(__DIR__) . '/themes');
Yii::setAlias('@modules', dirname(__DIR__) . '/modules');
Yii::setAlias('@web', dirname(__DIR__) . '/web');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'asgard',
    'name' => 'Sistema de Gestion....',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es',
    'sourceLanguage' => 'en',
    'timeZone' => 'America/Guayaquil',
    //'siteName' => 'asgard',
    'components' => [
        'assetManager' => [
            'class'     => 'yii\web\AssetManager',
            'forceCopy' => true,    
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [],
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Usuario',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => require(__DIR__ . '/mailer.php'),
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'db_asgard' => require(__DIR__ . '/db_asgard.php'),
        //'db_pagoext' => require(__DIR__ . '/db_pagoext.php'),
        'db_facturacion' => require(__DIR__ . '/db_facturacion.php'),
        'db_academico' => require(__DIR__ . '/db_academico.php'),
        'db_captacion' => require(__DIR__ . '/db_captacion.php'),
        'db_graduado' => require(__DIR__ . '/db_graduado.php'),
        'db_claustro' => require(__DIR__ . '/db_claustro.php'),
        'db_general' => require(__DIR__ . '/db_general.php'),
        'db_crm' => require(__DIR__ . '/db_crm.php'),
        'view' => [
            'theme' => [
                'class' => '\app\components\CTheme',
                'pathMap' => [
                    '@app/views' => '@app/themes/adminLTE',
                ],
                'baseUrl' => '@web/themes/adminLTE',
                'themeName' => 'adminLTE'
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'baseUrl' => '/asgard',
        ],
        'request' => [
            'enableCsrfValidation'=>false,
            'baseUrl' => '/asgard',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Lh1rkrD52dAgBQ7jBruqawkCgxsJpU7n',
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6Lcp0iUUAAAAAKsTKhSd1BOdrhKJK79xN8D4pjMP',
            'secret' => '6Lcp0iUUAAAAALG0aDTkfhAVsuNRn523AsomdhDd',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    //$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
