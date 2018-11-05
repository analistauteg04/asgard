<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\Utilities;
use app\modules\academico\models\PeriodoAcademicoMetIngreso;
use app\modules\admision\models\MetodoIngreso;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\models\ExportFile;
use yii\helpers\ArrayHelper;


class AdminmetodoingresoController extends \app\components\CController {
    public function actionIndex() {        
        $mod_periodo = new PeriodoAcademicoMetIngreso();                
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["mes"] = $data['mes'];
            $arrSearch["search"] = $data['search'];         
            
            $resp_periodo = $mod_periodo->listarPeriodos($arrSearch); 
            return $this->renderPartial('index-grid', [
                        'mod_periodo' => $resp_periodo,
            ]);
        } else {
            $resp_periodo = $mod_periodo->listarPeriodos(); 
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get(); 
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('index', [                    
                    'mod_periodo' => $resp_periodo,
        ]);
    }
    
    public function actionNewperiodo() {
        $emp_id = @Yii::$app->session->get("PB_idempresa");
        $mod_metodo = new MetodoIngreso();
        $mod_unidad = new UnidadAcademica();        
        $mod_modalidad = new Modalidad();
        
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();            
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["uaca_id"], $emp_id);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);                
            }
            if (isset($data["getmetodo"])) {
                $metodos = $mod_metodo->consultarMetodoIngNivelInt($data['uaca_id']);
                $message = array("metodos" => $metodos);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);              
            }           
        }
        $arr_unidadac = $mod_unidad->consultarUnidadAcademicasEmpresa($emp_id);
        $arr_modalidad = $mod_modalidad->consultarModalidad(1, 1);
        $arr_metodos = $mod_metodo->consultarMetodoIngNivelInt($arr_unidadac[0]["id"]);
        return $this->render('newPeriodo', [
                    "arr_unidad" => ArrayHelper::map($arr_unidadac, "id", "name"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "mes" => array("1" => Yii::t("academico", "January"), "2" => Yii::t("academico", "Febrary"), "3" => Yii::t("academico", "March"),
                        "4" => Yii::t("academico", "April"), "5" => Yii::t("academico", "May"), "6" => Yii::t("academico", "June"),
                        "7" => Yii::t("academico", "July"), "8" => Yii::t("academico", "August"), "9" => Yii::t("academico", "September"),
                        "10" => Yii::t("academico", "October"), "11" => Yii::t("academico", "November"), "12" => Yii::t("academico", "December")),                       
        ]);
    }

   

    public function actionGrabarperiodoxmetodoing() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $mes = $data["mes"];
            $anio = $data["anio"];
            $uaca = $data["uaca"];
            $ming = $data["ming"];
            $mod = $data["mod"];
            $codigo = $data["codigo"];       
            $fec_desde = $data["fecdesde"];
            $fec_hasta = $data["fechasta"];
            $usuario = @Yii::$app->user->identity->usu_id;

            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                $mod_periodo = new PeriodoAcademicoMetIngreso();                    
                $resp_verifica = $mod_periodo->VerificarPeriodo($anio, $mes, $uaca, $mod, $ming);
                if (!($resp_verifica)) {                     
                    $resp_ingreso = $mod_periodo->insertarPeriodo($anio, $mes, $uaca, $mod, $ming, $codigo, $fec_desde, $fec_hasta, $usuario);
                    if ($resp_ingreso) { 
                        $exito = 1;
                    }
                } else {
                    $mensaje = "Ya existe un período registrado con los mismos datos de año, mes, unidad, modalidad y método de ingreso.";
                }

                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada con código: ".$codigo),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionNewparalelo() {
        $pmin_id = base64_decode($_GET["pmin_id"]);
        $codigo = base64_decode($_GET["codigo"]);

        $mod_paralelo = new PeriodoAcademicoMetIngreso();
        $resp_paralelo = $mod_paralelo->listarParalelos($pmin_id);
        $periodo = "Período " . $codigo;

        return $this->render('newParalelo', [
                    "mod_paralelo" => $resp_paralelo,
                    "pmin_id" => $pmin_id,
                    "periodo" => $periodo,
        ]);
    }

    public function actionGrabarparalelo() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $nombre = ucwords(strtolower($data["nombre"])); 
            $descripcion = ucwords(strtolower($data["descripcion"])); 
            $cupo = $data["cupo"];
            $pmin_id = $data["pmin_id"];
            $usuario = @Yii::$app->user->identity->usu_id;

            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                $mod_paralelo = new PeriodoAcademicoMetIngreso();
                $resp_ingreso = $mod_paralelo->insertarParalelo($pmin_id, $nombre, $descripcion, $cupo, $usuario);
                if ($resp_ingreso) {
                    $exito = 1;
                }

                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }    

    public function actionUpdate() {
        $pmin_id = base64_decode($_GET["pmin_id"]);
        //Búsqueda de los datos del período
        $modperiodo = new PeriodoMetodoIngreso();
        $respPeriodo = $modperiodo->consultarPeriodoId($pmin_id);
        $mod_metodo = new MetodoIngreso();
        $arr_ninteres = NivelInteres::find()->select("nint_id AS id, nint_nombre AS name")->where(["nint_estado_logico" => "1", "nint_estado" => "1"])->asArray()->all();
        $arr_metodos = $mod_metodo->consultarMetodoIngNivelInt($arr_ninteres[0]["id"]);

        return $this->render('update', [
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "mes" => array("1" => Yii::t("academico", "January"), "2" => Yii::t("academico", "Febrary"), "3" => Yii::t("academico", "March"),
                        "4" => Yii::t("academico", "April"), "5" => Yii::t("academico", "May"), "6" => Yii::t("academico", "June"),
                        "7" => Yii::t("academico", "July"), "8" => Yii::t("academico", "August"), "9" => Yii::t("academico", "September"),
                        "10" => Yii::t("academico", "October"), "11" => Yii::t("academico", "November"), "12" => Yii::t("academico", "December")),
                    "mod_periodo" => $respPeriodo,
        ]);
    }

    public function actionUpdateperiodoxmetodoing() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();           
            $pmin_id = base64_decode($data["pmin_id"]);
            $anio = $data["anio"];
            $mes = $data["mes"];
            $nint = $data["nint"];
            $ming = $data["ming"];
            if (strlen($mes) == 1) {
                $mesint = "0" . $mes;
            } else {
                $mesint = $mes;
            }
            if ($ming == '1') {
                $codigo = "CAN" . $mesint . substr($anio, 2, 2);
            } else {
                $codigo = "EXA" . $mesint . substr($anio, 2, 2);
            }
            $descripcion = $data["descripcion"];
            $fec_desde = $data["fecdesde"];
            $fec_hasta = $data["fechasta"];
            $usuario_modifica = @Yii::$app->user->identity->usu_id;

            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                // ojo antes de modificar se necesita verificar que no existan datos iguales, Grace va a realizar una
                // funcion se debe utilizar esa, y tambien preferible poner esos campos unicos en la tabla
                $mod_periodo = new PeriodoMetodoIngreso();
                $resp_modifica = $mod_periodo->modificarPeriodo($pmin_id, $anio, $mes, $nint, $ming, $codigo, $descripcion, $fec_desde, $fec_hasta, $usuario_modifica);
                if ($resp_modifica) {
                    $exito = 1;
                }

                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido actualizada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al actualizar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al actualizar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }
       
    public function actionExportpdf(){
        $pdf = false;
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_periodo = new PeriodoMetodoIngreso;
        $rptData = isset($_GET['rptData']) ? base64_decode($_GET['rptData']) : NULL;
        
        if($_GET["pdf"] == 1 || $_GET["pdf"] == TRUE)
            $pdf = true;
        try{
            ini_set('memory_limit', '256M');
            $arrSearch = $resp_periodo = [];
            if($rptData){
                $data = json_decode($rptData, true);
                $arrSearch["f_ini"] = trim($data['f_ini']);
                $arrSearch["f_fin"] = trim($data['f_fin']);
                $arrSearch["mes"] = trim($data['mes']);
                $arrSearch["search"] = trim($data['search']);
            }
            if($arrSearch["f_ini"]!="" || $arrSearch["f_fin"]!="" || $arrSearch["mes"]!="" || $arrSearch["search"]!="" )
                $resp_periodo = $mod_periodo->listarPeriodos($arrSearch); 
            else
                $resp_periodo = $mod_periodo->listarPeriodos();
            // cambiar a plantilla diferente
            $this->layout = '@themes/' . Yii::$app->getView()->theme->themeName . '/layouts/pdf_rpt';
            // se exporta a pdf
            if($pdf){
                $nameFile='Documento-'. date("Ymdhis");
                $report = new ExportFile();
                // se puede enviar una vista tambien o un html
                $report->createReportPdf($this->render('solicitudpdf',[
                        'mod_periodo' => $resp_periodo
                                ]));
                $report->mpdf->Output($nameFile . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
                return;
            }

        }catch(Exception $e){
            echo $e;
        }
    }

}
