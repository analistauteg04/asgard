<?php
return ['financiero' => [
            'class' => 'app\modules\financiero\Module',
            'db_facturacion' => [
                'class' => 'app\components\CConnection',
                'dsn' => 'mysql:host=localhost;dbname=db_facturacion',
                'username' => 'uteg',
                'password' => 'Utegadmin2016*',
                'charset' => 'utf8',
                'dbname' => 'db_facturacion',
                'dbserver' => 'localhost'
                ],
            'db_sea' => [
                'class' => 'app\components\CConnection',
                'dsn' => 'mysql:host=181.39.139.70;dbname=pruebasea',
                'username' => 'root',
                'password' => 'Root$s34',
                'charset' => 'utf8',
                'dbname' => 'pruebasea',
                'dbserver' => '181.39.139.70',
                ],
            ],
        ];
