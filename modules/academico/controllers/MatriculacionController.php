<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Aspirante;
use app\modules\academico\models\EstudioAcademico;
use app\modules\admision\models\Interesado;
use yii\helpers\ArrayHelper;


class MatriculacionController extends \app\components\CController {
    public function actionIndex() {
    return $this->render('index', [
           
        ]);    
    }

    public function actionNewhomologacion() {
    return $this->render('newHomologacion', [
           
        ]);    
    }
    
    public function actionNew() {
    return $this->render('new', [
           
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
    return $this->render('save', [
           
        ]);    
    }
    public function actionUpdate() {
    return $this->render('update', [
           
        ]);    
    }
}