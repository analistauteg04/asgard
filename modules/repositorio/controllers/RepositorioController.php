<?php

namespace app\modules\repositorio\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Utilities;
use yii\helpers\ArrayHelper;
use app\models\Empresa;
use app\models\ExportFile;
use \app\models\Persona;
use \app\modules\repositorio\models\DocumentoRepositorio;
use \app\modules\repositorio\models\Funcion;
use \app\modules\repositorio\models\Componente;
use \app\modules\repositorio\models\Modelo;
use \app\modules\repositorio\models\Estandar;
use app\modules\repositorio\Module as repositorio;

class RepositorioController extends \app\components\CController {

    public function actionIndex() {
        $mod_repositorio = new DocumentoRepositorio();
        $mod_categoria = new Funcion();
        $mod_componente = new Componente();
        $mod_modelo = new Modelo();
        $mod_estandar = new Estandar();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["est_id"] = $data['est_id'];
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["search"] = $data['search'];
            $arrSearch["mod_id"] = $data['mod_id'];
            $arrSearch["cat_id"] = $data['cat_id'];
            $arrSearch["comp_id"] = $data['comp_id'];
            $resp_listado = $mod_repositorio->consultarDocumentos($arrSearch);
        } else {
            $resp_listado = $mod_repositorio->consultarDocumentos();
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["get_funciones"])) {
                $resp_funciones = $mod_categoria->consultarFuncion($data["mod_id"]);
                $message = array("funciones" => $resp_funciones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["get_componentes"])) {
                //\app\models\Utilities::putMessageLogFile('fun_id:' . $data["fun_id"]);
                $resp_componente = $mod_componente->consultarComponente($data["fun_id"]);
                $message = array("componentes" => $resp_componente);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["get_estandares"])) {
                $resp_estandares = $mod_estandar->consultarEstandar($data["fun_id"], $data["comp_id"]);
                $message = array("estandares" => $resp_estandares);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_modelo = $mod_modelo->consultarModelo();
        $arr_categoria = $mod_categoria->consultarFuncion(2);
        $arr_componente = $mod_componente->consultarComponente(1);
        $arr_estandar = $mod_estandar->consultarEstandar(1, 1);
        return $this->render('index', [
                    'arr_modelo' => ArrayHelper::map(array_merge([["id" => "0", "value" => "Todos"]], $arr_modelo), "id", "value"),
                    'arr_categoria' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todos"]], $arr_categoria), "id", "name"), //array("1" => Yii::t("formulario", "Docencia"), "2" => Yii::t("formulario", "Condiciones Institucionales")),
                    'arr_componente' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todos"]], $arr_componente), "id", "name"),
                    'arr_estandar' => ArrayHelper::map(array_merge([["id" => "0", "name" => "Todos"]], $arr_estandar), "id", "name"),
                    'model' => $resp_listado,
        ]);
    }

    public function actionCargar() {
        $mod_componente = new Componente();
        $mod_modelo = new Modelo();
        $mod_estandar = new Estandar();
        $mod_funcion = new Funcion();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["get_funciones"])) {
                $resp_funciones = $mod_categoria->consultarFuncion($data["mod_id"]);
                $message = array("funciones" => $resp_funciones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["get_funciones"])) {
                $resp_funciones = $mod_funcion->consultarFuncion($data["mod_id"]);
                $message = array("funciones" => $resp_funciones);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["get_componentes"])) {
                //\app\models\Utilities::putMessageLogFile('fun_id:' . $data["fun_id"]);
                $resp_componente = $mod_componente->consultarComponente($data["fun_id"]);
                $message = array("componentes" => $resp_componente);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
            if (isset($data["get_estandares"])) {
                $resp_estandares = $mod_estandar->consultarEstandar($data["fun_id"], $data["comp_id"]);
                $message = array("estandares" => $resp_estandares);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_componente = $mod_componente->consultarComponente(1);
        $arr_funcion = $mod_funcion->consultarFuncion(2);
        $arr_modelo = $mod_modelo->consultarModelo();
        $arr_estandar = $mod_estandar->consultarEstandar(1, 1);
        return $this->render('cargar', [
                    'arr_componentes' => ArrayHelper::map($arr_componente, "id", "name"),
                    'arr_funciones' => ArrayHelper::map($arr_funcion, "id", "name"),
                    'arr_modelos' => ArrayHelper::map($arr_modelo, "id", "value"),
                    'arr_estandares' => ArrayHelper::map($arr_estandar, "id", "name"),
                    'arr_tipos' => array("1" => Yii::t("formulario", "Private"), "2" => Yii::t("formulario", "Public")),
        ]);
    }

    public function actionEvidencia() {
        if (Yii::$app->request->isAjax) {
            $mod_repositorio = new DocumentoRepositorio();
            $data = Yii::$app->request->post();
            $accion = isset($data['ACCION']) ? $data['ACCION'] : "";
            if ($accion == "Create") {
                //Nuevo Registro
                $resul = $mod_repositorio->insertarDataDocumentos($data);
            } else if ($accion == "Update") {
                //Modificar Registro
                //$resul = $mod_repositorio->actualizarMedicos($data);                
            }
            if ($resul['status']) {
                $message = ["info" => Yii::t('exception', '<strong>Well done!</strong> your information was successfully saved.')];
                echo Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message, $resul);
            } else {
                $message = ["info" => Yii::t('exception', 'The above error occurred while the Web server was processing your request.')];
                echo Utilities::ajaxResponse('NO_OK', 'alert', Yii::t('jslang', 'Error'), 'false', $message);
            }
            return;
        }
    }

    public function actionExpexcel() {
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");
        $nombarch = "Report-" . date("YmdHis") . ".xls";
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J");

        $arrHeader = array(
            repositorio::t("repositorio", "File name"),
            Yii::t("formulario", "Type"),
            Yii::t("formulario", "Description"),
            repositorio::t("repositorio", "Date file"),
            Yii::t("formulario", "Registration Date"),
        );
        $data = Yii::$app->request->get();
        $arrSearch["est_id"] = $data['est_id'];
        $arrSearch["f_ini"] = $data['f_ini'];
        $arrSearch["f_fin"] = $data['f_fin'];
        $arrSearch["search"] = $data['search'];
        $arrSearch["mod_id"] = $data['mod_id'];
        $arrSearch["cat_id"] = $data['cat_id'];
        $arrSearch["comp_id"] = $data['comp_id'];

        $mod_repositorio = new DocumentoRepositorio();
        $arrData = array();
        if (empty($arrSearch)) {
            $arrData = $mod_repositorio->consultarDocumentos(array(), true);
        } else {
            $arrData = $mod_repositorio->consultarDocumentos($arrSearch, true);
        }
        $nameReport = repositorio::t("repositorio", "List Repository of Evidence");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }

    public function actionExppdf() {
        $report = new ExportFile();
        $this->view->title = repositorio::t("repositorio", "List Repository of Evidence"); // Titulo del reporte

        $mod_repositorio = new DocumentoRepositorio();
        $data = Yii::$app->request->get();
        $arr_body = array();
        $arrSearch["est_id"] = $data['est_id'];
        $arrSearch["f_ini"] = $data['f_ini'];
        $arrSearch["f_fin"] = $data['f_fin'];
        $arrSearch["search"] = $data['search'];
        $arrSearch["mod_id"] = $data['mod_id'];
        $arrSearch["cat_id"] = $data['cat_id'];
        $arrSearch["comp_id"] = $data['comp_id'];

        $arr_head = array(
            repositorio::t("repositorio", "File name"),
            Yii::t("formulario", "Type"),
            Yii::t("formulario", "Description"),
            repositorio::t("repositorio", "Date file"),
            Yii::t("formulario", "Registration Date"),
        );
        if (empty($arrSearch)) {
            $arr_body = $mod_repositorio->consultarDocumentos(array(), true);
        } else {
            $arr_body = $mod_repositorio->consultarDocumentos($arrSearch, true);
        }
        $report->orientation = "L"; // tipo de orientacion L => Horizontal, P => Vertical
        $report->createReportPdf(
                $this->render('exportpdf', [
                    'arr_head' => $arr_head,
                    'arr_body' => $arr_body
                ])
        );
        $report->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD);
        return;
    }

    public function actionSavedocumentos() {
        if (Yii::$app->request->isAjax) {
            $componente = "";
            $data = Yii::$app->request->post();
            if ($data["upload_file"]) {
                $per_id = Yii::$app->session->get("PB_perid") . DIRECTORY_SEPARATOR;
                if (empty($_FILES)) {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                }
                //Recibe Parámetros.
                $files = $_FILES[key($_FILES)];
                $patron = " ";
                $reemplazo = "_";
                $modelo = isset($data["modelo"]) ? str_replace($patron, $reemplazo, $data["modelo"]) . DIRECTORY_SEPARATOR : '';
                $funcion = isset($data["funcion"]) ? str_replace($patron, $reemplazo, $data["funcion"]) . DIRECTORY_SEPARATOR : '';
                if ($data["componente"] != "Seleccionar") {
                    $componente = isset($data["componente"]) ? str_replace($patron, $reemplazo, $data["componente"]) . DIRECTORY_SEPARATOR : '';
                }
                $estandar = isset($data["estandar"]) ? str_replace($patron, $reemplazo, $data["estandar"]) . DIRECTORY_SEPARATOR : '';
                $tipo = isset($data["tipo"]) ? str_replace($patron, $reemplazo, $data["tipo"]) . DIRECTORY_SEPARATOR : '';

                $filenames = $files['name']; //Nombre Archivo
                $ext = explode('.', basename($filenames)); //Extension del Archivo
                $folder_path = $_SERVER['DOCUMENT_ROOT'] . Url::base() . Yii::$app->params["repositorioFolder"];
                //$folder_path = Yii::$app->params["repositorioFolder"];                 
                $folder_path .= $modelo . $funcion . $componente . $estandar;

                //Utilities::putMessageLogFile($folder_path);

                if (!file_exists($folder_path)) {
                    mkdir($folder_path, 0777, true); //Se Crea la carpeta
                    //chmod($folder_path, 0777); 
                }

                //$nombre = $nombre . "." . array_pop($ext); //Si Es producto Se guarda con el nombre original esto SE DESCOMENTA Y PONEN EN VARIABLE NOMBRE COMO SE VA LLAMAR
                $nombre = uniqid() . "." . array_pop($ext); //Si Es producto Se guarda con el nombre original
                $target = $folder_path . DIRECTORY_SEPARATOR . $nombre;

                //$status = Utilities::moveUploadFile($files['tmp_name'], $dirFileEnd);                
                $status = move_uploaded_file($files['tmp_name'], $target);
                if ($status) {
                    //return true;
                    $arroout["status"] = true;
                    $arroout["ruta"] = $folder_path;
                    $arroout["nombre"] = $nombre;
                    return json_encode($arroout);
                } else {
                    return json_encode(['error' => Yii::t("notificaciones", "Error to process File {file}. Try again.", ['{file}' => basename($files['name'])])]);
                }
            }
        }
    }

}
