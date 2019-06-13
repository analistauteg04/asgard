<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Admitido;
use app\modules\academico\models\EstudioAcademico;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\models\DocumentoAceptacion;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\admision\models\Oportunidad;
use app\modules\academico\Module as academico;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;
use app\models\ExportFile;
use app\modules\academico\models\OtroDocumento;
use app\models\Persona;

academico::registerTranslations();
admision::registerTranslations();
financiero::registerTranslations();

class AdmitidosController extends \app\components\CController {

    public function actionIndex() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_carrera = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["codigocan"] = $data['codigocan'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["periodo"] = $data['periodo'];
            $mod_aspirante = Admitido::getAdmitidos($arrSearch);
            return $this->renderPartial('index-grid', [
                        "model" => $mod_aspirante,
            ]);
        } else {
            $mod_aspirante = Admitido::getAdmitidos();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["nint_id"], 1);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);            
            }
            if (isset($data["getcarrera"])) {
                $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);              
            }
        }       
        $arr_ninteres = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_ninteres[0]["id"], 1);
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad($arr_ninteres[0]["id"], $arr_modalidad[0]["id"]);
        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]], $mod_carrera->consultarCarrera()), "id", "value");
        return $this->render('index', [
                    'model' => $mod_aspirante,
                    'arrCarreras' => $arrCarreras,
                    'arr_ninteres' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_ninteres), "id", "name"),
                    'arr_modalidad' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_modalidad), "id", "name"),
                    'arr_carrerra1' => ArrayHelper::map(array_merge([["id" => "0", "name" => Yii::t("formulario", "Grid")]], $arr_carrerra1), "id", "name"),
        ]);
    }

    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L");
        $arrHeader = array(
            admision::t("Solicitudes", "Request #"),
            admision::t("Solicitudes", "Application date"), //ingles
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "First Names"),
            Yii::t("formulario", "Last Names"),
            academico::t("Academico", "Income Method"), //ingles
            academico::t("Academico", "Career/Program"),
            admision::t("Solicitudes", "Scholarship"),
            academico::t("Academico", "Period")
        );
        $data = Yii::$app->request->get();
        $arrSearch = array();
        if (count($data) > 0) {
            $arrSearch["f_ini"] = $data['fecha_ini'];
            $arrSearch["f_fin"] = $data['fecha_fin'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["periodo"] = $data['periodo'];
        }
        $arrData = array();
        $admitido_model = new Admitido();
        if (count($arrSearch) > 0) {
            $arrData = $admitido_model->consultarReportAdmitidos($arrSearch, true);
        } else {
            $arrData = $admitido_model->consultarReportAdmitidos(array(), true);
        }
        \app\models\Utilities::putMessageLogFile($arrData);
        $nameReport = academico::t("Academico", "Admitted");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdf() {
        $report = new ExportFile();
        $this->view->title = academico::t("Academico", "Admitted");  // Titulo del reporte
        $arrHeader = array(
            admision::t("Solicitudes", "Request #"),
            admision::t("Solicitudes", "Application date"), //ingles
            Yii::t("formulario", "DNI 1"),
            Yii::t("formulario", "First Names"),
            Yii::t("formulario", "Last Names"),
            academico::t("Academico", "Income Method"), //ingles
            academico::t("Academico", "Career/Program"),
            admision::t("Solicitudes", "Scholarship"),
            academico::t("Academico", "Period")
        );
        $data = Yii::$app->request->get();
        $arrSearch = array();
        if (count($data) > 0) {
            $arrSearch["f_ini"] = $data['fecha_ini'];
            $arrSearch["f_fin"] = $data['fecha_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["periodo"] = $data['periodo'];
        }
        $arrData = array();
        $admitido_model = new Admitido();
        if (count($arrSearch) > 0) {
            $arrData = $admitido_model->consultarReportAdmitidos($arrSearch, true);
        } else {
            $arrData = $admitido_model->consultarReportAdmitidos(array(), true);
        }
        $report->orientation = "L"; // tipo de orientacion L => Horizontal, P => Vertical                                
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arrHeader,
                    'arr_body' => $arrData
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
    }
    
    public function actionSubirotrosdocumentos() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $modperinteresado = new Persona();
        $datosPersona = $modperinteresado->consultaPersonaId($per_id);
        return $this->render('subirOtrosDocumentos', [                    
                    "datos" => $datosPersona,
        ]);
    }

    public function actionSaveotrosdocumentos(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();            
            $per_id = @Yii::$app->session->get("PB_perid");   //base64_decode($data['persona_id']);            
            $usr_id =  @Yii::$app->session->get("PB_iduser");         
            $observacion = ucwords(mb_strtolower($data["observa"]));
            if ($data["upload_file"]) {
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                }
                //Recibe Parámetros.
                $files = $_FILES[key($_FILES)];
                $arrIm = explode(".", basename($files['name']));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $dirFileEnd = Yii::$app->params["documentFolder"] . "otrodocumento/" . $per_id . "/" . $data["name_file"] . "_per_" . $per_id . "." . $typeFile;
                $status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);
                if ($status) {
                    return true;
                } else {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                }                
                $carta_archivo = "";
                if (isset($data["arc_doc_carta"]) && $data["arc_doc_carta"] != "") {
                    $arrIm = explode(".", basename($data["arc_doc_carta"]));
                    $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                    $carta_archivo = Yii::$app->params["documentFolder"] . "otrodocumento/" . $per_id . "/doc_certune_per_" . $per_id . "." . $typeFile;
                }
            }
        }        
        $con = \Yii::$app->db_academico;
        $transaction = $con->beginTransaction();
        $timeSt = time();
        try {
            if (isset($data["arc_doc_carta"]) && $data["arc_doc_carta"] != "") {
                $arrIm = explode(".", basename($data["arc_doc_carta"]));
                $typeFile = strtolower($arrIm[count($arrIm) - 1]);
                $carta_archivo = Yii::$app->params["documentFolder"] . "otrodocumento/" . $per_id . "/doc_certune_per_" . $per_id . "." . $typeFile;
                $carta_archivo = DocumentoAdjuntar::addLabelTimeDocumentos($per_id, $carta_archivo, $timeSt);
                if ($carta_archivo === FALSE)
                    throw new Exception('Error doc Carta UNE no renombrado.');
            }
          
            $datos = array(                        
                        'per_id'  => $per_id,
                        'dadj_id'  => 8,
                        'odoc_archivo'  => $carta_archivo,
                        'odoc_observacion'  => $observacion, 
                        'odoc_usuario_ingreso'  => $usr_id,                         
                    );                                               
            $mod_documento = new OtroDocumento();
            $respuesta = $mod_documento->insertar($con, $datos);
            if ($respuesta){
                $exito=1;
            }
            if ($exito) {
                $transaction->commit();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "El documento ha sido grabado."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
        } catch (Exception $ex) {
            $transaction->rollback();
            $message = array(
                "wtmessage" => $ex->getMessage(),
                "title" => Yii::t('jslang', 'Error'),
            );
            return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Error"), false, $message);
        }           
    }
    public function actionValidarcarta() {
        $per_ses__id = @Yii::$app->session->get("PB_perid");
        $per_id = base64_decode($_GET["per_id"]);
        $mod_doc_ac= new DocumentoAceptacion();
        $resp_gruporol = $mod_doc_ac->consultaDocumentoAceptacionByPerId($per_id);
        $gruporol = 19;# 19 o 20
        if ($resp_cliord) {
            $persona_pago = $resp_cliord["per_id"];
            $sins_id = $resp_cliord["sser_id"];
            $nombres = $resp_cliord["nombres"];
            $apellidos = $resp_cliord["apellidos"];
            $valortotal = $resp_cliord["valortotal"];
            $valoraplicado = $resp_cliord["valoraplicado"];
            $rol = $resp_cliord["rol"];
        }
        $mod_pago = new OrdenPago();
        $resp_pago = $mod_pago->listarPagosadmxsolicitud($gruporol, $opag_id, $persona_pago);
        $data = null;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('validarpcarta', [
                    'model' => $resp_pago,
                    'persona_pago' => $persona_pago,
                    'sins_id' => $sins_id,
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'valortotal' => $valortotal,
                    'valoraplicado' => $valoraplicado,
                    'opag_id' => $opag_id,
                    'rol' => $rol,
                    'respCliente' => $resp_cliord,
        ]);
    }
}
