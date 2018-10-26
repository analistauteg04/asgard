<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Admitido;
use app\modules\academico\models\MatriculadosReprobado;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;
use app\models\ExportFile;

academico::registerTranslations();
admision::registerTranslations();

class MatriculadosreprobadosController extends \app\components\CController {

    public function actionIndex() {
        $mod_admitido = new MatriculadosReprobado();
        $arradmitido = $mod_admitido->getMatriculados($arrSearch);
        return $this->render('index', [
            'admitido' => $arradmitido,
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
