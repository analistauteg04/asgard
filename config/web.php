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
            'rules' => [
                // REST patterns
                'GET api/list/<modelo:\w+>/format' => 'api/list',
                'GET api/view/<modelo:\w+>/<id:\d+>/format' => 'api/view',
                'PUT api/update/<modelo:\w+>/<id:\d+>/format' => 'api/update',
                'DELETE api/delete/<modelo:\w+>/<id:\d+>/format' => 'api/delete',
                'POST api/create/<modelo:\w+>/format' => 'api/create',
                'POST api/request/<modelo:\w+>/<metodo:\w+>/<format:\w+>' => 'api/request',
//                
                'GET api/list/<module:\w+>/<modelo:\w+>/format' => 'api/list',
                'GET api/view/<module:\w+>/<modelo:\w+>/<id:\d+>/format' => 'api/view',
                'PUT api/update/<module:\w+>/<modelo:\w+>/<id:\d+>/format' => 'api/update',
                'DELETE api/delete/<module:\w+>/<modelo:\w+>/<id:\d+>/format' => 'api/delete',
                'POST api/create/<module:\w+>/<modelo:\w+>/format' => 'api/create',
                'POST api/request/<module:\w+>/<modelo:\w+>/<metodo:\w+>/<format:\w+>' => 'api/request',
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api'
                ],
            ],
        ],
        'request' => [
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
/******************************************************************************/
// se agregan listado de modulos y configuracion de urlmanager rules
/******************************************************************************/
$dir_mod = __DIR__ . '/../modules/';
$listDirs = scandir($dir_mod);
$arr_rules = $config['components']['urlManager']['rules'];
$arr_new_rules = array();
foreach ($listDirs as $modulo) {// se obtiene los directorios dentro de modules
    if($modulo != "." && $modulo != ".."){
        $modFile = $dir_mod . $modulo . "/config/mod.php";
        $conFile = $dir_mod . $modulo . "/config/config.php";
        if(is_file($modFile)){
            $arr_mod = require($modFile);
            $config['modules'][$modulo] = $arr_mod[$modulo];
        }
        if(is_file($conFile)){
            $arr_conf = require($conFile);
            if(isset($arr_conf['components']['urlManager']['rules'])){
                $url_manager = $arr_conf['components']['urlManager']['rules'];
                $arr_new_rules = array_merge($arr_new_rules, $url_manager);
            }
        }
    }
}
$config['components']['urlManager']['rules'] = array_merge($arr_rules, $arr_new_rules);
/******************************************************************************/
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
