<?php
namespace app\modules\admision\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\admision\models\Admision;
use yii\web\NotFoundHttpException;
use app\models\ExportFile;

class AdmisionController extends \app\components\CController
{
    public function actionIndex()
    {
        $var = Admision::mesagetest();
        return $this->render('index', array("var"=> $var));
    }

    public function actionView($id)
    {
        //$var = App::mesagetest();
        //return $this->render('index', array("var"=> $var));
        //file_put_contents("/opt/logs/pblog.log",json_encode(Yii::$app->urlManager) . "\n", FILE_APPEND | LOCK_EX);
        //return Yii::$app->controller->module->db2;
        return "test";
    }
}
