<?php

namespace app\modules\gpr\controllers;

use Yii;
use app\modules\gpr\models\UnidadAdministrativa;
use app\models\Utilities;
use app\models\Usuario;
use app\modules\gpr\models\Entidad;
use app\modules\gpr\models\ResponsableAdministrativo;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\modules\gpr\Module as gpr;
gpr::registerTranslations();

class UnidadadministrativaController extends \app\components\CController {

    public function actionIndex() {
        $model = new UnidadAdministrativa();
        $data = Yii::$app->request->get();
        if (isset($data["PBgetFilter"])) {
            return $this->renderPartial('index-grid', [
                "model" => $model->getAllUnidadAdminGrid($data["search"], $data["entidad"], true)
            ]);
        }
        $arr_entidad = Entidad::findAll(['ent_estado' => '1', 'ent_estado_logico' => '1']);
        $arr_entidad = array_merge(['0' => gpr::t('entidad', '-- All Entities --')],ArrayHelper::map($arr_entidad, "ent_id", "ent_nombre"));
        return $this->render('index', [
            'model' => $model->getAllUnidadAdminGrid(NULL, NULL, true),
            'arr_entidad' => $arr_entidad,
        ]);
    }

    public function actionNew() {
        $_SESSION['JSLANG']['Please select an Entity Name.'] = gpr::t('entidad', 'Please select an Entity Name.');
        $_SESSION['JSLANG']['The Administrative Unit must have at least 1 responsible.'] = gpr::t('unidadadministrativa', 'The Administrative Unit must have at least 1 responsible.');
        $arr_entidad = Entidad::findAll(['ent_estado' => '1', 'ent_estado_logico' => '1']);
        $arr_entidad = array_merge(['0' => gpr::t('entidad', '-- Select a Entity Name --')],ArrayHelper::map($arr_entidad, "ent_id", "ent_nombre"));
        $dataUsers = Usuario::getListUsers(NULL, true);
        return $this->render('new', [
            'arr_entidad' => $arr_entidad,
            'dataUsers' => $dataUsers,
        ]);
    }

    public function actionView() {
        $data = Yii::$app->request->get();
        if (isset($data['id'])) {
            $id = $data['id'];
            $_SESSION['JSLANG']['Please select an Entity Name.'] = gpr::t('entidad', 'Please select an Entity Name.');
            $_SESSION['JSLANG']['The Administrative Unit must have at least 1 responsible.'] = gpr::t('unidadadministrativa', 'The Administrative Unit must have at least 1 responsible.');
            $arr_entidad = Entidad::findAll(['ent_estado' => '1', 'ent_estado_logico' => '1']);
            $arr_entidad = array_merge(['0' => gpr::t('entidad', '-- Select a Entity Name --')],ArrayHelper::map($arr_entidad, "ent_id", "ent_nombre"));
            $model = UnidadAdministrativa::findOne($id);
            $dataUsers = Usuario::getListUsers(NULL, true);
            $usuarios = ResponsableAdministrativo::find()
            ->select(['usu_id'])
            ->where(['uadm_id' => $id, 'radm_estado_logico' => '1', 'radm_estado' => '1'])
            ->asArray()
            ->all();

            return $this->render('view', [
                'model' => $model,
                'arr_entidad' => $arr_entidad,
                'dataUsers' => $dataUsers,
                'usuarios' => $usuarios,
            ]);
        }
        return $this->redirect('index');
    }

    public function actionEdit() {
        $data = Yii::$app->request->get();
        if (isset($data['id'])) {
            $id = $data['id'];
            $_SESSION['JSLANG']['Please select an Entity Name.'] = gpr::t('entidad', 'Please select an Entity Name.');
            $_SESSION['JSLANG']['The Administrative Unit must have at least 1 responsible.'] = gpr::t('unidadadministrativa', 'The Administrative Unit must have at least 1 responsible.');
            $arr_entidad = Entidad::findAll(['ent_estado' => '1', 'ent_estado_logico' => '1']);
            $arr_entidad = array_merge(['0' => gpr::t('entidad', '-- Select a Entity Name --')],ArrayHelper::map($arr_entidad, "ent_id", "ent_nombre"));
            $model = UnidadAdministrativa::findOne($id);
            $dataUsers = Usuario::getListUsers(NULL, true);
            $usuarios = ResponsableAdministrativo::find()
            ->select(['usu_id'])
            ->where(['uadm_id' => $id, 'radm_estado_logico' => '1', 'radm_estado' => '1'])
            ->asArray()
            ->all();

            return $this->render('edit', [
                'model' => $model,
                'arr_entidad' => $arr_entidad,
                'dataUsers' => $dataUsers,
                'usuarios' => $usuarios,
            ]);
        }
        return $this->redirect('index');
    }

    public function actionSave() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $user_id = Yii::$app->session->get('PB_iduser', FALSE);
            $emp_id = Yii::$app->session->get('PB_idempresa', FALSE);
            $transaction = Yii::$app->db_gpr->beginTransaction();
            try {
                $nombre = $data["nombre"];
                $descripcion = $data["desc"];
                $estado = $data["estado"];
                $entidad = $data['entidad'];
                $usuarios = $data["usuarios"];
                if(!isset($data["usuarios"]) && count($data["usuarios"]) == 0 ){
                    $throwError = true;
                    throw new Exception(gpr::t('unidadadministrativa', 'The Administrative Unit must have at least 1 responsible.'));
                }
                $model = new UnidadAdministrativa();
                $model->uadm_nombre = $nombre;
                $model->uadm_descripcion = $descripcion;
                $model->ent_id = $entidad;
                $model->uadm_estado = $estado;
                $model->uadm_usuario_ingreso = $user_id;
                $model->uadm_estado_logico = "1";
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($model->save()) {
                    for($i=0; $i<count($usuarios); $i++){
                        $model2 = new ResponsableAdministrativo();
                        $model2->uadm_id = $model->uadm_id;
                        $model2->usu_id = $usuarios[$i];
                        $model2->emp_id = $emp_id;
                        $model2->radm_usuario_ingreso = $user_id;
                        $model2->radm_estado = "1";
                        $model2->radm_estado_logico = "1";
                        if(!$model2->save()){
                            $throwError = true;
                            throw new Exception(Yii::t('notificaciones', 'Your information has not been saved. Please try again.'));
                        }
                    }
                    $transaction->commit();
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error Registro no creado.');
                }
            } catch (Exception $ex) {
                $transaction->rollback();
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
            $emp_id = Yii::$app->session->get('PB_idempresa', FALSE);
            $fecha_modificacion = date(Yii::$app->params["dateTimeByDefault"]);
            $data = Yii::$app->request->post();
            $transaction = Yii::$app->db_gpr->beginTransaction();
            try {
                $id = $data["id"];
                $nombre = $data["nombre"];
                $descripcion = $data["desc"];
                $estado = $data["estado"];
                $entidad = $data['entidad'];
                $usuarios = $data["usuarios"];
                if(!isset($data["usuarios"]) && count($data["usuarios"]) == 0 ){
                    $throwError = true;
                    throw new Exception(gpr::t('unidadadministrativa', 'The Administrative Unit must have at least 1 responsible.'));
                }
                $model = UnidadAdministrativa::findOne($id);
                $model->uadm_nombre = $nombre;
                $model->uadm_descripcion = $descripcion;
                $model->ent_id = $entidad;
                $model->uadm_usuario_modifica = $user_id;
                $model->uadm_fecha_modificacion = $fecha_modificacion;
                $model->uadm_estado = $estado;
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($model->save()) {
                    if(ResponsableAdministrativo::deleteAllResponsablesByConf($data["id"]) == false)
                        throw new Exception('Error Borrando Responsables.');
                    for($i=0; $i<count($usuarios); $i++){
                        $model2 = new ResponsableAdministrativo();
                        $model2->uadm_id = $model->uadm_id;
                        $model2->usu_id = $usuarios[$i];
                        $model2->emp_id = $emp_id;
                        $model2->radm_usuario_ingreso = $user_id;
                        $model2->radm_estado = "1";
                        $model2->radm_estado_logico = "1";
                        if(!$model2->save()){
                            $throwError = true;
                            throw new Exception(Yii::t('notificaciones', 'Your information has not been saved. Please try again.'));
                        }
                    }
                    $transaction->commit();
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error Registro no actualizado.');
                }
            } catch (Exception $ex) {
                $transaction->rollback();
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
            $transaction = Yii::$app->db_gpr->beginTransaction();
            try {
                $id = $data["id"];
                $model = UnidadAdministrativa::findOne($id);
                $model->uadm_estado_logico = '0';
                $model->uadm_usuario_modifica = $user_id;
                $model->uadm_fecha_modificacion = $fecha_modificacion;
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($model->update() !== false) {
                    if(ResponsableAdministrativo::deleteAllResponsablesByConf($id) == false)
                        throw new Exception('Error Borrando Responsables.');
                    $transaction->commit();
                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error Registro no ha sido eliminado.');
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                $message = array(
                    "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Please try again.'),
                    "title" => Yii::t('jslang', 'Error'),
                );
                return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
            }
        }
    }
}