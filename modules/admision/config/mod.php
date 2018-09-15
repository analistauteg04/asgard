<?php
//return ['app' =>  'app\modules\app\Module'];
return ['app' => [
            'class' => 'app\modules\admision\Module',
            'db2' => [
                'class' => 'app\components\CConnection',
                'dsn' => 'mysql:host=localhost;dbname=db_crm',
                'username' => 'uteg',
                'password' => 'Utegadmin2016*',
                'charset' => 'utf8',
                'dbname' => 'db_crm',
                'dbserver' => 'localhost'
                ],
            ],
        ];
