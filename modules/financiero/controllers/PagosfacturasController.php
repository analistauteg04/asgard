<?php

namespace app\modules\financiero\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\ExportFile;
use app\models\Persona;
use app\models\Usuario;
use yii\helpers\Url;
use yii\base\Exception;
use yii\base\Security;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\ModuloEstudio;
use app\modules\financiero\models\PagosFacturaEstudiante;
use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;

admision::registerTranslations();
academico::registerTranslations();

class PagosfacturasController extends \app\components\CController {
 private function estados() {
        return [
            '0' => Yii::t("formulario", "Todos"),
            '1' => Yii::t("formulario", "Pendiente"),
            '2' => Yii::t("formulario", "Aprobado"),
            '3' => Yii::t("formulario", "Rechazado"),            
        ];
    }
 public function actionRevisionpagos() {
        $mod_pagos = new PagosFacturaEstudiante();
        $mod_unidad = new UnidadAcademica();
        $mod_modalidad = new Modalidad();
        $modestudio = new ModuloEstudio();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmodalidad"])) {
                if (($data["unidad"] == 1) or ( $data["unidad"] == 2)) {
                    $modalidad = $mod_modalidad->consultarModalidad($data["unidad"], 1);
                } else {
                    $modalidad = $modestudio->consultarModalidadModestudio();
                }
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["modalidad"] = $data['modalidad'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["estadopago"] = $data['estadopago'];
            $resp_pago= $mod_pagos->getPagos($arrSearch, false);
            return $this->renderPartial('_index-grid_revisionpago', [
                        "model" => $resp_pago,
            ]);
        }
        $model = $mod_pagos->getPagos(null, false);
        $arr_unidadac = $mod_unidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidadac[0]["id"], 1);
        return $this->render('index_revisionpago', [
                    'model' => $model,                    
                    'arr_unidad' => ArrayHelper::map($arr_unidadac, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($arr_modalidad, "id", "name"),
                    'arr_estado' => $this->estados(),
        ]);
    }
    
    public function actionViewsaldo() {
        $per_idsession = @Yii::$app->session->get("PB_perid");
        $especiesADO = new Especies();
        $mod_unidad = new UnidadAcademica();
        $mod_modalidad = new Modalidad();
        $modestudio = new ModuloEstudio();
        $modcanal = new Oportunidad();
        $personaData = $especiesADO->consultaDatosEstudiante($per_idsession);
        $arr_unidadac = $mod_unidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad($personaData['uaca_id'], 1);
        if (($personaData['uaca_id'] == 1) or ( $personaData['uaca_id'] == 2)) {
            $carrera = $modcanal->consultarCarreraModalidad($personaData['uaca_id'], $personaData['mod_id']);
        } else {
            $carrera = $modestudio->consultarCursoModalidad($personaData['uaca_id'], $personaData['mod_id']); // tomar id de impresa
        }
        return $this->render('viewsaldo', [
                    'arr_persona' => $personaData,
                    'arr_unidad' => ArrayHelper::map($arr_unidadac, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($arr_modalidad, "id", "name"),
                    'arr_carrera' => ArrayHelper::map($carrera, "id", "name"),
        ]);
    }
    
    public function actionRechazar() {
        $cgen_id = base64_decode($_GET["cgen_id"]);
        $mod_certificado = new CertificadosGeneradas();
        $mod_unidad = new UnidadAcademica();
        $mod_modalidad = new Modalidad();                        
                
        $model = $mod_certificado->consultarCertificadosGeneradas($cgen_id);
        $arr_unidadac = $mod_unidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidadac[0]["id"], 1);
        return $this->render('rechazar', [
                    'model' => $model,                    
                    'arr_unidad' => ArrayHelper::map($arr_unidadac, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($arr_modalidad, "id", "name"),                    
                    'arrObservacion' => array("0" => "Seleccione una opción", "Archivo Ilegible" => "Archivo Ilegible", "Archivo no corresponde al pago" => "Archivo no corresponde al pago", "Archivo con Error" => "Archivo con Error"),
        ]);
    }
}
