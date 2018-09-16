<?php

namespace app\controllers;

use Yii;
use app\models\Utilities;
use app\models\MetodoIngreso;
use app\models\PeriodoMetodoIngreso;
use app\models\UnidadAcademica;
use app\models\Paralelo;
use app\models\Modalidad;
use yii\helpers\ArrayHelper;

class AdministracioncursoController extends \app\components\CController {

    public function actionCrea_periodocurso() {
        $mod_metodo = new MetodoIngreso();
        $mod_modalidad = new Modalidad();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmetodo"])) {
                $metodo = $mod_metodo->consultarMetodoIngNivelInt($data['nint_id']);
                $message = array("metodo" => $metodo);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["nint_id"]);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
        }
        $arr_ninteres = UnidadAcademica::find()->select("uaca_id AS id, uaca_nombre AS name")->where(["uaca_estado_logico" => "1", "uaca_estado" => "1"])->asArray()->all();
        $arr_metodos = $mod_metodo->consultarMetodoIngNivelInt($arr_ninteres[0]["id"]);
        $arr_modalidad = $mod_modalidad->consultarModalidad(1);
        return $this->render('crea_periodocurso', [
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
                    "mes" => array("1" => Yii::t("academico", "January"), "2" => Yii::t("academico", "Febrary"), "3" => Yii::t("academico", "March"),
                        "4" => Yii::t("academico", "April"), "5" => Yii::t("academico", "May"), "6" => Yii::t("academico", "June"),
                        "7" => Yii::t("academico", "July"), "8" => Yii::t("academico", "August"), "9" => Yii::t("academico", "September"),
                        "10" => Yii::t("academico", "October"), "11" => Yii::t("academico", "November"), "12" => Yii::t("academico", "December")),
        ]);
    }

    public function actionListarperiodoscan() {
        $per_id = @Yii::$app->session->get("PB_perid");
        $mod_periodo = new PeriodoMetodoIngreso;

        $model = null;
        $data = null;
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            $arrSearch["f_ini"] = $data['f_ini'];
            $arrSearch["f_fin"] = $data['f_fin'];
            $arrSearch["mes"] = $data['mes'];
            $arrSearch["search"] = $data['search'];

            $resp_periodo = $mod_periodo->listarPeriodos($arrSearch);
            return $this->renderPartial('_listarperiodocan_grid', [
                        'mod_periodo' => $resp_periodo,
            ]);
        } else {
            $resp_periodo = $mod_periodo->listarPeriodos();
        }
        if (Yii::$app->request->isAjax) {//
            $data = Yii::$app->request->get(); //&& $data["op"]=='1'
            if (isset($data["op"]) && $data["op"] == '1') {
                
            }
        }
        return $this->render('listarperiodoscan', [
                    'model' => $mod_aspirante,
                    'mod_periodo' => $resp_periodo,
        ]);
    }

    public function actionGrabarperiodoxmetodoing() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $mes = $data["mes"];
            $anio = $data["anio"];
            $uaca_id = $data["nint"];
            $ming = $data["ming"];
            $codigo = $data["codigo"];
            $descripcion = ucwords(strtolower($data["descripcion"])); //$data["descripcion"];
            $fec_desde = $data["fecdesde"];
            $fec_hasta = $data["fechasta"];
            $usuario = @Yii::$app->user->identity->usu_id;
            $mod = $data["mod"];
            $con = Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                $mod_periodo = new PeriodoMetodoIngreso();
                $resp_verifica = $mod_periodo->VerificarPeriodo($anio, $mes, $ming);
                if (!($resp_verifica)) {
                    $resp_ingreso = $mod_periodo->insertarPeriodo($anio, $mes, $uaca_id, $mod, $ming, $codigo, $descripcion, $fec_desde, $fec_hasta, $usuario);
                    if ($resp_ingreso) {
                        $exito = 1;
                    }
                } else {
                    $mensaje = "Ya existe un período registrado con los mismos datos de año, mes y método de ingreso.";
                }

                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar. " . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionCrea_paralelo() {
        $pmin_id = $_GET["pmin_id"];
        $codigo = $_GET["codigo"];

        $mod_paralelo = new PeriodoMetodoIngreso;
        $resp_paralelo = $mod_paralelo->listarParalelos($pmin_id);
        $periodo = "Período " . $codigo;

        return $this->render('crea_paralelo', [
                    "mod_paralelo" => $resp_paralelo,
                    "pmin_id" => $pmin_id,
                    "periodo" => $periodo,
        ]);
    }

    public function actionGrabarparalelo() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $descripcion = ucwords(strtolower($data["descripcion"])); //$data["descripcion"];
            $cupo = $data["cupo"];
            $pmin_id = $data["pmin_id"];
            $usuario = @Yii::$app->user->identity->usu_id;

            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                $mod_paralelo = new PeriodoMetodoIngreso();
                $resp_ingreso = $mod_paralelo->insertarParalelo($pmin_id, $descripcion, $cupo, $usuario);
                if ($resp_ingreso) {
                    $exito = 1;
                }

                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido grabada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionAsigna() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getparalelo"])) {
                $paralelo = Paralelo::find()->select("par_id AS id, par_descripcion AS name")->where(["par_estado_logico" => "1", "par_estado" => "1", "pmin_id" => $data['periodo']])->asArray()->all();
                $message = array("paralelo" => $paralelo);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
               
            }
        }

        $asp_id = base64_decode($_GET["asp"]);
        $apellidos = base64_decode($_GET["apellidos"]);
        $nombres = base64_decode($_GET["nombres"]);
        $ming_id = base64_decode($_GET["ming"]);
        $sins_id = base64_decode($_GET["sins_id"]);

        $arr_periodo = PeriodoMetodoIngreso::find()->select("pmin_id AS id, pmin_codigo AS name")->where(["pmin_estado_logico" => "1", "pmin_estado" => "1", "ming_id" => $ming_id])->asArray()->all();
        $arr_curso = Paralelo::find()->select("par_id AS id, par_descripcion AS name")->where(["par_estado_logico" => "1", "par_estado" => "1", "pmin_id" => $arr_periodo[0]["id"]])->asArray()->all();

        return $this->render('asigna', [
                    "asp_id" => $asp_id,
                    "apellidos" => $apellidos,
                    "nombres" => $nombres,
                    "arr_periodo" => ArrayHelper::map($arr_periodo, "id", "name"),
                    "arr_paralelo" => ArrayHelper::map($arr_curso, "id", "name"),
                    "sins_id" => $sins_id,
        ]);
    }

    public function actionUpdateperiodocurso() {
        $pmin_id = base64_decode($_GET["pmin_id"]);
        //Búsqueda de los datos del período
        $modperiodo = new PeriodoMetodoIngreso();
        $respPeriodo = $modperiodo->consultaPeriodoId($pmin_id);
        $mod_modalidad = new Modalidad();
        $mod_metodo = new MetodoIngreso();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getmetodo"])) {
                $metodo = $mod_metodo->consultarMetodoIngNivelInt($data['nint_id']);
                $message = array("metodo" => $metodo);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
               
            }
            if (isset($data["getmodalidad"])) {
                $modalidad = $mod_modalidad->consultarModalidad($data["nint_id"]);
                $message = array("modalidad" => $modalidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                
            }
        }
        $arr_ninteres = UnidadAcademica::find()->select("uaca_id AS id, uaca_nombre AS name")->where(["uaca_estado_logico" => "1", "uaca_estado" => "1"])->asArray()->all();
        $arr_metodos = $mod_metodo->consultarMetodoIngNivelInt($respPeriodo["uaca_id"]);
        $arr_modalidad = $mod_modalidad->consultarModalidad(1);

        return $this->render('updateperiodocurso', [
                    "arr_ninteres" => ArrayHelper::map($arr_ninteres, "id", "name"),
                    "arr_metodos" => ArrayHelper::map($arr_metodos, "id", "name"),
                    "mes" => array("1" => Yii::t("academico", "January"), "2" => Yii::t("academico", "Febrary"), "3" => Yii::t("academico", "March"),
                        "4" => Yii::t("academico", "April"), "5" => Yii::t("academico", "May"), "6" => Yii::t("academico", "June"),
                        "7" => Yii::t("academico", "July"), "8" => Yii::t("academico", "August"), "9" => Yii::t("academico", "September"),
                        "10" => Yii::t("academico", "October"), "11" => Yii::t("academico", "November"), "12" => Yii::t("academico", "December")),
                    "mod_periodo" => $respPeriodo,
                    "arr_modalidad" => ArrayHelper::map($arr_modalidad, "id", "name"),
        ]);
    }

    public function actionUpdateperiodoxmetodoing() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            //$pmin_id = base64_decode($_GET["pmin_id"]);
            $pmin_id = base64_decode($data["pmin_id"]);
            $anio = $data["anio"];
            $mes = $data["mes"];
            $uaca_id = $data["nint"];
            $ming = $data["ming"];
            if (strlen($mes) == 1) {
                $mesint = "0" . $mes;
            } else {
                $mesint = $mes;
            }
            if ($ming == '1') {
                $codigo = "CAN" . $mesint . substr($anio, 2, 2);
            }
            if ($ming == '2') {
                $codigo = "EXA" . $mesint . substr($anio, 2, 2);
            }
            if ($ming == '3') {
                $codigo = "HOM" . $mesint . substr($anio, 2, 2);
            }
            if ($ming == '4') {
                $codigo = "PRO" . $mesint . substr($anio, 2, 2);
            }
            $descripcion = $data["descripcion"];
            $fec_desde = $data["fecdesde"];
            $fec_hasta = $data["fechasta"];
            $usuario_modifica = @Yii::$app->user->identity->usu_id;
            $mod = $data["mod"];
            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                // ojo antes de modificar se necesita verificar que no existan datos iguales, Grace va a realizar una
                // funcion se debe utilizar esa, y tambien preferible poner esos campos unicos en la tabla
                $mod_periodo = new PeriodoMetodoIngreso();
                $resp_modifica = $mod_periodo->modificaPeriodo($pmin_id, $anio, $mes, $uaca_id, $mod, $ming, $codigo, $descripcion, $fec_desde, $fec_hasta, $usuario_modifica);
                if ($resp_modifica) {
                    $exito = 1;
                }

                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La infomación ha sido actualizada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al actualizar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al actualizar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

    public function actionGrabarasignacion() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $asp_id = $data["asp_id"];
            $curso_id = $data["curso_id"];
            $sins_id = $data["sins_id"];
            $usuario = @Yii::$app->user->identity->usu_id;

            $con = \Yii::$app->db_academico;
            $transaction = $con->beginTransaction();
            try {
                $mod_asigna = new PeriodoMetodoIngreso();
                //Verificar si no existe una asignación anteriormente.
                $resp_verifica = $mod_asigna->VerificarAsignacion($asp_id, $sins_id);
                if ($resp_verifica['existe'] == 'S') {
                    $resp_modifica = $mod_asigna->modificAsignacion($asp_id, $sins_id, $usuario);
                    if ($resp_modifica) {
                        $resp_ingreso = $mod_asigna->insertarRegistrocurso($curso_id, $asp_id, $usuario, $sins_id);
                        if ($resp_ingreso) {
                            $exito = 1;
                        }
                    }
                } else {
                    $resp_ingreso = $mod_asigna->insertarRegistrocurso($curso_id, $asp_id, $usuario, $sins_id);
                    if ($resp_ingreso) {
                        $exito = 1;
                    }
                }
                if ($exito) {
                    $transaction->commit();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "La asignación ha sido grabada. "),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                } else {
                    $transaction->rollback();
                    $message = array(
                        "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Error al grabar." . $mensaje),
                    "title" => Yii::t('jslang', 'Success'),
                );
                return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
            }
            return;
        }
    }

}
