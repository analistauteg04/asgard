<?php

namespace app\modules\gpr\controllers;

use Yii;
use app\modules\gpr\models\Entidad;
use app\models\Utilities;
use app\modules\gpr\models\Categoria;
use app\modules\gpr\models\UnidadGpr;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\modules\gpr\Module as gpr;
gpr::registerTranslations();

class UnidadController extends \app\components\CController {

    public function actionIndex() {
        $model = new UnidadGpr();
        $data = Yii::$app->request->get();
        if (isset($data["PBgetFilter"])) {
            return $this->renderPartial('index-grid', [
                "model" => $model->getAllUnidadGprGrid($data["search"], $data["categoria"], $data["entidad"], true)
            ]);
        }
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["getentidades"])) {
                $cat_id = $data["categoria"];
                $entidades = Entidad::find()->
                                    select("ent_id AS id, ent_nombre AS name")
                                    ->where(['ent_estado' => '1', 'ent_estado_logico' => '1', 'cat_id' => $cat_id])
                                    ->asArray()->all();
                $arr_entidad = array_merge(['0' => ['id' => '0', 'name' => gpr::t('entidad', '-- All Entities --')]], $entidades);
                $message = array("entidad" => $arr_entidad);
                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
            }
        }
        $arr_categoria = Categoria::findAll(['cat_estado' => '1', 'cat_estado_logico' => '1']);
        $arr_categoria = array_merge(['0' => gpr::t('categoria', '-- All Categories --')],ArrayHelper::map($arr_categoria, "cat_id", "cat_nombre"));
        $arr_entidad= Entidad::findAll(['ent_estado' => '1', 'ent_estado_logico' => '1']);
        $arr_entidad = array_merge(['0' => gpr::t('entidad', '-- All Entities --')],ArrayHelper::map($arr_entidad, "ent_id", "ent_nombre"));
        return $this->render('index', [
            'model' => $model->getAllUnidadGprGrid(NULL, NULL, NULL, true),
            'arr_categoria' => $arr_categoria,
            'arr_entidad' => $arr_entidad,
        ]);
    }

    public function actionNew() {
        $_SESSION['JSLANG']['Please select a Category Name.'] = gpr::t('categoria', 'Please select a Category Name.');
        $_SESSION['JSLANG']['Please select an Entity Name.'] = gpr::t('entidad', 'Please select an Entity Name.');
        $_SESSION['JSLANG']['-- All Entities --'] = gpr::t('entidad', '-- All Entities --');
        $arr_categoria = Categoria::findAll(['cat_estado' => '1', 'cat_estado_logico' => '1']);
        $arr_categoria = array_merge(['0' => gpr::t('categoria', '-- All Categories --')],ArrayHelper::map($arr_categoria, "cat_id", "cat_nombre"));
        $arr_entidad = ['0' => gpr::t('entidad', '-- All Entities --')];
        return $this->render('new', [
            'arr_categoria' => $arr_categoria,
            'arr_entidad' => $arr_entidad,
        ]);
    }

    public function actionView() {
        $data = Yii::$app->request->get();
        if (isset($data['id'])) {
            $id = $data['id'];
            $model = UnidadGpr::findOne($id);
            $arr_categoria = Categoria::findAll(['cat_estado' => '1', 'cat_estado_logico' => '1']);
            $arr_categoria = array_merge(['0' => gpr::t('categoria', '-- All Categories --')],ArrayHelper::map($arr_categoria, "cat_id", "cat_nombre"));
            $arr_entidad = Entidad::findAll(['ent_estado' => '1', 'ent_estado_logico' => '1', 'ent_id' => $model->ent_id]);
            $cat_id = $arr_entidad[0]->cat_id;
            $arr_entidad = array_merge(['0' => gpr::t('categoria', '-- All Entities --')],ArrayHelper::map($arr_entidad, "ent_id", "ent_nombre"));
            return $this->render('view', [
                'model' => $model,
                'arr_categoria' => $arr_categoria,
                'arr_entidad' => $arr_entidad,
                'cat_id' => $cat_id,
            ]);
        }
        return $this->redirect('index');
    }

    public function actionEdit() {
        $data = Yii::$app->request->get();
        if (isset($data['id'])) {
            $_SESSION['JSLANG']['Please select a Category Name.'] = gpr::t('categoria', 'Please select a Category Name.');
            $_SESSION['JSLANG']['Please select an Entity Name.'] = gpr::t('entidad', 'Please select an Entity Name.');
            $_SESSION['JSLANG']['-- All Entities --'] = gpr::t('entidad', '-- All Entities --');
            $id = $data['id'];
            $model = UnidadGpr::findOne($id);
            $arr_categoria = Categoria::findAll(['cat_estado' => '1', 'cat_estado_logico' => '1']);
            $arr_categoria = array_merge(['0' => gpr::t('categoria', '-- All Categories --')],ArrayHelper::map($arr_categoria, "cat_id", "cat_nombre"));
            $arr_entidad = Entidad::findAll(['ent_estado' => '1', 'ent_estado_logico' => '1', 'ent_id' => $model->ent_id]);
            $cat_id = $arr_entidad[0]->cat_id;
            $arr_entidad = array_merge(['0' => gpr::t('categoria', '-- All Entities --')],ArrayHelper::map($arr_entidad, "ent_id", "ent_nombre"));
            return $this->render('edit', [
                'model' => $model,
                'arr_categoria' => $arr_categoria,
                'arr_entidad' => $arr_entidad,
                'cat_id' => $cat_id,
            ]);
        }
        return $this->redirect('index');
    }

    public function actionSave() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $user_id = Yii::$app->session->get('PB_iduser', FALSE);
            try {
                $nombre = $data["nombre"];
                $descripcion = $data["desc"];
                $estado = $data["estado"];
                $categoria = $data['categoria'];
                $entidad = $data['entidad'];
                $model = new UnidadGpr();
                $model->ugpr_nombre = $nombre;
                $model->ugpr_descripcion = $descripcion;
                $model->ent_id = $entidad;
                $model->ugpr_estado = $estado;
                $model->ugpr_usuario_ingreso = $user_id;
                $model->ugpr_estado_logico = "1";
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
                $categoria = $data['categoria'];
                $entidad = $data['entidad'];
                $model = UnidadGpr::findOne($id);
                $model->ugpr_nombre = $nombre;
                $model->ugpr_descripcion = $descripcion;
                $model->ent_id = $entidad;
                $model->ugpr_usuario_modifica = $user_id;
                $model->ugpr_fecha_modificacion = $fecha_modificacion;
                $model->ugpr_estado = $estado;
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
                $model = UnidadGpr::findOne($id);
                $model->ugpr_estado_logico = '0';
                $model->ugpr_usuario_modifica = $user_id;
                $model->ugpr_fecha_modificacion = $fecha_modificacion;
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