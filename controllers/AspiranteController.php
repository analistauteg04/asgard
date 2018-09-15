<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use app\models\Aspirante;
use app\models\EstudioAcademico;
use app\models\Interesado;
use app\models\Persona;
use app\models\SolicitudInscripcion;
use app\models\SolicitudinsDocumento;
use app\models\OrdenPago;
use yii\helpers\ArrayHelper;

class AspiranteController extends \app\components\CController {
    public function actionListaraspirantes() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $model_interesado = new Interesado();
        $resp_gruporol = $model_interesado->consultagruporol($per_id); 
        $mod_carrera = new EstudioAcademico();
        $model = null;
        $fac_id = 1;
        $data = null;
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["codigocan"] = $data['codigocan'];
            $mod_aspirante = Aspirante::getAspirantes($resp_gruporol["grol_id"], $arrSearch);

            return $this->renderPartial('_listaraspirantes_grid', [
                        "model" => $mod_aspirante,                        
            ]);
        } else {
            $mod_aspirante = Aspirante::getAspirantes($resp_gruporol["grol_id"]);
        }
        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get(); //&& $data["op"]=='1'
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]],$mod_carrera->consultarCarrera()),"id", "value");
        return $this->render('listaraspirantes', [
                    'model' => $mod_aspirante,
                    'arrCarreras' => $arrCarreras,                   
        ]);
    }
    
    public function actionDocumentosaspirantes() {       
        $per_id = base64_decode($_GET['perid']);
        $apellidos = base64_decode($_GET['apellidos']);
        $nombres = base64_decode($_GET['nombres']);   
        $sins_id = base64_decode($_GET['sol_id']); 
        $mod_persona = Persona::findIdentity($per_id);
        $nacionalidad = $mod_persona->per_nac_ecuatoriano;       
       
        $mod_ordenpago = new OrdenPago();
        $resp_ordenpago = $mod_ordenpago->consultarImagenpago($sins_id);
        $imagen = $resp_ordenpago["imagen_pago"];
        
        $mod_solins = new SolicitudInscripcion();
        $resp_arch1 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 1);
        $resp_arch2 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 2);
        $resp_arch3 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 3);
        $resp_arch4 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 4);

        if ($nacionalidad == '1') {
            $tiponacext = 'N';
        } else {
            $tiponacext = 'E';
        }
    
        return $this->render('documentosaspirantes', [
                    "revision" => array("3" => Yii::t("formulario", "Pre Approved"), "4" => Yii::t("formulario", "Not approved")),
                    "apellidos" => $apellidos,
                    "nombres" => $nombres,
                    "txth_extranjero" => $nacionalidad,
                    "sins_id" => $sins_id,
                    "per_id" => $per_id,                   
                    "arch1" => $resp_arch1['sdoc_archivo'],
                    "arch2" => $resp_arch2['sdoc_archivo'],
                    "arch3" => $resp_arch3['sdoc_archivo'],
                    "arch4" => $resp_arch4['sdoc_archivo'],
                    "imagen" => $imagen,
        ]);
    }

    /* public function actionExpexcel() {
      $per_id = @Yii::$app->session->get("PB_perid");
      $data = Yii::$app->request->get();
      $per_ids = base64_decode($data['ids']);
      $arrSearch["search"] = $data["search"];
      $arrSearch["carrera"] = $data["carrera"];
      $arrSearch["f_ini"] = $data["f_ini"];
      $arrSearch["f_fin"] = $data["f_fin"];
      $arrData = array();
      if (empty($per_ids)) {  //vista para el interesado
      //$arrData = SolicitudInscripcion::getSolicitudesXInteresado($per_id, $arrSearch, true);
      } else {   //vista para el jefe o agente.
      //$arrData = SolicitudInscripcion::getSolicitudesXInteresado($per_ids, $arrSearch, true);
      }

      $nombarch = "InscripcionReport-" . date("YmdHis");
      $content_type = Utilities::mimeContentType("xls");
      header("Content-Type: $content_type");
      header("Content-Disposition: attachment;filename=" . $nombarch . ".xls");
      header('Cache-Control: max-age=0');
      $arrHeader = array(
      Yii::t("formulario", "Request #"),
      Yii::t("solicitud_ins", "Application date"),
      Yii::t("formulario", "DNI 1"),
      Yii::t("formulario", "First Names"),
      Yii::t("formulario", "Last Names"),
      Yii::t("solicitud_ins", "Level Inter"),
      Yii::t("solicitud_ins", "Income Method"),
      Yii::t("academico", "Career"),
      Yii::t("formulario", "Status"),
      "Pago");
      $nameReport = yii::t("formulario", "Application Reports");
      $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L");
      Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
      return;
      } */
    
        
    // estado_contacto     ->    Estado del Contacto
    // estado_oportunidad  ->    Estado de Oportunidad
    // oportunidad_perdida ->    Estado de Oportunidad Perdida
    // modalidad           ->    Modalidad Academica
    
    public function actionExport(){
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch . ".xls");
        header('Cache-Control: max-age=0');
        
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K");
        $arrHeader = array("#","Grado Lead","Online Lead","Posgrado Lead","Base Grado","Base Online","Base Posgrado","Suma","Promedio");
        $arrDataCols = ["En Contacto", "Calificado", "No Calificado"];
        //$arrDataCols = ["En curso", "En espera", "Ganada", "Perdida", "Listo para pago", "Total"];
        //$arrDataCols = ["Precio", "Insatisfacción con malla académica", "No existe carrera", "Calidad de docentes", "Atención recibida", "Ubicación", "Otra Universidad", "Modalidad de Estudios", "Motivo personal", "Viaje imprevisto", "No contesta el teléfono ni correos"];
        $arrData = array();
        for($i=0; $i<count($arrDataCols); $i++){
            $j=0;
            for($j=0; $j<count($arrHeader); $j++){
                if($j == 0){
                    $arrData[$i][$j] = $arrDataCols[$i];
                }else {
                    $arrData[$i][$j] = "data $i $j";
                } 
            }
        }
        $nameReport = yii::t("formulario", "Application Reports");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }
}
