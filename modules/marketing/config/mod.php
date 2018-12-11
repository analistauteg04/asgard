<?php
return ['marketing' => [
            'class' => 'app\modules\marketing\Module',
            'db_admision' => [
                'class' => 'app\components\CConnection',
                'dsn' => 'mysql:host=localhost;dbname=db_marketing',
                'username' => 'uteg',
                'password' => 'Utegadmin2016*',
                'charset' => 'utf8',
                'dbname' => 'db_marketing',
                'dbserver' => 'localhost'
                ],
            ],
        ];
