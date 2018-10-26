<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\models\Persona;
use app\models\EmpresaPersona;
use \app\modules\admision\models\SolicitudInscripcion;
use app\models\Pais;
use app\modules\admision\models\Interesado;
use app\modules\admision\models\InteresadoEmpresa;
use app\models\Usuario;
use yii\base\Security;
use app\models\UsuaGrolEper;
use app\models\Provincia;
use app\modules\financiero\models\OrdenPago;
use app\modules\financiero\models\DetalleDescuentoItem;
use app\models\Canton;
use app\models\MedioPublicitario;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use yii\helpers\Url;
use app\modules\admision\models\PersonaGestion;
use app\modules\admision\models\Oportunidad;
use app\models\Empresa;
use app\modules\admision\models\TipoOportunidadVenta;
use app\modules\admision\models\EstadoContacto;
use app\modules\admision\models\MetodoIngreso;
use app\modules\financiero\models\Secuencias;
use app\models\InscripcionAdmision;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;
use app\models\ExportFile;

academico::registerTranslations();
admision::registerTranslations();

class MatriculadosreprobadosController extends \app\components\CController {

    public function actionIndex() {
        return $this->render('index', [
        ]);
    }

    public function actionView() {
        return $this->render('view', [
        ]);
    }
    public function actionEdit() {
        return $this->render('edit', [
        ]);
    }
    
    public function actionNew() {
        $per_id = Yii::$app->session->get("PB_perid");
        $mod_persona = Persona::findIdentity($per_id);
        $mod_modalidad = new Modalidad();
        $mod_pergestion = new PersonaGestion();
        $mod_unidad = new UnidadAcademica();
        $modcanal = new Oportunidad();
        $mod_metodo = new MetodoIngreso();
        $mod_inscripcion = new InscripcionAdmision();
                
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getprovincias"])) {
                $provincias = Provincia::find()->select("pro_id AS id, pro_nombre AS name")->where(["pro_estado_logico" => "1", "pro_estado" => "1", "pai_id" => $data['pai_id']])->asArray()->all();
                $message = array("provincias" => $provincias);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getcantones"])) {
                $cantones = Canton::find()->select("can_id AS id, can_nombre AS name")->where(["can_estado_logico" => "1", "can_estado" => "1", "pro_id" => $data['prov_id']])->asArray()->all();
                $message = array("cantones" => $cantones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["getarea"])) {
                //obtener el codigo de area del pais
                $mod_areapais = new Pais();
                $area = $mod_areapais->consultarCodigoArea($data["codarea"]);
                $message = array("area" => $area);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
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
            if (isset($data["getmetodo"])) {
                $metodos = $mod_metodo->consultarMetodoUnidadAca_2($data['nint_id']);
                $message = array("metodos" => $metodos);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_pais_dom = Pais::find()->select("pai_id AS id, pai_nombre AS value")->where(["pai_estado_logico" => "1", "pai_estado" => "1"])->asArray()->all();
        $pais_id = 1; //Ecuador
        $arr_prov_dom = Provincia::provinciaXPais($pais_id);
        $arr_ciu_dom = Canton::cantonXProvincia($arr_prov_dom[0]["id"]);
        $arr_medio = MedioPublicitario::find()->select("mpub_id AS id, mpub_nombre AS value")->where(["mpub_estado_logico" => "1", "mpub_estado" => "1"])->asArray()->all();
        $arr_ninteres = $mod_unidad->consultarUnidadAcademicasEmpresa(1);
        $arr_modalidad = $mod_modalidad->consultarModalidad(1, 1);
        $arr_conuteg = $mod_pergestion->consultarConociouteg();
        $arr_carrerra1 = $modcanal->consultarCarreraModalidad(1, $arr_modalidad[0]["id"]);
        $arr_metodos = $mod_metodo->consultarMetodoUnidadAca_2($arr_ninteres[0]["id"]);
        $_SESSION['JSLANG']['Your information has not been saved. Please try again.'] = Yii::t('notificaciones', 'Your information has not been saved. Please try again.');
                
        return $this->render('new', [
                    "tipos_dni" => array("CED" => Yii::t("formulario", "DNI Document"), "PASS" => Yii::t("formulario", "Passport")),
                    "tipos_dni2" => array("CED" => Yii::t("formulario", "DNI Document1"), "PASS" => Yii::t("formulario", "Passport1")),
                    "txth_extranjero" => $mod_persona->per_nac_ecuatoriano,
                    "arr_pais_dom" => ArrayHelper::map($arr_pais_dom, "id", "value"),
                    "arr_prov_dom" => ArrayHelper::map($arr_prov_dom, "id", "value"),
                    "arr_ciu_dom" => ArrayHelper::map($arr_ciu_dom, "id", "value"),
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_medio" => ArrayHelper::map($arr_medio, "id", "value"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_conuteg" => ArrayHelper::map($arr_conuteg, "id", "name"),
                    "arr_carrerra1" => ArrayHelper::map($arr_carrerra1, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "resp_datos" => $resp_datos,
        ]);                        
    }

    public function actionSave() {
        
    }

    public function actionUpdate() {
        return $this->render('update', [
        ]);
    }

    public function actionExpexcel() {
        
    }

    public function actionExppdf() {
        
    }

}
