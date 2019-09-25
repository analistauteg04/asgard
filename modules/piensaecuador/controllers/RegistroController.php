<?php

namespace app\modules\piensaecuador\controllers;

use Yii;
use app\modules\piensaecuador\models\PersonaExterna;
use app\models\ExportFile;
use app\models\Utilities;
use app\modules\piensaecuador\Module as piensaecuador;
piensaecuador::registerTranslations();

class RegistroController extends \app\components\CController {

    public function actionIndex() {
        $model = new PersonaExterna();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["search"])) {
                return $this->renderPartial('index-grid', [
                    "model" => $model->getAllPersonaExtGrid($data["search"], true)
                ]);
            }
        }
        return $this->render('index', [
            'model' => $model->getAllPersonaExtGrid(NULL, true)
        ]);
    }

    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N");
        $arrHeader = array(
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
            piensaecuador::t("interes", 'Activity'),
            piensaecuador::t("interes",'Registry Date')
        );
        $modPersonaGestion = new PersonaGestion();
        $data = Yii::$app->request->get();
        $arrSearch["search"] = $data['search'];        
        $arrSearch["f_ini"] =  $data['f_ini'];
        $arrSearch["f_fin"] =  $data['f_fin'];
        $arrSearch["medio"] =  $data['medio'];
        $arrSearch["agente"] = $data['agente'];
        $arrSearch["correo"] = $data['correo'];
        $arrSearch["telefono"] = $data['telefono'];
        $arrSearch["empresa"] = $data['empresa'];
        $arrSearch["unidad"] = $data['unidad'];
        $arrSearch["gestion"] = $data['gestion'];
        $arrData = array();
        if (empty($arrSearch)) {
            $arrData = $modPersonaGestion->consultarReportContactos(array(), true);
        } else {
            $arrData = $modPersonaGestion->consultarReportContactos($arrSearch, true);
        }
        $nameReport = admision::t("crm", "Contacts");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdf() {
        $report = new ExportFile();
        $this->view->title = admision::t("crm", "Contacts"); // Titulo del reporte
        $arrHeader = array(
            Yii::t("crm", "Contact"),
            Yii::t("formulario", "Country"),
            Yii::t("formulario", "Email"),
            Yii::t("formulario", "CellPhone"),
            Yii::t("formulario", "Phone"),
            Yii::t("formulario", "Date"),
            Yii::t("formulario", "Academic unit"),
            admision::t("crm", "Channel"),
            Yii::t("formulario", "User login"),
            Yii::t("formulario", "Open Opportunities"),
            Yii::t("formulario", "Close Opportunities"),
            Yii::t("formulario", "Management State")
        );
        $modPersonaGestion = new PersonaGestion();
        $data = Yii::$app->request->get();
        $arrSearch["search"] = $data['search'];
        $arrSearch["medio"] = $data['medio'];
        $arrSearch["f_ini"] = $data['f_ini'];
        $arrSearch["f_fin"] = $data['f_fin'];
        $arrSearch["agente"] = $data['agente'];
        $arrSearch["correo"] = $data['correo'];
        $arrSearch["telefono"] = $data['telefono'];
        $arrSearch["empresa"] = $data['empresa'];
        $arrSearch["unidad"] = $data['unidad'];
        $arrSearch["gestion"] = $data['gestion'];
        $arrData = array();
        if (empty($arrSearch)) {
            $arrData = $modPersonaGestion->consultarReportContactos(array(), true);
        } else {
            $arrData = $modPersonaGestion->consultarReportContactos($arrSearch, true);
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