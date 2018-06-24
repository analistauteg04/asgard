<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use app\models\Aspirante;
use app\models\Carrera;
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
        $mod_carrera = new Carrera();
        $model = null;
        $nint_id = 1;
        $data = null;
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["codigocan"] = $data['codigocan'];
            $mod_aspirante = Aspirante::consultarAspirantes($resp_gruporol["grol_id"], $arrSearch);
            return $this->renderPartial('_listarAspirantesGrid', [
                        "model" => $mod_aspirante,                        
            ]);
        } else {
$mod_aspirante = Aspirante::consultarAspirantes($resp_gruporol["grol_id"]);

        }
        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get(); //&& $data["op"]=='1'
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]],$mod_carrera->consultarCarreraXUni($nint_id)),"id", "value");
        return $this->render('listaraspirantes', [
                    'model' => $mod_aspirante,
                    'arrCarreras' => $arrCarreras
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
        $resp_arch5 = $mod_solins->Obtenerdocumentosxsolicitud($sins_id, 5);

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
                    "arch5" => $resp_arch5['sdoc_archivo'],
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
      //$arrData = SolicitudInscripcion::ConsultarSolInteresado($per_id, $arrSearch, true);
      } else {   //vista para el jefe o agente.
      //$arrData = SolicitudInscripcion::ConsultarSolInteresado($per_ids, $arrSearch, true);
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
}
