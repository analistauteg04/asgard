<?php

namespace app\controllers;

use Yii;
use app\components\CController;
use app\models\Grupo;
use app\models\Rol;
use app\models\Accion;
use app\models\Modulo;
use app\models\ObjetoModulo;
use app\models\Aplicacion;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\models\Utilities;
use app\models\Reporte;
use app\models\ExportFile;

class ReportesController extends CController {

    public function actionIndex() {        
        return $this->render('index');
    }
    
    public function actionExpexcelreport(){
        $objDat= new Reporte();
        //$data["estado"]= $_GET["estado"];
        $data["op"]= $_GET["op"];
        $data["f_ini"]= $_GET["f_ini"];
        $data["f_fin"]= $_GET["f_fin"];
        //$data["valor"]= $_GET["valor"];
        $arrData=$objDat->consultarActividadporOportunidad($data);

        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "ActividadesOportunidad-" . date("YmdHis");
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        
        //A.bact_id,B.opo_id,DATE(A.bact_fecha_registro) Fecha,CONCAT(C.pges_pri_nombre) Nombres,F.eopo_nombre,E.oact_nombre,A.bact_descripcion
        //$arrHeader = array("#","Origen");
        $arrHeader = array("Fecha","Nombres","Estado","Observacion","Detalle");
        $nameReport = yii::t("formulario", "Application Reports");
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L","M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }
    
}
