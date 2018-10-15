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
use app\modules\academico\Module as academico;
academico::registerTranslations();
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
        switch ($data["op"]) {
            case '1'://GRADO
                $arrData=$objDat->consultarActividadporOportunidad($data);
                $arrHeader = array("N° Oport","Fecha","Empresa","Nombres","Apellidos","Unidad Academica","Estado","Observacion");
                $nombarch = "ActividadesOportunidad-" . date("YmdHis").".xls";
                break;
            case '2'://POSGRADO
                $arrData=$objDat->consultarOportunidadProximaAten($data);
                $arrHeader = array("N° Oport","F.Prox.At","Empresa","Nombres","Apellidos","Unidad Academica",
                                    "Estado","Observacion");
                $nombarch = "ProximaOportunidad-" . date("YmdHis").".xls";
                break;
            case '3'://Aspirantes
                $arrData=$objDat->consultarAspirantesPendientes($data);
                $arrHeader = 
                        array(
                            Yii::t("formulario", "DNI"),
                            Yii::t("formulario", "Date"),
                            Yii::t("formulario", "Name"),                        
                            Yii::t("formulario", "Last Names"),
                            Yii::t("formulario", "Company"),
                            "Num. Solicitudes",
                            "Carrera",
                            "Estado Documentos",
                            "Estado Pago",
                        );                
                $nombarch = "AspirantesPendientes-" . date("YmdHis").".xls";
                break;
            case '4'://Aspirantes Admitidos con Solicitud Pagada o Pendiente
                $arrData=$objDat->consultarAspiranteSolicitudPago($data);
                $arrHeader = array("N°Solicitud","F.Solicitud","Empresa","Nombres","Apellidos","Unidad Academica",
                                    "Carrera","Est.Pago","Est.Admitido");
                $nombarch = "AspirantesSolicitudPago-" . date("YmdHis").".xls";
                break;
        }
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");        
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');               
        $nameReport = yii::t("formulario", "Application Reports");
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L","M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }
}
