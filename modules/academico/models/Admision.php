<?php

namespace app\modules\admision\models;

use Yii;

class Admision extends \yii\db\ActiveRecord
{
    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => array(
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ),
    ];

    /**
     * @inheritdoc
     */
    public static function mesagetest()
    {
        return "Hola Mundo";
    }

}
