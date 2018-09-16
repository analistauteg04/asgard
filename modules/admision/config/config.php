<?php
return [
    'components' => [
        // list of component configurations
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'rules' => [
                '<module:admision>/<controller:\w+>/<action:\w+>/<id:\w+>' => '<module>/<controller>/<action>',
            ]
        ],
        'db_crm' => require(__DIR__ . '/../data/db_crm.php'),
    ],
    'params' => [
        // list of parameters
    ],
];