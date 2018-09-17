<?php

namespace app\modules\admision\controllers;

use app\modules\admision\models\SolicitudInscripcion;
use app\modules\admision\models\MetodoIngreso;
use app\modules\admision\models\EstudioAcademico;
use app\modules\admision\models\Modalidad;
use app\modules\admision\models\Oportunidad;
use app\modules\admision\models\ModuloEstudio;
use app\modules\admision\models\ItemMetodoNivel;
use app\modules\admision\models\DetalleDescuentoItem;
use app\modules\admision\models\Persona;
use app\modules\admision\models\UnidadAcademica;
use yii\helpers\ArrayHelper;
use Yii;

class SolicitudesController extends \app\components\CController {

    public function actionIndex() {
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

    public function actionView() {
        
    }

    public function actionEdit() {
        
    }

    public function actionNew() {
        $mod_metodo = new MetodoIngreso();
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_persona = Persona::findIdentity($per_id);
        $mod_carrera = new EstudioAcademico();
        $mod_modalidad = new Modalidad();
        $modcanal = new Oportunidad();
        $modestudio = new ModuloEstudio();
        $modItemMetNivel = new ItemMetodoNivel();
        $modDescuento = new DetalleDescuentoItem();
        $modUnidad = new UnidadAcademica();

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmetodo"])) {
                $metodos = $mod_metodo->consultarMetodoIngNivelInt($data['nint_id']);
                $message = array("metodos" => $metodos);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getmodalidad"])) {
                \app\models\Utilities::putMessageLogFile('nivel interes: ' . $data["nint_id"]);
                $modalidad = $mod_modalidad->consultarModalidad($data["nint_id"]);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getcarrera"])) {
                if ($data["unidada"] < 3) {
                    $carrera = $modcanal->consultarCarreraModalidad($data["unidada"], $data["moda_id"]);
                } else {
                    $carrera = $modestudio->consultarCursoModalidad($data["unidada"], $data["moda_id"]);
                }
                $message = array("carrera" => $carrera);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
            if (isset($data["getdescuento"])) {
                $resItem = $modItemMetNivel->consultarXitemMetniv($data["unidada"], $data["moda_id"], $data["metodo"]);
                $descuentos = $modDescuento->consultarDesctoxitem($resItem["ite_id"]);
                $message = array("descuento" => $descuentos);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                return;
            }
        }
        $arr_unidadac = $modUnidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad(1);
        $arr_metodos = $mod_metodo->consultarMetodoIngNivelInt($arr_unidadac[0]["id"]);
        $arr_carrera = $modcanal->consultarCarreraModalidad(1, 1);
        //Descuentos.
        $resp_item = $modItemMetNivel->consultarXitemMetniv(1, 1, 1);
        $arr_descuento = $modDescuento->consultarDesctoxitem($resp_item["ite_id"]);
        return $this->render('new', [
                    "arr_unidad" => ArrayHelper::map($arr_unidadac, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "txth_extranjero" => $mod_persona->per_nac_ecuatoriano,
                    "arr_carrera" => ArrayHelper::map($arr_carrera, "id", "name"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "arr_descuento" => ArrayHelper::map($arr_descuento, "id", "name"),
                    "item" => $resp_item["ite_id"]
        ]);
    }

    public function actionSave() {
        
    }

    public function actionUpdate() {
        
    }

}
