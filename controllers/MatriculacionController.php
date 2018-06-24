<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\MetodoIngreso;
use app\models\NivelInteres;
use app\models\PeriodoMetodoIngreso;
use app\models\Carrera;
use app\models\Aspirante;
/** 
 * @author Grace Viteri
 **/

class MatriculacionController extends \app\components\CController {
    
    public function actionListar_aspiranteperiodometodoingreso() {
        $mod_metodo = new MetodoIngreso();
        $arr_ninteres = NivelInteres::find()->select("nint_id AS id, nint_nombre AS name")->where(["nint_estado_logico" => "1", "nint_estado" => "1"])->asArray()->all();
        $arr_metodos = $mod_metodo->obtenerMetodoIngXNivelInt($arr_ninteres[0]["id"]);        
        $resp_periodo = PeriodoMetodoIngreso::find()->select("pmin_id AS id, pmin_codigo AS name")->where(["pmin_estado_logico" => "1", "pmin_estado" => "1"])->asArray()->all();
        $mod_aspirante = Aspirante::consultarAspirantes(1);
        
        return $this->render('listar_aspiranteperiodometodoingreso', [
                            "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                            "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),                           
                            "mod_periodo" =>ArrayHelper::map($resp_periodo, "id", "name"), 
                            "model" => $mod_aspirante,
        ]); 
    }
    
    public function actionListar_aspirantes_matricular() {

        $mod_aspirante = Aspirante::consultarAspirantes(1);
        $mod_carrera = new Carrera();
        $fac_id = 1;
        $arrCarreras = ArrayHelper::map(array_merge([["id" => "0", "value" => Yii::t("formulario", "Grid")]],$mod_carrera->obtenerCarreraXFacu($fac_id)),"id", "value");
        return $this->render('listar_aspirantes_matricular', [
                    "model" => $mod_aspirante,
                    "carreras" => $arrCarreras,
        ]); 
    }
    
    public function actionResultado_admision() {
        $asp_id = base64_decode($_GET['asp_id']);  
        $nombres = base64_decode($_GET['nombres']);  
        $apellidos = base64_decode($_GET['apellidos']);  
        $carrera = base64_decode($_GET['carrera']);  
        
        $data = Yii::$app->request->get();
        
        return $this->render('resultado_admision', [
                            "nombres" => $nombres,
                            "apellidos" => $apellidos,
                            "carrera" => $carrera,
                            "resultado" => array("1" => Yii::t("academico", "Aprobado"), "2" => Yii::t("academico", "No Aprobado")),
        ]); 
    }
    
    public function actionMatricular() {
        $asp_id = base64_decode($_GET['asp_id']);  
        $nombres = base64_decode($_GET['nombres']). " " . base64_decode($_GET['apellidos']);          
        $carrera = base64_decode($_GET['carrera']);  
        
        $data = Yii::$app->request->get();
        
        return $this->render('matricular', [
                            "nombres" => $nombres,                            
                            "carrera" => $carrera,
                            "periodo" => array("1" => Yii::t("academico", "2018 (Abril-Agosto) - B1"), "2" => Yii::t("academico", "2018 (Abril-Agosto) - B2")),
                            "bloque" => array("1" => Yii::t("academico", "Bloque I"), "2" => Yii::t("academico", "Bloque II"), "3" => Yii::t("academico", "Ambos")),
            ]); 
    }
}

