<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\Utilities;
use app\models\ExportFile;
use app\models\Persona;
use yii\helpers\Url;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use app\modules\financiero\models\FormaPago;
use app\modules\academico\models\ModuloEstudio;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\Module as academico;
use app\modules\academico\models\Especies;
use app\models\Empresa;
use app\modules\academico\Module as Especie;
use app\modules\academico\models\CertificadosGeneradas;
use app\modules\academico\Module as certificados;

certificados::registerTranslations();

Academico::registerTranslations();
Especie::registerTranslations();

class CertificadosController extends \app\components\CController {

    private function estadoPagos() {
        return [
            '0' => Yii::t("formulario", "Todos"),
            '1' => Yii::t("formulario", "Pendiente"),
            '2' => Yii::t("formulario", "Pago Solicitud - Rechazado"),
            '3' => Yii::t("formulario", "Generado"),
        ];
    }

    public function actionIndex() {
        $mod_certificado = new CertificadosGeneradas();
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
        $model = $mod_certificado->getCertificadosGeneradas(null, false);
        $arr_unidadac = $mod_unidad->consultarUnidadAcademicas();
        $arr_modalidad = $mod_modalidad->consultarModalidad($arr_unidadac[0]["id"], 1);
        return $this->render('index', [
                    'model' => $model,                    
                    'arrEstados' => $this->estadoPagos(),
                    'arr_unidad' => ArrayHelper::map($arr_unidadac, "id", "name"),
                    'arr_modalidad' => ArrayHelper::map($arr_modalidad, "id", "name"),
                    'arr_estadocertificado' => array("-1" => "Seleccionar", "0" => "Código Generado", "1" => "Certificado Generado"),
        ]);
    }

}
