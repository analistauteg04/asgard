<?php

namespace app\modules\formulario\controllers;

use Yii;
use app\modules\formulario\models\PersonaFormulario;
use yii\helpers\ArrayHelper;
use app\models\ExportFile;
use app\models\Utilities;
use app\modules\academico\models\UnidadAcademica;
//use app\modules\piensaecuador\Module as piensaecuador;
//piensaecuador::registerTranslations();

class RegistroController extends \app\components\CController {

    public function actionIndex() {
        $mod_PersForm = new PersonaFormulario();
        $mod_unidad = new UnidadAcademica();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getcarrera"])) {
                $uaca_id = $data["uaca_id"];
                $carrera_programa = $mod_PersForm->consultarCarreraProgXUnidad($uaca_id);   
                $message = array("carr_prog" => $carrera_programa);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);                
            }                               
        }        
            
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["unidad"] = $data['unidad'];
            $arrSearch["carrera"] = $data['carrera'];
            $arrSearch["search"] = $data['search'];            
            $respForm = $mod_PersForm->getAllPersonaFormGrid($arrSearch, false);
            return $this->renderPartial('index-grid', [
                        "model" => $respForm,
            ]);
        }
        
        $arr_unidad_Uteg = $mod_unidad->consultarUnidadAcademicasxUteg();   
        $arr_carrera_prog = $mod_PersForm->consultarCarreraProgXUnidad(1); 
        return $this->render('index', [
            'model' => $mod_PersForm->getAllPersonaFormGrid(NULL, false),   
            "arr_unidad" => ArrayHelper::map($arr_unidad_Uteg, "id", "name"),
            "arr_carrera_prog" => ArrayHelper::map($arr_carrera_prog, "id", "name"),
        ]);
    }

    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R","S");
        $arrHeader = array(
            'Id',
            Yii::t("formulario", "Names"),
            Yii::t("formulario", 'Last Names'),
            Yii::t("formulario", "Dni"),
            Yii::t("perfil", 'Email'),
            Yii::t("perfil", 'CellPhone'),
            Yii::t("perfil", 'Phone'),
            Yii::t("perfil", 'Sex'),
            Yii::t("perfil", 'Birth Date'),
            Yii::t("general", 'State'),
            Yii::t("general", 'City'),
            //piensaecuador::t("interes", 'Event'),
            piensaecuador::t("interes", 'Instruction Level'),
            piensaecuador::t("interes", 'Activity'),
            piensaecuador::t("interes", 'Occupation'),
            piensaecuador::t("interes",'Registry Date'),
            Yii::t("general", "Status")
        );
        $model = new PersonaExterna();
        $data = Yii::$app->request->get();
        $arrData = $queryData = array();
        $arrSearch["search"] = $data['search'];
        if (empty($arrSearch)) {
            $arrData = $model->getAllPersonaExtGrid(NULL, false);
            $queryData = $model->getAllInteresByPersona(NULL);
        } else {
            $arrData = $model->getAllPersonaExtGrid($data["search"], false);
            $queryData = $model->getAllInteresByPersona($data["search"]);
        }
        
        foreach($arrData as $key => $value){
            $pext_id = $value['id'];
            $keys = array_keys(array_column($queryData, 'id'), $pext_id);
            
            $cont = 0;
            $newValue = "";
            foreach($keys as $key2 => $value2){
                $id = $value2;
                $newValue .= $queryData[$id]['interes'];
                $cont++;
                if(count($keys) > $cont)
                    $newValue .= " | ";
            }
            $arrData[$key]['NivelInteresId'] = $newValue;
        }

        $nameReport = piensaecuador::t("interes", "Registries");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdf() {
        $report = new ExportFile();
        $model = new PersonaExterna();
        $this->view->title = piensaecuador::t("interes", "Registries"); // Titulo del reporte
        $arrHeader = array(
            'Id',
            Yii::t("formulario", "Names"),
            Yii::t("formulario", 'Last Names'),
            Yii::t("formulario", "Dni"),
            Yii::t("perfil", 'Email'),
            Yii::t("perfil", 'CellPhone'),
            Yii::t("perfil", 'Phone'),
            Yii::t("perfil", 'Sex'),
            Yii::t("perfil", 'Birth Date'),
            Yii::t("general", 'State'),
            Yii::t("general", 'City'),
            //piensaecuador::t("interes", 'Event'),
            piensaecuador::t("interes", 'Instruction Level'),
            piensaecuador::t("interes", 'Activity'),
            piensaecuador::t("interes", 'Occupation'),
            piensaecuador::t("interes",'Registry Date'),
            Yii::t("general", "Status")
        );
        $data = Yii::$app->request->get();
        $arrData = $queryData = array();
        $arrSearch["search"] = $data['search'];
        if (empty($arrSearch)) {
            $arrData = $model->getAllPersonaExtGrid(NULL, false);
            $queryData = $model->getAllInteresByPersona(NULL);
        } else {
            $arrData = $model->getAllPersonaExtGrid($data["search"], false);
            $queryData = $model->getAllInteresByPersona($data["search"]);
        }

        foreach($arrData as $key => $value){
            $pext_id = $value['id'];
            $keys = array_keys(array_column($queryData, 'id'), $pext_id);
            
            $cont = 0;
            $newValue = "";
            foreach($keys as $key2 => $value2){
                $id = $value2;
                $newValue .= $queryData[$id]['interes'];
                $cont++;
                if(count($keys) > $cont)
                    $newValue .= " | ";
            }
            $arrData[$key]['NivelInteresId'] = $newValue;
        }

        $report->orientation = "L"; // tipo de orientacion L => Horizontal, P => Vertical                                
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arrHeader,
                    'arr_body' => $arrData
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
    }


}
