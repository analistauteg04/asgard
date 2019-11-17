<?php

namespace app\modules\academico\controllers;

use Yii;
use app\models\Persona;
use app\models\Empresa;
use app\models\EmpresaPersona;
use app\models\Usuario;
use app\models\UsuaGrolEper;
use app\models\Provincia;
use app\models\Pais;
use app\models\Grupo;
use app\models\Rol;
use app\models\GrupRol;
use app\models\Canton;
use app\modules\academico\models\Profesor;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use yii\base\Exception;

class ProfesorController extends \app\components\CController {

    public function actionIndex() {
        $pro_model = new profesor();
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            if (isset($data["search"])) {
                return $this->renderPartial('index-grid', [
                            "model" => $pro_model->getAllProfesorGrid($data["search"], true)
                ]);
            }
        }
        return $this->render('index', [
                    'model' => $pro_model->getAllProfesorGrid(NULL, true)
        ]);
    }
    
    public function actionView() {        
        $data = Yii::$app->request->get();
        if (isset($data['id'])) {
            $id = $data['id'];

            $persona_model = Persona::findOne($id);
            $usuario_model = Usuario::findOne(["per_id" => $id, "usu_estado" => '1', "usu_estado_logico" => '1']);
            $empresa_persona_model = EmpresaPersona::findOne(["per_id" => $id, "eper_estado" => '1', "eper_estado_logico" => '1']);

            /**
             * Inf. Basica
             */

            $ViewFormTab1 = $this->renderPartial('ViewFormTab1', [
                'persona_model' => $persona_model,
            ]);

            /**
             * Inf. Domicilio
             */

            $arr_pais = Pais::findAll(["pai_estado" => 1, "pai_estado_logico" => 1]);
            
            $arr_pro = Provincia::findAll(["pai_id" => $persona_model->pai_id_domicilio, "pro_estado" => 1, "pro_estado_logico" => 1]);
                            
            $arr_can = Canton::findAll(["pro_id" => $persona_model->pro_id_domicilio, "can_estado" => 1, "can_estado_logico" => 1]);

            $ViewFormTab2 = $this->renderPartial('ViewFormTab2', [
                'arr_pais' => (empty(ArrayHelper::map($arr_pais, "pai_id", "pai_nombre"))) ? array(Yii::t("pais", "-- Select Pais --")) : (ArrayHelper::map($arr_pais, "pai_id", "pai_nombre")),
                'arr_pro' => (empty(ArrayHelper::map($arr_pro, "pro_id", "pro_nombre"))) ? array(Yii::t("provincia", "-- Select Provincia --")) : (ArrayHelper::map($arr_pro, "pro_id", "pro_nombre")),
                'arr_can' => (empty(ArrayHelper::map($arr_can, "can_id", "can_nombre"))) ? array(Yii::t("canton", "-- Select Canton --")) : (ArrayHelper::map($arr_can, "can_id", "can_nombre")),
                'persona_model' => $persona_model,                
            ]);

            /**
             * Inf. Cuenta
             */
            
            $gru_id = 13;   //Docente
            $rol_id = 17;   //Docente

            $arr_grupos = Grupo::findAll(["gru_estado" => 1, "gru_estado_logico" => 1]);

            $arr_roles  = GrupRol::find()
                ->select(["rol.rol_id", "rol.rol_nombre"])
                ->innerJoinWith('rol', 'rol.rol_id = grup_rol.rol_id')
                ->andWhere(["rol.rol_estado" => 1, "rol.rol_estado_logico" => 1,
                "grup_rol.grol_estado" => 1, "grup_rol.grol_estado_logico" => 1, 
                "grup_rol.gru_id" => $gru_id])->asArray()->all();
                                                
            $arr_empresa = Empresa::findAll(["emp_estado" => 1, "emp_estado_logico" => 1]);
            
            $ViewFormTab3 = $this->renderPartial('ViewFormTab3', [
                'arr_roles' => (empty(ArrayHelper::map($arr_roles, "rol_id", "rol_nombre"))) ? array(Yii::t("rol", "-- Select Role --")) : (ArrayHelper::map($arr_roles, "rol_id", "rol_nombre")),
                'arr_grupos' => (empty(ArrayHelper::map($arr_grupos, "gru_id", "gru_nombre"))) ? array(Yii::t("grupo", "-- Select Group --")) : (ArrayHelper::map($arr_grupos, "gru_id", "gru_nombre")),
                'arr_empresa' => (empty(ArrayHelper::map($arr_empresa, "emp_id", "emp_nombre_comercial"))) ? array(Yii::t("empresa", "-- Select Empresa --")) : (ArrayHelper::map($arr_empresa, "emp_id", "emp_nombre_comercial")),
                'gru_id' => $gru_id,
                'rol_id' => $rol_id,
                'usuario_model' => $usuario_model,
                'empresa_persona_model' => $empresa_persona_model,
                ]);

            $items = [
                [
                    'label'=>'Inf. Básica',
                    'content'=>$ViewFormTab1,
                    'active'=>true
                ],
                [
                    'label'=>'Inf. Domicilio',
                    'content'=>$ViewFormTab2,
                ],
                [
                    'label'=>'Inf. Cuenta',
                    'content'=>$ViewFormTab3,
                ]
                    
            ];        
            return $this->render('view', ['items'=>$items, 'persona_model' => $persona_model]);
        }
        return $this->redirect('index');
    }

    public function actionEdit() {
        $data = Yii::$app->request->get();
        if (isset($data['id'])) {
            $id = $data['id'];

            $persona_model = Persona::findOne($id);            
            $usuario_model = Usuario::findOne(["per_id" => $id, "usu_estado" => '1', "usu_estado_logico" => '1']);
            $empresa_persona_model = EmpresaPersona::findOne(["per_id" => $id, "eper_estado" => '1', "eper_estado_logico" => '1']);

            /**
             * Inf. Basica
             */

            $EditFormTab1 = $this->renderPartial('EditFormTab1', [
                'persona_model' => $persona_model,
            ]);

            /**
             * Inf. Domicilio
             */

            $arr_pais = Pais::findAll(["pai_estado" => 1, "pai_estado_logico" => 1]);
            
            $arr_pro = Provincia::findAll(["pai_id" => $persona_model->pai_id_domicilio, "pro_estado" => 1, "pro_estado_logico" => 1]);
                            
            $arr_can = Canton::findAll(["pro_id" => $persona_model->pro_id_domicilio, "can_estado" => 1, "can_estado_logico" => 1]);

            $EditFormTab2 = $this->renderPartial('EditFormTab2', [
                'arr_pais' => (empty(ArrayHelper::map($arr_pais, "pai_id", "pai_nombre"))) ? array(Yii::t("pais", "-- Select Pais --")) : (ArrayHelper::map($arr_pais, "pai_id", "pai_nombre")),
                'arr_pro' => (empty(ArrayHelper::map($arr_pro, "pro_id", "pro_nombre"))) ? array(Yii::t("provincia", "-- Select Provincia --")) : (ArrayHelper::map($arr_pro, "pro_id", "pro_nombre")),
                'arr_can' => (empty(ArrayHelper::map($arr_can, "can_id", "can_nombre"))) ? array(Yii::t("canton", "-- Select Canton --")) : (ArrayHelper::map($arr_can, "can_id", "can_nombre")),
                'persona_model' => $persona_model,                
            ]);

            /**
             * Inf. Cuenta
             */
            
            $gru_id = 13;   //Docente
            $rol_id = 17;   //Docente

            $arr_grupos = Grupo::findAll(["gru_estado" => 1, "gru_estado_logico" => 1]);

            $arr_roles  = GrupRol::find()
                ->select(["rol.rol_id", "rol.rol_nombre"])
                ->innerJoinWith('rol', 'rol.rol_id = grup_rol.rol_id')
                ->andWhere(["rol.rol_estado" => 1, "rol.rol_estado_logico" => 1,
                "grup_rol.grol_estado" => 1, "grup_rol.grol_estado_logico" => 1, 
                "grup_rol.gru_id" => $gru_id])->asArray()->all();
                                                
            $arr_empresa = Empresa::findAll(["emp_estado" => 1, "emp_estado_logico" => 1]);
            
            $EditFormTab3 = $this->renderPartial('EditFormTab3', [
                'arr_roles' => (empty(ArrayHelper::map($arr_roles, "rol_id", "rol_nombre"))) ? array(Yii::t("rol", "-- Select Role --")) : (ArrayHelper::map($arr_roles, "rol_id", "rol_nombre")),
                'arr_grupos' => (empty(ArrayHelper::map($arr_grupos, "gru_id", "gru_nombre"))) ? array(Yii::t("grupo", "-- Select Group --")) : (ArrayHelper::map($arr_grupos, "gru_id", "gru_nombre")),
                'arr_empresa' => (empty(ArrayHelper::map($arr_empresa, "emp_id", "emp_nombre_comercial"))) ? array(Yii::t("empresa", "-- Select Empresa --")) : (ArrayHelper::map($arr_empresa, "emp_id", "emp_nombre_comercial")),
                'gru_id' => $gru_id,
                'rol_id' => $rol_id,
                'usuario_model' => $usuario_model,
                'empresa_persona_model' => $empresa_persona_model,
                ]);

            $items = [
                [
                    'label'=>'Inf. Básica',
                    'content'=>$EditFormTab1,
                    'active'=>true
                ],
                [
                    'label'=>'Inf. Domicilio',
                    'content'=>$EditFormTab2,
                ],
                [
                    'label'=>'Inf. Cuenta',
                    'content'=>$EditFormTab3,
                ]
                    
            ];        
            return $this->render('edit', ['items'=>$items, 'persona_model' => $persona_model]);
        }
        return $this->redirect('index');
    }

    public function actionNew() {
        $NewFormTab1 = $this->renderPartial('NewFormTab1');
        
        $arr_pais = Pais::findAll(["pai_estado" => 1, "pai_estado_logico" => 1]);        
        list($firstpais) = $arr_pais;        

        $arr_pro  = Provincia::find()
            ->select(["pro_id", "pro_nombre"])
            ->andWhere(["pro_estado" => 1, "pro_estado_logico" => 1,
            "pai_id" => $firstpais->pai_id])->asArray()->all();

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            if (isset($data["pai_id"])) {
                $model = new Provincia();
                $arr_pro = $model->provinciabyPais($data["pai_id"]);
                
                list($firstpro) = $arr_pro;

                $arr_can  = Canton::find()
                    ->select(["can_id as id", "can_nombre as name"])            
                    ->andWhere(["can_estado" => 1, "can_estado_logico" => 1,
                    "pro_id" => $firstpro['id']])->asArray()->all();

                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', ['arr_pro'=>$arr_pro, 'arr_can'=>$arr_can]);
            }else{
                $arr_can  = Canton::find()
                    ->select(["can_id as id", "can_nombre as name"])            
                    ->andWhere(["can_estado" => 1, "can_estado_logico" => 1,
                    "pro_id" => $data["pro_id"]])->asArray()->all();

                return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $arr_can);
            }
        }

        list($firstpro) = $arr_pro;

        $arr_can  = Canton::find()
            ->select(["can_id", "can_nombre"])            
            ->andWhere(["can_estado" => 1, "can_estado_logico" => 1,
            "pro_id" => $firstpro['pro_id']])->asArray()->all();

        $NewFormTab2 = $this->renderPartial('NewFormTab2', [
            'arr_pais' => (empty(ArrayHelper::map($arr_pais, "pai_id", "pai_nombre"))) ? array(Yii::t("pais", "-- Select Pais --")) : (ArrayHelper::map($arr_pais, "pai_id", "pai_nombre")),
            'arr_pro' => (empty(ArrayHelper::map($arr_pro, "pro_id", "pro_nombre"))) ? array(Yii::t("provincia", "-- Select Provincia --")) : (ArrayHelper::map($arr_pro, "pro_id", "pro_nombre")),
            'arr_can' => (empty(ArrayHelper::map($arr_can, "can_id", "can_nombre"))) ? array(Yii::t("canton", "-- Select Canton --")) : (ArrayHelper::map($arr_can, "can_id", "can_nombre")),
        ]);
            
         //gru_id=13 -> Docente
        $grup_id = 13;
        $rol_id = 17;

         $arr_grupos = Grupo::findAll(["gru_id"=>13, "gru_estado" => 1, "gru_estado_logico" => 1]);
         //$arr_roles  = Rol::findAll(["rol_estado" => 1, "rol_estado_logico" => 1]);
         list($firstgrupo) = $arr_grupos;
         $arr_roles  = GrupRol::find()
             ->select(["rol.rol_id", "rol.rol_nombre"])
             ->innerJoinWith('rol', 'rol.rol_id = grup_rol.rol_id')
             ->andWhere(["rol.rol_estado" => 1, "rol.rol_estado_logico" => 1,
              "grup_rol.grol_estado" => 1, "grup_rol.grol_estado_logico" => 1, 
              "grup_rol.gru_id" => $firstgrupo->gru_id])->asArray()->all();
         $arr_empresa = Empresa::findAll(["emp_estado" => 1, "emp_estado_logico" => 1]);
         if (Yii::$app->request->isAjax) {
             $data = Yii::$app->request->post();
             if (isset($data["gru_id"])) {
                 $model = new GrupRol();
                 $arr_roles = $model->getRolesByGroup($data["gru_id"]);
                 return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $arr_roles);
             }
         }
         $NewFormTab3 = $this->renderPartial('NewFormTab3', [
             'arr_roles' => (empty(ArrayHelper::map($arr_roles, "rol_id", "rol_nombre"))) ? array(Yii::t("rol", "-- Select Role --")) : (ArrayHelper::map($arr_roles, "rol_id", "rol_nombre")),
             'arr_grupos' => (empty(ArrayHelper::map($arr_grupos, "gru_id", "gru_nombre"))) ? array(Yii::t("grupo", "-- Select Group --")) : (ArrayHelper::map($arr_grupos, "gru_id", "gru_nombre")),
             'arr_empresa' => (empty(ArrayHelper::map($arr_empresa, "emp_id", "emp_nombre_comercial"))) ? array(Yii::t("empresa", "-- Select Empresa --")) : (ArrayHelper::map($arr_empresa, "emp_id", "emp_nombre_comercial")),
             'grup_id' => $gru_id,
             'rol_id' => $rol_id
             ]);

        $items = [
            [
                'label'=>'Inf. Básica',
                'content'=>$NewFormTab1,
                'active'=>true
            ],
            [
                'label'=>'Inf. Domicilio',
                'content'=>$NewFormTab2,
            ],
            [
                'label'=>'Inf. Cuenta',
                'content'=>$NewFormTab3,
            ]
            
        ];

        return $this->render('new', ['items'=>$items]);
    }

    public function actionSave() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            try {

                /**
                 * Inf. Basica
                 */
                $pri_nombre = $data["pri_nombre"];
                $seg_nombre = $data["seg_nombre"];
                $pri_apellido = $data["pri_apellido"];
                $seg_apellido = $data["seg_apellido"];
                $cedula = $data["cedula"];
                $ruc = $data["ruc"];
                $pasaporte = $data["pasaporte"];
                $correo = $data["correo"];

                /**
                 * Inf. Domicilio
                 */

                $pai_id_domicilio = $data["pai_id"];
                $pro_id_domicilio = $data["pro_id"];
                $can_id_domicilio = $data["can_id"];
                $sector = $data["sector"];
                $calle_pri = $data["calle_pri"];
                $calle_sec = $data["calle_sec"];
                $numeracion = $data["numeracion"];
                $referencia = $data["referencia"];

                /**
                 * Inf. Cuenta
                 */

                $usuario = $data["usuario"];
                $clave = $data["clave"];
                $gru_id = $data["gru_id"];
                $rol_id = $data["rol_id"];
                $emp_id = $data["emp_id"];

                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );

                $arr_grupo_rol = GrupRol::find()->where(['gru_id' => $gru_id, 'rol_id' => $rol_id])->asArray()->all();

                $validacion = Persona::VerificarPersonaExiste($cedula, $pasaporte, $ruc);

                if($validacion===1){
                    /**
                     * Si la persona existe y no esta eliminada
                     */

                    $message = array(
                        "wtmessage" => Yii::t('notificaciones', 'Your information has not been saved. Usuario ya existente.'),
                        "title" => Yii::t('jslang', 'Error'),
                    );

                    return Utilities::ajaxResponse('NOOK', 'alert', Yii::t('jslang', 'Error'), 'true', $message);
                } else if($validacion===0) {
                    /**
                     * Si la persona existe y esta eliminada
                     */

                    $per_id_existente = Persona::ObtenerPersonabyCedulaPasaporteRuc($cedula, $pasaporte, $ruc);
                    
                    $persona_model = Persona::findOne($per_id_existente);
                    $persona_model->per_pri_nombre = $pri_nombre;
                    $persona_model->per_seg_nombre = $seg_nombre;
                    $persona_model->per_pri_apellido = $pri_apellido;
                    $persona_model->per_seg_apellido = $seg_apellido;
                    $persona_model->per_cedula = $cedula;
                    if($ruc!=""){
                        $persona_model->per_ruc = $ruc;
                    }
                    if($pasaporte!=""){
                        $persona_model->per_pasaporte = $pasaporte;
                    }
                    $persona_model->per_correo = $correo;
                    $persona_model->pai_id_domicilio = $pai_id_domicilio;
                    $persona_model->pro_id_domicilio = $pro_id_domicilio;
                    $persona_model->can_id_domicilio = $can_id_domicilio;
                    $persona_model->per_domicilio_sector = $sector;
                    $persona_model->per_domicilio_cpri = $calle_pri;
                    $persona_model->per_domicilio_csec = $calle_sec;
                    $persona_model->per_domicilio_num = $numeracion;
                    $persona_model->per_domicilio_ref = $referencia;
                    $persona_model->per_estado = '1';
                    $persona_model->per_estado_logico = '1';
                                        
                    if ($persona_model->save()) {                        
                        $profesor_model = new Profesor();
                        $profesor_model->per_id = $per_id_existente;
                        $profesor_model->pro_estado = '1';
                        $profesor_model->pro_estado_logico = '1';
                        $profesor_model->save();

                        $usuario_model = new Usuario();
                        $usuario_model->per_id = $per_id_existente;
                        $usuario_model->usu_user = $usuario;
                        $usuario_model->usu_password = $clave;
                        $usuario_model->usu_estado = '1';
                        $usuario_model->usu_estado_logico = '1';
                        $usuario_model->save();
                        $usu_id = $usuario_model->getPrimaryKey();

                        $empresa_persona_model = new EmpresaPersona();
                        $empresa_persona_model->emp_id = $emp_id;
                        $empresa_persona_model->per_id = $per_id_existente;
                        $empresa_persona_model->eper_estado = '1';
                        $empresa_persona_model->eper_estado_logico = '1';
                        $empresa_persona_model->save();
                        $eper_id = $empresa_persona_model->getPrimaryKey();

                        $usua_grol_eper_model = new UsuaGrolEper();
                        $usua_grol_eper_model->eper_id = $eper_id;
                        $usua_grol_eper_model->usu_id = $usu_id;
                        $usua_grol_eper_model->grol_id = $arr_grupo_rol[0]['grol_id'];
                        $usua_grol_eper_model->ugep_estado = '1';
                        $usua_grol_eper_model->ugep_estado_logico = '1';
                        $usua_grol_eper_model->save();

                        return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                    } else {
                        throw new Exception('Error SubModulo no creado.');
                    }

                } else {
                    /**
                     * Registro nuevo
                     */

                    $persona_model = new Persona();
                    $persona_model->per_pri_nombre = $pri_nombre;
                    $persona_model->per_seg_nombre = $seg_nombre;
                    $persona_model->per_pri_apellido = $pri_apellido;
                    $persona_model->per_seg_apellido = $seg_apellido;
                    $persona_model->per_cedula = $cedula;
                    if($ruc!=""){
                        $persona_model->per_ruc = $ruc;
                    }
                    if($pasaporte!=""){
                        $persona_model->per_pasaporte = $pasaporte;
                    }
                    $persona_model->per_correo = $correo;
                    $persona_model->pai_id_domicilio = $pai_id_domicilio;
                    $persona_model->pro_id_domicilio = $pro_id_domicilio;
                    $persona_model->can_id_domicilio = $can_id_domicilio;
                    $persona_model->per_domicilio_sector = $sector;
                    $persona_model->per_domicilio_cpri = $calle_pri;
                    $persona_model->per_domicilio_csec = $calle_sec;
                    $persona_model->per_domicilio_num = $numeracion;
                    $persona_model->per_domicilio_ref = $referencia;
                    $persona_model->per_estado = '1';
                    $persona_model->per_estado_logico = '1';
                                        
                    if ($persona_model->save()) {
                        $per_id = $persona_model->getPrimaryKey();
                        $profesor_model = new Profesor();
                        $profesor_model->per_id = $per_id;
                        $profesor_model->pro_estado = '1';
                        $profesor_model->pro_estado_logico = '1';
                        $profesor_model->save();

                        $usuario_model = new Usuario();
                        $usuario_model->per_id = $per_id;
                        $usuario_model->usu_user = $usuario;
                        $usuario_model->usu_password = $clave;
                        $usuario_model->usu_estado = '1';
                        $usuario_model->usu_estado_logico = '1';
                        $usuario_model->save();
                        $usu_id = $usuario_model->getPrimaryKey();

                        $empresa_persona_model = new EmpresaPersona();
                        $empresa_persona_model->emp_id = $emp_id;
                        $empresa_persona_model->per_id = $per_id;
                        $empresa_persona_model->eper_estado = '1';
                        $empresa_persona_model->eper_estado_logico = '1';
                        $empresa_persona_model->save();
                        $eper_id = $empresa_persona_model->getPrimaryKey();

                        $usua_grol_eper_model = new UsuaGrolEper();
                        $usua_grol_eper_model->eper_id = $eper_id;
                        $usua_grol_eper_model->usu_id = $usu_id;
                        $usua_grol_eper_model->grol_id = $arr_grupo_rol[0]['grol_id'];
                        $usua_grol_eper_model->ugep_estado = '1';
                        $usua_grol_eper_model->ugep_estado_logico = '1';
                        $usua_grol_eper_model->save();

                        return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                    } else {
                        throw new Exception('Error SubModulo no creado.');
                    }
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
            $data = Yii::$app->request->post();
            try {

                $per_id = $data["per_id"];

                /**
                 * Inf. Basica
                 */            
                $pri_nombre = $data["pri_nombre"];
                $seg_nombre = $data["seg_nombre"];
                $pri_apellido = $data["pri_apellido"];
                $seg_apellido = $data["seg_apellido"];
                $cedula = $data["cedula"];
                $ruc = $data["ruc"];
                $pasaporte = $data["pasaporte"];
                $correo = $data["correo"];

                /**
                 * Inf. Domicilio
                 */

                $pai_id_domicilio = $data["pai_id"];
                $pro_id_domicilio = $data["pro_id"];
                $can_id_domicilio = $data["can_id"];
                $sector = $data["sector"];
                $calle_pri = $data["calle_pri"];
                $calle_sec = $data["calle_sec"];
                $numeracion = $data["numeracion"];
                $referencia = $data["referencia"];

                /**
                 * Inf. Cuenta
                 */

                $usuario = $data["usuario"];
                $clave = $data["clave"];
                $gru_id = $data["gru_id"];
                $rol_id = $data["rol_id"];
                $emp_id = $data["emp_id"];

                $persona_model = Persona::findOne($per_id);
                $persona_model->per_pri_nombre = $pri_nombre;
                $persona_model->per_seg_nombre = $seg_nombre;
                $persona_model->per_pri_apellido = $pri_apellido;
                $persona_model->per_seg_apellido = $seg_apellido;
                $persona_model->per_cedula = $cedula;
                if($ruc!=""){
                    $persona_model->per_ruc = $ruc;
                }
                if($pasaporte!=""){
                    $persona_model->per_pasaporte = $pasaporte;
                }
                $persona_model->per_correo = $correo;
                $persona_model->pai_id_domicilio = $pai_id_domicilio;
                $persona_model->pro_id_domicilio = $pro_id_domicilio;
                $persona_model->can_id_domicilio = $can_id_domicilio;
                $persona_model->per_domicilio_sector = $sector;
                $persona_model->per_domicilio_cpri = $calle_pri;
                $persona_model->per_domicilio_csec = $calle_sec;
                $persona_model->per_domicilio_num = $numeracion;
                $persona_model->per_domicilio_ref = $referencia;
                
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );

                if ($persona_model->save()) {
                    $usuario_model = Usuario::findOne(["per_id" => $per_id]);                    
                    $usuario_model->usu_user = $usuario;
                    $usuario_model->usu_password = $clave;                    
                    $usuario_model->save();                    

                    $empresa_persona_model = EmpresaPersona::findOne(["per_id" => $per_id]);
                    $empresa_persona_model->emp_id = $emp_id;
                    $empresa_persona_model->save();                    
                    
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

    public function actionDelete(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            try {
                $per_id = $data["per_id"];
                $persona_model = Persona::findOne($per_id);
                $persona_model->per_estado_logico = '0';
                $message = array(
                    "wtmessage" => Yii::t("notificaciones", "Your information was successfully saved."),
                    "title" => Yii::t('jslang', 'Success'),
                );
                if ($persona_model->update() !== false) {
                    $profesor_model = Profesor::findOne(["per_id" => $per_id]);
                    $profesor_model->pro_estado_logico = '0';
                    $profesor_model->update();

                    $usuario_model = Usuario::findOne(["per_id" => $per_id]);
                    $usu_id = $usuario_model->usu_id;
                    $usuario_model->usu_estado_logico = '0';
                    $usuario_model->update();

                    $empresa_persona_model = EmpresaPersona::findOne(["per_id" => $per_id]);
                    $empresa_persona_model->eper_estado_logico = '0';
                    $empresa_persona_model->update();

                    $usua_grol_eper_model = UsuaGrolEper::findOne(["usu_id" => $usu_id]);
                    $usua_grol_eper_model->ugep_estado_logico = '0';
                    $usua_grol_eper_model->update();

                    return Utilities::ajaxResponse('OK', 'alert', Yii::t('jslang', 'Success'), 'false', $message);
                } else {
                    throw new Exception('Error SubModulo no ha sido eliminado.');
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