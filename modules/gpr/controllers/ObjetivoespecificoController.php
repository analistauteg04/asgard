<?php

namespace app\modules\gpr\controllers;

use Yii;
use app\modules\gpr\models\ObjetivoEstrategico;
use app\modules\gpr\models\ObjetivoEspecifico;
use app\models\Utilities;
use app\modules\gpr\models\UnidadAdministrativa;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\modules\gpr\Module as gpr;
gpr::registerTranslations();

class ObjetivoespecificoController extends \app\components\CController {

    public function actionIndex() {
        $model = new ObjetivoEspecifico();
        $data = Yii::$app->request->get();
        if (isset($data["PBgetFilter"])) {
            return $this->renderPartial('index-grid', [
                "model" => $model->getAllObjEspGrid($data["search"], $data["objetivo"], $data["unidad"], true)
            ]);
        }
        $arr_objestr = ObjetivoEstrategico::findAll(['oest_estado' => '1', 'oest_estado_logico' => '1']);
        $arr_objestr = array_merge(['0' => gpr::t('objetivoestrategico', "-- All Strategic Objective --")],ArrayHelper::map($arr_objestr, "oest_id", "oest_nombre"));
        $arr_unidades = UnidadAdministrativa::findAll(['uadm_estado' => '1', 'uadm_estado_logico' => '1']);
        $arr_unidades = array_merge(['0' => gpr::t('unidadadministrativa', "-- All Administrative Units --")],ArrayHelper::map($arr_unidades, "uadm_id", "uadm_nombre"));
        return $this->render('index', [
            'model' => $model->getAllObjEspGrid(NULL, NULL, NULL, true),
            'arr_objestr' => $arr_objestr,
            'arr_unidades' => $arr_unidades,
        ]);
    }

    public function actionNew() {
        $arr_objestr = ObjetivoEstrategico::findAll(['oest_estado' => '1', 'oest_estado_logico' => '1']);
        $arr_objestr = array_merge(['0' => gpr::t('objetivoestrategico', "-- Select a Strategic Objective --")],ArrayHelper::map($arr_objestr, "oest_id", "oest_nombre"));
        $arr_unidades = UnidadAdministrativa::findAll(['uadm_estado' => '1', 'uadm_estado_logico' => '1']);
        $arr_unidades = array_merge(['0' => gpr::t('unidadadministrativa', "-- Select a Administrative Unit --")],ArrayHelper::map($arr_unidades, "uadm_id", "uadm_nombre"));
        $_SESSION['JSLANG']['Please select a Strategic Objective.'] = gpr::t('objetivoestrategico', 'Please select a Strategic Objective.');
        $_SESSION['JSLANG']['Please select an Administrative Unit.'] = gpr::t('unidadadministrativa', 'Please select an Administrative Unit.');
        return $this->render('new', [
            'arr_objestr' => $arr_objestr,
            'arr_unidades' => $arr_unidades,
        ]);
    }

    public function actionView() {
        $data = Yii::$app->request->get();
        if (isset($data['id'])) {
            $id = $data['id'];
            $arr_objestr = ObjetivoEstrategico::findAll(['oest_estado' => '1', 'oest_estado_logico' => '1']);
            $arr_objestr = array_merge(['0' => gpr::t('objetivoestrategico', "-- Select a Strategic Objective --")],ArrayHelper::map($arr_objestr, "oest_id", "oest_nombre"));
            $arr_unidades = UnidadAdministrativa::findAll(['uadm_estado' => '1', 'uadm_estado_logico' => '1']);
            $arr_unidades = array_merge(['0' => gpr::t('unidadadministrativa', "-- Select a Administrative Unit --")],ArrayHelper::map($arr_unidades, "uadm_id", "uadm_nombre"));
            return $this->render('view', [
                'model' => ObjetivoEspecifico::findOne($id),
                'arr_objestr' => $arr_objestr,
                'arr_unidades' => $arr_unidades,
            ]);
        }
        return $this->redirect('index');
    }

    public function actionEdit() {
        $data = Yii::$app->request->get();
        if (isset($data['id'])) {
            $id = $data['id'];
            $arr_objestr = ObjetivoEstrategico::findAll(['oest_estado' => '1', 'oest_estado_logico' => '1']);
            $arr_objestr = array_merge(['0' => gpr::t('objetivoestrategico', "-- Select a Strategic Objective --")],ArrayHelper::map($arr_objestr, "oest_id", "oest_nombre"));
            $arr_unidades = UnidadAdministrativa::findAll(['uadm_estado' => '1', 'uadm_estado_logico' => '1']);
            $arr_unidades = array_merge(['0' => gpr::t('unidadadministrativa', "-- Select a Administrative Unit --")],ArrayHelper::map($arr_unidades, "uadm_id", "uadm_nombre"));
            $_SESSION['JSLANG']['Please select a Strategic Objective.'] = gpr::t('objetivoestrategico', 'Please select a Strategic Objective.');
            $_SESSION['JSLANG']['Please select an Administrative Unit.'] = gpr::t('unidadadministrativa', 'Please select an Administrative Unit.');
            return $this->render('edit', [
                'model' => ObjetivoEspecifico::findOne($id),
                'arr_objestr' => $arr_objestr,
                'arr_unidades' => $arr_unidades,
            ]);
        }
        return $this->redirect('index');
    }

    public function actionSave() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $user_id = Yii::$app->session->get('PB_iduser', FALSE);
            $fecha_modificacion = date(Yii::$app->params["dateTimeByDefault"]);
            try {
                $nombre = $data["nombre"];
                $descripcion = $data["desc"];
                $estado = $data["estado"];
                $oest_id = $data["objetivo"];
                $unidad = $data["unidad"];
                $model = new ObjetivoEspecifico();
                $model->oesp_nombre = $nombre;
                $model->oesp_descripcion = $descripcion;
                $model->oest_id = $oest_id;
                $model->uadm_id = $unidad;
                $model->oesp_usuario_ingreso = $user_id;
                $model->oesp_estado = $estado;
                $model->oesp_estado_logico = "1";
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($model->save()) {
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error SubModulo no creado.');
                }
            } catch (Exception $ex) {
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }

    public function actionUpdate() {
        if (Yii::$app->request->isAjax) {
            $user_id = Yii::$app->session->get('PB_iduser', FALSE);
            $fecha_modificacion = date(Yii::$app->params["dateTimeByDefault"]);
            $data = Yii::$app->request->post();
            try {
                $id = $data["id"];
                $nombre = $data["nombre"];
                $descripcion = $data["desc"];
                $estado = $data["estado"];
                $oest_id = $data["objetivo"];
                $unidad = $data["unidad"];
                $model = ObjetivoEspecifico::findOne($id);
                $model->oesp_nombre = $nombre;
                $model->oesp_descripcion = $descripcion;
                $model->oest_id = $oest_id;
                $model->uadm_id = $unidad;
                $model->oesp_usuario_modifica = $user_id;
                $model->oesp_fecha_modificacion = $fecha_modificacion;
                $model->oesp_estado = $estado;
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($model->update() !== false) {
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error SubModulo no actualizado.');
                }
            } catch (Exception $ex) {
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }

    public function actionDelete() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $user_id = Yii::$app->session->get('PB_iduser', FALSE);
            $fecha_modificacion = date(Yii::$app->params["dateTimeByDefault"]);
            try {
                $id = $data["id"];
                $model = ObjetivoEspecifico::findOne($id);
                $model->oesp_estado_logico = '0';
                $model->oesp_usuario_modifica = $user_id;
                $model->oesp_fecha_modificacion = $fecha_modificacion;
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($model->update() !== false) {
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error Registro no ha sido eliminado.');
                }
            } catch (Exception $ex) {
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }
}