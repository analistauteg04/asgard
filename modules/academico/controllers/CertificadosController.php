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

Academico::registerTranslations();
Especie::registerTranslations();

class CertificadosController extends \app\components\CController {

    public function actionIndex() {
        return $this->render('index', [
        ]);
    }

}
