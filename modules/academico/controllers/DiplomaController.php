<?php

namespace app\modules\academico\controllers;

use Yii;
use yii\base\Exception;
use app\modules\academico\models\Diploma;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\models\ExportFile;
use app\modules\academico\Module as academico;

academico::registerTranslations();

class DiplomaController extends \app\components\CController {

    public function actionIndex(){
        $model = new Diploma();
        $arr_carreras = array();
        $arr_modalidades = array();
        $arr_programas = array();
        $data = Yii::$app->request->get();
        if (isset($data["PBgetFilter"]) && $data["PBgetFilter"] == TRUE) {
            return $this->renderPartial('index-grid', [
                "model" => $model->getAllDiplomasGrid($data["search"], $data["carrera"], $data["programa"], $data["modalidad"]),
            ]);
        }
        $arr_carreras = ["0" => academico::t("diploma", "-- Select Career --")];
        $arr_modalidades = ["0" => academico::t("diploma", "-- Select Modality --")];
        $arr_programas = ["0" => academico::t("diploma", "-- Select Program/Course --")];
        $carreras = Diploma::find()
                    ->select(['dip_carrera'])
                    ->where(['dip_estado_logico' => '1', 'dip_estado' => '1'])
                    ->groupBy(['dip_carrera'])
                    ->asArray()
                    ->all();
        $modalidades = Diploma::find()
                    ->select(['dip_modalidad'])
                    ->where(['dip_estado_logico' => '1', 'dip_estado' => '1'])
                    ->groupBy(['dip_modalidad'])
                    ->asArray()
                    ->all();
        $programas = Diploma::find()
                    ->select(['dip_programa'])
                    ->where(['dip_estado_logico' => '1', 'dip_estado' => '1'])
                    ->groupBy(['dip_programa'])
                    ->asArray()
                    ->all();
        $arr_carreras = array_merge($arr_carreras, array_column($carreras, 'dip_carrera'));
        $arr_modalidades = array_merge($arr_modalidades, array_column($modalidades, 'dip_modalidad'));
        $arr_programas = array_merge($arr_programas, array_column($programas, 'dip_programa'));
        
        return $this->render('index', [
            'model' => $model->getAllDiplomasGrid(NULL),
            'arr_carreras' => $arr_carreras,
            'arr_programas' => $arr_programas,
            'arr_modalidades' => $arr_modalidades,
        ]);
    }

    public function actionDiplomadownload(){
        try {
            $ids = $_GET['id'];
            $this->view->title = "Aqui va el titulo del diploma"; // Titulo del reporte
            $rep = new ExportFile();
            //$this->layout = false;
            $this->layout = '@modules/academico/views/diploma/tpl_main';


            $rep->mgl = 0;
            $rep->mgr = 0;
            $rep->mgt = 0;
            $rep->mgb = 0;
            $rep->mgh = 0;
            $rep->mgf = 0;

            $rep->fontDir = __DIR__ . "/../views/diploma/fonts";
            $rep->fontdata = array(
                "GothamBook" => array(
                    'R' => 'GothamBook.ttf'
                ),
                "Blacksword" => array(
                    'R' => 'Blacksword.otf'
                ),
                "Gotham-Bold" => array(
                    'B' => 'Gotham-Bold.otf'
                ),
            );
            
            $rep->orientation = "L"; // tipo de orientacion L => Horizontal, P => Vertical   
            $rep->footer = FALSE;
            $rep->createReportPdf(
                    $this->render('@modules/academico/views/diploma/tpl_diploma', [
                        
                    ])
            );
            $rep->mpdf->Output('DIPLOMA_' . $ids . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}