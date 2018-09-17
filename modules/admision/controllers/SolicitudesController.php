<?php

namespace app\modules\admision\controllers;
use app\modules\admision\models\SolicitudInscripcion;
use Yii;

class SolicitudesController extends \app\components\CController
{
    public function actionIndex()
    {
        $per_id = @Yii::$app->session->get("PB_perid");
        $per_ids = base64_decode($_GET['ids']);
        $mod_carrera = new EstudioAcademico();        
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            //$arrSearch["estado"] = $data['estado'];
            $arrSearch["search"] = $data['search'];
          
            $model = SolicitudInscripcion::getSolicitudesXInteresado($per_id, $arrSearch);    

            $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_carrera->consultarCarrera()), "id", "value");
            $arrEstados = ArrayHelper::map([["id" => "P", "value" => "Pendiente"], ["id" => "S", "value" => "Pagado"], ["id" => "NA", "value" => "No Disponible"]], "id", "value");
            return $this->render('index', [
                        'model' => $model,
                        'arrCarreras' => $arrCarreras,
                        'arrEstados' => $arrEstados
            ]);
        }
    }

    public function actionView()
    {

    }

    public function actionEdit()
    {

    }

    public function actionNew()
    {
        return $this->render('new');
    }

    public function actionSave()
    {

    }

    public function actionUpdate()
    {

    }
}