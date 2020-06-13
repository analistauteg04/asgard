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

use app\modules\financiero\Module as financiero;
use app\modules\admision\Module as admision;
use app\modules\academico\Module as academico;

admision::registerTranslations();
academico::registerTranslations();

class PagosFacturasController extends \app\components\CController {

    
}
