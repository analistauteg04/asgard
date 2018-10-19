<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use \yii\data\ActiveDataProvider;
use Yii;
use app\modules\financiero\models\OrdenPago;
use app\models\Persona;
use app\models\EmpresaPersona;
use \app\modules\admision\models\SolicitudInscripcion;
use app\modules\admision\models\Interesado;
use app\modules\admision\models\InteresadoEmpresa;
use app\models\Usuario;
use app\models\UsuaGrolEper;
use yii\base\Security;
use app\modules\financiero\models\Secuencias;

/**
 * Description of InscripcionAdmision
 *
 * @author root
 */
class InscripcionAdmision extends \yii\db\ActiveRecord {

    //put your code here
    public function insertarInscripcion($data) {
        $arroout = array();
        $con = \Yii::$app->db_captacion;
        $trans = $con->beginTransaction();
        try {
            $twin_id = $this->insertarDataInscripcion($con,$data["DATA_1"]);
            $trans->commit();
            //RETORNA DATOS 
            $arroout["status"] = TRUE;
            $arroout["error"] = null;
            $arroout["message"] = null;
            $arroout["ids"] = $twin_id;
            $arroout["data"] = null;//$rawData;
            return $arroout;
        } catch (\Exception $e) {
            $trans->rollback();

            $arroout["status"] = FALSE;
            $arroout["error"] = $e->getCode();
            $arroout["message"] = $e->getMessage();
            $arroout["data"] = null;//$rawData;
            return $arroout;
        }
    }
    
    public function actualizarInscripcion($data) {
        $arroout = array();
        $con = \Yii::$app->db_captacion;
        $trans = $con->beginTransaction();
        try {
            $twin_id=$this->updateDataInscripcion($con,$data["DATA_1"]);
            $data = $this->consultarDatosInscripcion($twin_id);
            $trans->commit();
            $arroout["status"] = TRUE;
            $arroout["error"] = null;
            $arroout["message"] = null;
            $arroout["ids"] = $twin_id;
            $arroout["data"] = $data;//$rawData;
            return $arroout;
        } catch (\Exception $e) {
            $trans->rollback();
            $arroout["status"] = FALSE;
            $arroout["error"] = $e->getCode();
            $arroout["message"] = $e->getMessage();
            $arroout["data"] = null;//$rawData;
            return $arroout;
        }        
    }

    private function insertarDataInscripcion($con,$data) {
        $ruta_doc_titulo='';
        $ruta_doc_dni='';
        $ruta_doc_certvota='';
        $ruta_doc_foto='';
        $ruta_doc_certificado='';
        $twin_mensaje1=0;
        $twin_mensaje2=0;
           
        $sql = "INSERT INTO " . $con->dbname . ".temporal_wizard_inscripcion
            (twin_nombre,twin_apellido,twin_dni,twin_numero,twin_correo,twin_pais,twin_celular,uaca_id, 
             mod_id,car_id,twin_metodo_ingreso,conuteg_id,ruta_doc_titulo, ruta_doc_dni, ruta_doc_certvota,
             ruta_doc_foto,ruta_doc_certificado, twin_mensaje1,twin_mensaje2,twin_estado,twin_fecha_creacion,twin_estado_logico)VALUES
            (:twin_nombre,:twin_apellido,:twin_dni,:twin_numero,:twin_correo,:twin_pais,:twin_celular,:uaca_id, 
             :mod_id,:car_id,:twin_metodo_ingreso,:conuteg_id,:ruta_doc_titulo,:ruta_doc_dni,:ruta_doc_certvota,
             :ruta_doc_foto,:ruta_doc_certificado,:twin_mensaje1,:twin_mensaje2,1,CURRENT_TIMESTAMP(),1)";
                
        $command = $con->createCommand($sql);
        $command->bindParam(":twin_nombre", $data[0]['pges_pri_nombre'], \PDO::PARAM_STR);
        $command->bindParam(":twin_apellido", $data[0]['pges_pri_apellido'], \PDO::PARAM_STR);
        $command->bindParam(":twin_dni", $data[0]['tipo_dni'], \PDO::PARAM_STR);
        $command->bindParam(":twin_numero", $data[0]['pges_cedula'], \PDO::PARAM_STR);
        $command->bindParam(":twin_correo", $data[0]['pges_correo'], \PDO::PARAM_STR);
        $command->bindParam(":twin_pais", $data[0]['pais'], \PDO::PARAM_STR);
        $command->bindParam(":twin_celular", $data[0]['pges_celular'], \PDO::PARAM_STR);
        $command->bindParam(":uaca_id", $data[0]['unidad_academica'], \PDO::PARAM_STR);
        $command->bindParam(":mod_id", $data[0]['modalidad'], \PDO::PARAM_STR);
        $command->bindParam(":car_id", $data[0]['carrera'], \PDO::PARAM_STR);
        $command->bindParam(":twin_metodo_ingreso", $data[0]['ming_id'], \PDO::PARAM_STR);
        $command->bindParam(":conuteg_id", $data[0]['conoce'], \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_titulo", $ruta_doc_titulo, \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_dni", $ruta_doc_dni, \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_certvota", $ruta_doc_certvota, \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_foto", $ruta_doc_foto, \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_certificado", $ruta_doc_certificado, \PDO::PARAM_STR);
        $command->bindParam(":twin_mensaje1", $twin_mensaje1, \PDO::PARAM_STR);
        $command->bindParam(":twin_mensaje2", $twin_mensaje2, \PDO::PARAM_STR);
        $command->execute();
        return $con->getLastInsertID();

    }
    
    
    private function updateDataInscripcion($con,$data) {
        $sql = "UPDATE " . $con->dbname . ".temporal_wizard_inscripcion 
                SET twin_nombre=:twin_nombre,twin_apellido=:twin_apellido,twin_dni=:twin_dni,twin_numero=:twin_numero,
                    twin_correo=:twin_correo,twin_pais=:twin_pais,twin_celular=:twin_celular,uaca_id=:uaca_id, 
                    mod_id=:mod_id,car_id=:car_id,twin_metodo_ingreso=:twin_metodo_ingreso,conuteg_id=:conuteg_id,ruta_doc_titulo=:ruta_doc_titulo, 
                    ruta_doc_dni=:ruta_doc_dni, ruta_doc_certvota=:ruta_doc_certvota,ruta_doc_foto=:ruta_doc_foto,ruta_doc_certificado=:ruta_doc_certificado, 
                    twin_mensaje1=:twin_mensaje1,twin_mensaje2=:twin_mensaje2,twin_fecha_modificacion=CURRENT_TIMESTAMP() 
                 WHERE twin_id =:twin_id ";
        $command = $con->createCommand($sql);
        $command->bindParam(":twin_id", $data[0]['twin_id'], \PDO::PARAM_STR);
        $command->bindParam(":twin_nombre", $data[0]['pges_pri_nombre'], \PDO::PARAM_STR);
        $command->bindParam(":twin_apellido", $data[0]['pges_pri_apellido'], \PDO::PARAM_STR);
        $command->bindParam(":twin_dni", $data[0]['tipo_dni'], \PDO::PARAM_STR);
        $command->bindParam(":twin_numero", $data[0]['pges_cedula'], \PDO::PARAM_STR);
        $command->bindParam(":twin_correo", $data[0]['pges_correo'], \PDO::PARAM_STR);
        $command->bindParam(":twin_pais", $data[0]['pais'], \PDO::PARAM_STR);
        $command->bindParam(":twin_celular", $data[0]['pges_celular'], \PDO::PARAM_STR);
        $command->bindParam(":uaca_id", $data[0]['unidad_academica'], \PDO::PARAM_STR);
        $command->bindParam(":mod_id", $data[0]['modalidad'], \PDO::PARAM_STR);
        $command->bindParam(":car_id", $data[0]['carrera'], \PDO::PARAM_STR);
        $command->bindParam(":twin_metodo_ingreso", $data[0]['ming_id'], \PDO::PARAM_STR);
        $command->bindParam(":conuteg_id", $data[0]['conoce'], \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_titulo", basename($data[0]['ruta_doc_titulo']), \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_dni", basename($data[0]['ruta_doc_dni']), \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_certvota",basename($data[0]['ruta_doc_certvota']), \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_foto", basename($data[0]['ruta_doc_foto']), \PDO::PARAM_STR);
        $command->bindParam(":ruta_doc_certificado", basename($data[0]['ruta_doc_certificado']), \PDO::PARAM_STR);
        $command->bindParam(":twin_mensaje1", $data[0]['twin_mensaje1'], \PDO::PARAM_STR);
        $command->bindParam(":twin_mensaje2", $data[0]['twin_mensaje2'], \PDO::PARAM_STR);
        $command->execute();
        return $data[0]['twin_id'];
    }

    /**
     * Function addLabelTimeDocumentos renombra el documento agregando una varible de tiempo 
     * @author  Developer Uteg <developer@uteg.edu.ec>
     * @param   int     $sins_id        Id de la solicitud
     * @param   string  $file           Uri del Archivo a modificar
     * @param   int     $timeSt         Parametro a agregar al nombre del archivo
     * @return  $newFile | FALSE (Retorna el nombre del nuevo archivo o false si fue error).
     */
    public static function addLabelTimeDocumentos($sins_id, $file, $timeSt) {
        $arrIm = explode(".", basename($file));
        $typeFile = strtolower($arrIm[count($arrIm) - 1]);
        $baseFile = Yii::$app->basePath;
        $search = ".$typeFile";
        $replace = "_$timeSt" . ".$typeFile";
        $newFile = str_replace($search, $replace, $file);
        if (rename($baseFile . $file, $baseFile . $newFile)) {
            return $newFile;
        }
        return FALSE;
    }
    
    /**
     * Function consultarDatosInscripcion
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Obtiene los datos de inscripción y el precio de la solicitud.)
     */
    public function consultarDatosInscripcion($twin_id) {
        $con = \Yii::$app->db_captacion;
        $con2 = \Yii::$app->db_facturacion;
        $con1 = \Yii::$app->db_academico;
        $estado = 1;
        $estado_precio = 'A';
        
        $sql = "SELECT  ua.uaca_nombre unidad, 
                        m.mod_nombre modalidad,
                        ea.eaca_nombre carrera,
                        mi.ming_nombre metodo,
                        ip.ipre_precio as precio,
                        twin_nombre,
                        twin_apellido,
                        twin_numero,
                        twin_correo,
                        twin_pais,
                        twin_celular,
                        twi.uaca_id,
                        twi.mod_id,
                        twi.car_id,
                        twin_metodo_ingreso,
                        conuteg_id,
                        ruta_doc_titulo,
                        ruta_doc_dni,
                        96 as ddit_valor,-- ddit.ddit_valor,
                        ruta_doc_certvota,
                        ruta_doc_foto,
                        ruta_doc_certificado,
                        ruta_doc_titulo
                FROM " . $con->dbname . ".temporal_wizard_inscripcion twi inner join db_academico.unidad_academica ua on ua.uaca_id = twi.uaca_id
                     inner join " . $con1->dbname . ".modalidad m on m.mod_id = twi.mod_id
                     inner join " . $con1->dbname . ".estudio_academico ea on ea.eaca_id = twi.car_id
                     inner join " . $con->dbname . ".metodo_ingreso mi on mi.ming_id = twi.twin_metodo_ingreso
                     inner join " . $con2->dbname . ".item_metodo_unidad imi on (imi.ming_id =  twi.twin_metodo_ingreso and imi.uaca_id = twi.uaca_id and imi.mod_id = twi.mod_id)
                     left join " . $con2->dbname . ".item_precio ip on ip.ite_id = imi.ite_id
                    left join " . $con2->dbname . ".descuento_item as ditem on ditem.ite_id=imi.ite_id
                    left join " . $con2->dbname . ".detalle_descuento_item as ddit on ddit.dite_id=ditem.dite_id
                WHERE twi.twin_id = :twin_id AND                     
                     ip.ipre_estado_precio = :estado_precio AND
                     ua.uaca_estado = :estado AND
                     ua.uaca_estado_logico = :estado AND
                     m.mod_estado = :estado AND
                     m.mod_estado_logico = :estado AND
                     ea.eaca_estado = :estado AND
                     ea.eaca_estado_logico = :estado AND
                     mi.ming_estado = :estado AND
                     mi.ming_estado_logico = :estado AND
                     imi.imni_estado = :estado AND
                     imi.imni_estado_logico = :estado AND
                     ip.ipre_estado = :estado AND
                     ip.ipre_estado_logico = :estado";
                
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":twin_id", $twin_id, \PDO::PARAM_INT);        
        $comando->bindParam(":estado_precio", $estado_precio, \PDO::PARAM_STR);
        $resultData = $comando->queryOne();
        return $resultData;
    }
    
    
    
    public function insertaOriginal($twinIds){
    
            //$codigo = $data['codigo'];
            $con = \Yii::$app->db_asgard;
            $con1 = \Yii::$app->db_captacion;
            $con2 = \Yii::$app->db_facturacion;
            $transaction = $con->beginTransaction();
            $transaction1 = $con1->beginTransaction();
            $transaction2 = $con2->beginTransaction();
            try {                
                //Se consulta la información grabada en la tabla temporal.
                $mod_inscripcion = new InscripcionAdmision();
                $resp_datos = $mod_inscripcion->consultarDatosInscripcion($twinIds); 
                Utilities::putMessageLogFile($resp_datos);
                // He colocado al inicio la informacion para que cargue al principio
                if ($resp_datos) {
                    $emp_id = 1;
                    $identificacion = '';
                    if (isset($resp_datos['twin_numero']) && strlen($resp_datos['twin_numero']) > 0) {
                        $identificacion = $resp_datos['twin_numero'];
                    } else {
                        $identificacion = $resp_datos['twin_numero'];
                    }
                    if (isset($identificacion) && strlen($identificacion) > 0) {
                        $id_persona = 0;
                        $mod_persona = new Persona();
                        $keys_per = [
                            'per_pri_nombre', 'per_seg_nombre', 'per_pri_apellido', 'per_seg_apellido', 'per_cedula', 'etn_id', 'eciv_id', 'per_genero', 'pai_id_nacimiento', 'pro_id_nacimiento', 'can_id_nacimiento', 'per_fecha_nacimiento', 'per_celular', 'per_correo', 'tsan_id', 'per_domicilio_sector', 'per_domicilio_cpri', 'per_domicilio_csec', 'per_domicilio_num', 'per_domicilio_ref', 'per_domicilio_telefono', 'pai_id_domicilio', 'pro_id_domicilio', 'can_id_domicilio', 'per_nac_ecuatoriano', 'per_nacionalidad', 'per_foto', 'per_estado', 'per_estado_logico'
                        ];
                        $parametros_per = [
                            ucwords(strtolower($resp_datos['twin_nombre'])), null, ucwords(strtolower($resp_datos['twin_apellido'])), null,
                            $resp_datos['twin_numero'], null, null, null, null, null,
                            null, null, $resp_datos['twin_celular'], $resp_datos['twin_correo'],
                            null, null, null, null,
                            null, null, null,
                            null, null, null,
                            null, null, null, 1, 1
                        ];
                        \app\models\Utilities::putMessageLogFile('va a proceder a ingresar la informacion');
                        $id_persona = $mod_persona->consultarIdPersona($resp_datos['twin_numero'], $resp_datos['twin_numero']);
                        if ($id_persona == 0) {
                            $id_persona = $mod_persona->insertarPersona($con, $parametros_per, $keys_per, 'persona');
                        }
                        if ($id_persona > 0) {
                            //Modifificaion para Mover Imagenes de temp a Persona
                            self::movePersonFiles($twinIds,$id_persona);
                            //
                            \app\models\Utilities::putMessageLogFile('ingreso la Persona');
                            $concap = \Yii::$app->db_captacion;
                            $mod_emp_persona = new EmpresaPersona();
                            $keys = ['emp_id', 'per_id', 'eper_estado', 'eper_estado_logico'];
                            $parametros = [$emp_id, $id_persona, 1, 1];
                            $emp_per_id = $mod_emp_persona->consultarIdEmpresaPersona($id_persona, $emp_id);
                            if ($emp_per_id == 0) {
                                $emp_per_id = $mod_emp_persona->insertarEmpresaPersona($con, $parametros, $keys, 'empresa_persona');
                            }
                            if ($emp_per_id > 0) {
                                \app\models\Utilities::putMessageLogFile('ingreso la empresa Persona');
                                $usuario = new Usuario();
                                $usuario_id = $usuario->consultarIdUsuario($id_persona, $resp_datos['twin_correo']);
                                if ($usuario_id == 0) {
                                    $security = new Security();
                                    $hash = $security->generateRandomString();
                                    $passencrypt = base64_encode($security->encryptByPassword($hash, 'Uteg2018'));
                                    $keys = ['per_id', 'usu_user', 'usu_sha', 'usu_password', 'usu_estado', 'usu_estado_logico'];
                                    $parametros = [$id_persona, $resp_datos['twin_correo'], $hash, $passencrypt, 1, 1];
                                    $usuario_id = $usuario->crearUsuarioTemporal($con, $parametros, $keys, 'usuario');
                                }
                                if ($usuario_id > 0) {
                                    \app\models\Utilities::putMessageLogFile('ingreso el usuario');
                                    $mod_us_gr_ep = new UsuaGrolEper();
                                    $grol_id = 30;
                                    $keys = ['eper_id', 'usu_id', 'grol_id', 'ugep_estado', 'ugep_estado_logico'];
                                    $parametros = [$emp_per_id, $usuario_id, $grol_id, 1, 1];
                                    $us_gr_ep_id = $mod_us_gr_ep->consultarIdUsuaGrolEper($emp_per_id, $usuario_id, $grol_id);
                                    if ($us_gr_ep_id == 0)
                                        $us_gr_ep_id = $mod_us_gr_ep->insertarUsuaGrolEper($con, $parametros, $keys, 'usua_grol_eper');
                                    if ($us_gr_ep_id > 0) {
                                        \app\models\Utilities::putMessageLogFile('ingreso el usuario grol');
                                        $mod_interesado = new Interesado(); // se guarda con estado_interesado 1
                                        $interesado_id = $mod_interesado->consultaInteresadoById($id_persona);
                                        $keys = ['per_id', 'int_estado_interesado', 'int_usuario_ingreso', 'int_estado', 'int_estado_logico'];
                                        $parametros = [$id_persona, 1, $usuario_id, 1, 1];
                                        if ($interesado_id == 0) {
                                            $interesado_id = $mod_interesado->insertarInteresado($concap, $parametros, $keys, 'interesado');
                                        }
                                        if ($interesado_id > 0) {
                                            \app\models\Utilities::putMessageLogFile('ingreso el interesado');
                                            $mod_inte_emp = new InteresadoEmpresa(); // se guarda con estado_interesado 1
                                            $iemp_id = $mod_inte_emp->consultaInteresadoEmpresaById($interesado_id, $emp_id);
                                            if ($iemp_id == 0) {
                                                $iemp_id = $mod_inte_emp->crearInteresadoEmpresa($interesado_id, $emp_id, $usuario_id);
                                            }
                                            if ($iemp_id > 0) {
                                                $eaca_id = NULL;
                                                $mest_id = NULL;
                                                if ($emp_id == 1) {//Uteg 
                                                    $eaca_id = $resp_datos['car_id'];
                                                } elseif ($emp_id == 2 || $emp_id == 3) {
                                                    $mest_id = $resp_datos['car_id'];
                                                }
                                                $num_secuencia = Secuencias::nuevaSecuencia($con, $emp_id, 1, 1, 'SOL');
                                                $sins_fechasol = date(Yii::$app->params["dateTimeByDefault"]);
                                                $rsin_id = 1; //Solicitud pendiente     
                                                $solins_model = new SolicitudInscripcion();
                                                //$mensaje = 'intId: ' . $interesado_id . '/uaca: ' . $pgest['unidad_academica'] . '/modalidad: ' . $pgest['modalidad'] . '/ming: ' . $pgest['ming_id'] . '/eaca: ' . $eaca_id . '/mest: ' . $mest_id . '/empresa: ' . $emp_id . '/secuencia: ' . $num_secuencia . '/rsin_id: ' . $rsin_id . '/sins_fechasol: ' . $sins_fechasol . '/usuario_id: ' . $usuario_id;
                                                $sins_id = $solins_model->insertarSolicitud($interesado_id, $resp_datos['uaca_id'], $resp_datos['mod_id'], $resp_datos['twin_metodo_ingreso'], $eaca_id, null, $emp_id, $num_secuencia, $rsin_id, $sins_fechasol, $usuario_id);
                                                //fin de solicitud inscripcion$mest_id
                                                //grabar los documentos
                              
                                                $resulDoc1 = $solins_model->insertarDocumentosSolic($sins_id, $interesado_id, 1, $resp_datos['ruta_doc_titulo'], $usuario_id); 
                                                $resulDoc2 = $solins_model->insertarDocumentosSolic($sins_id, $interesado_id, 2, $resp_datos['ruta_doc_dni'], $usuario_id); 
                                                $resulDoc3 = $solins_model->insertarDocumentosSolic($sins_id, $interesado_id, 3, $resp_datos['ruta_doc_certvota'], $usuario_id); 
                                                $resulDoc4 = $solins_model->insertarDocumentosSolic($sins_id, $interesado_id, 4, $resp_datos['ruta_doc_foto'], $usuario_id); 
                                                if ($resp_datos['twin_metodo_ingreso']==4) {
                                                    $resulDoc5 = $solins_model->insertarDocumentosSolic($sins_id, $interesado_id, 5, $resp_datos['ruta_doc_certificado'], $usuario_id); 
                                                }
                                                \app\models\Utilities::putMessageLogFile('solicitud: ' . $mensaje);
                                                if ($sins_id) {
                                                    \app\models\Utilities::putMessageLogFile('ingreso la solicitud: ' . $sins_id);                                                                                            
                                                    //Obtener el precio de la solicitud.
                                                    if ($beca == "1") {
                                                        $precio = 0;
                                                    } else {
                                                        $resp_precio = $solins_model->ObtenerPrecio($resp_datos['twin_metodo_ingreso'], $resp_datos['uaca_id'], $resp_datos['mod_id'], $eaca_id);
                                                        if ($resp_precio) {
                                                            $precio = $resp_precio['precio'];
                                                        } else {
                                                            $mensaje = 'No existe registrado ningún precio para la unidad, modalidad y método de ingreso seleccionada.';
                                                            $errorprecio = 0;
                                                        }
                                                    }
                                                    $mod_ordenpago = new OrdenPago();
                                                    //Se verifica si seleccionó descuento.
                                                    //descuento para grado online y posgrado no tiene descuento, caso contrario es 96 dol
                                                    if ($resp_datos['uaca_id']==1) {
                                                        if (($resp_datos['mod_id'] ==2) or ($resp_datos['mod_id'] ==3) or ($resp_datos['mod_id'] ==4)) {
                                                            $val_descuento = 96;
                                                        }
                                                    }
                                                    
                                                    //Generar la orden de pago con valor correspondiente. Buscar precio para orden de pago.                                                                     
                                                    if ($precio == 0) {
                                                        $estadopago = 'S';
                                                    } else {
                                                        $estadopago = 'P';
                                                    }
                                                    $val_total = $precio - $val_descuento;
                                                    $resp_opago = $mod_ordenpago->insertarOrdenpago($sins_id, null, $val_total, 0, $val_total, $estadopago, $usuario_id);
                                                    if ($resp_opago) {
                                                        //insertar desglose del pago                                    
                                                        $fecha_ini = date(Yii::$app->params["dateByDefault"]);
                                                        \app\models\Utilities::putMessageLogFile('orden pago: '.$resp_opago);
                                                        $resp_dpago = $mod_ordenpago->insertarDesglosepago($resp_opago, $val_total, 0, $val_total, $fecha_ini, null, $estadopago, $usuario_id);
                                                        if ($resp_dpago) {
                                                            $exito = 1;                                                                                              
                                                            \app\models\Utilities::putMessageLogFile('mensaje final:' . $exito);
                                                        }
                                                    }
                                                }
                                            } else {
                                                $error_message .= Yii::t("formulario", "The enterprise interested hasn't been saved");
                                                $error++;
                                            }
                                        } else {
                                            $error_message .= Yii::t("formulario", "The interested person hasn't been saved");
                                            $error++;
                                        }
                                    } else {
                                        $error_message .= Yii::t("formulario", "The rol user have not been saved");
                                        $error++;
                                    }
                                } else {
                                    $error_message .= Yii::t("formulario", "The user have not been saved");
                                    $error++;
                                }
                            } else {
                                $error_message .= Yii::t("formulario", "The enterprise interested hasn't been saved");
                                $error++;
                            }
                        } else {
                            $error++;
                            $error_message .= Yii::t("formulario", "The person have not been saved");
                        }
                    } else {
                        $error_message .= Yii::t("formulario", "Update DNI to generate interested");
                        $error++;
                    }
                } else {
                    $error_message .= Yii::t("formulario", "No existen datos para registrar.");
                    $error++;
                }
                if ($exito == 1) {
                    $transaction->commit();                    
                    $transaction1->commit();
                    $transaction2->commit();

                    $message = array(
                        "wtmessage" => Yii::t("formulario", "The information have been saved and the information has been sent to your email"),
                        "title" => Yii::t('jslang', 'Success'),
                    );
                    //return Utilities::ajaxResponse('OK', 'alert', Yii::t("jslang", "Sucess"), false, $message);
                    $arroout["status"] = TRUE;
                    $arroout["error"] = null;
                    $arroout["message"] = $message;
                    $arroout["data"] = null;//$rawData;
                    return $arroout;
                } else {
                    /*$transaction->rollback();
                    $transaction1->rollback();
                    $transaction2->rollback();*/
                    $message = array(
                        "wtmessage" => Yii::t("formulario", "Mensaje1: " . $mensaje), //$error_message
                        "title" => Yii::t('jslang', 'Bad Request'),
                    );
                    $arroout["status"] = FALSE;
                    $arroout["error"] =null;
                    $arroout["message"] = $message;
                    $arroout["data"] = null;
                    return $arroout;
                    //return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
                }
            } catch (Exception $ex) {
                /*$transaction->rollback();
                $transaction1->rollback();
                $transaction2->rollback();*/
                $message = array(
                    "wtmessage" => Yii::t("formulario", "Mensaje2: " . $mensaje), //$error_message
                    "title" => Yii::t('jslang', 'Bad Request'),
                );
                $arroout["status"] = FALSE;
                $arroout["error"] = $ex->getCode();
                $arroout["message"] = $ex->getMessage();
                $arroout["data"] = null;
                return $arroout;
                //return Utilities::ajaxResponse('NO_OK', 'alert', Yii::t("jslang", "Bad Request"), false, $message);
            }
            return;
    }

    public static function movePersonFiles($temp_id, $per_id){
        $folder = Yii::$app->basePath . "/" . Yii::$app->params["documentFolder"] . "solicitudadmision/$temp_id/";
        $destinations = Yii::$app->basePath . "/" . Yii::$app->params["documentFolder"] . "solicitudinscripcion/$per_id/";
        if(Utilities::verificarDirectorio($destinations)){
            $files = scandir($folder);
            foreach ($files as $file) {
                if(trim($file) != "." && trim($file) != ".."){
                    $arrExt = explode(".", $file);
                    $type = $arrExt[count($arrExt) - 1];
                    $newFile = str_replace("_".$temp_id.".".$type, "_".$per_id.".".$type, $file);
                    if(!rename($folder . $file , $destinations . $newFile)){
                        return false;
                    }
                }
            }
            rmdir($folder);
        }else
            return false;
        return true;
    }

}
