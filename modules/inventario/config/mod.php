<?php
return ['repositorio' => [
            'class' => 'app\modules\repositorio\Module',
            'db_inventario' => [
                'class' => 'app\components\CConnection',
                'dsn' => 'mysql:host=localhost;dbname=db_inventario',
                'username' => 'uteg',
                'password' => 'Utegadmin2016*',
                'charset' => 'utf8',
                'dbname' => 'db_inventario',
                'dbserver' => 'localhost'
                ],
            ],
        ];
