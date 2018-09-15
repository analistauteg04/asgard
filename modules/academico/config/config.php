<?php
return [
    'components' => [
        // list of component configurations
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'rules' => [
                '<module:admision>/<controller:\w+>/<action:\w+>/<id:\w+>' => '<module>/<controller>/<action>',
            ]
        ]
    ],
    'params' => [
        // list of parameters
    ],
];