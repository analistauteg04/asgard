<?php

namespace app\modules\formulario\models;

use Yii;

/**
 * This is the model class for table "persona_formulario".
 *
 * @property int $pfor_id
 * @property string $pfor_nombres
 * @property string $pfor_apellidos
 * @property string $pfor_identificacion
 * @property string $pfor_tipo_dni
 * @property string $pfor_correo
 * @property string $pfor_celular
 * @property string $pfor_telefono
 * @property int $pro_id
 * @property int $can_id
 * @property string $pfor_institucion
 * @property int $uaca_id
 * @property int $eaca_id
 * @property string $pfor_estudio_anterior
 * @property int $ins_id
 * @property string $pfor_carrera_anterior
 * @property string $pfor_estado
 * @property string $pfor_fecha_registro
 * @property string $pfor_fecha_creacion
 * @property string $pfor_fecha_modificacion
 * @property string $pfor_estado_logico
 */
class PersonaFormulario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona_formulario';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_externo');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pfor_nombres', 'pfor_apellidos', 'pfor_identificacion', 'pfor_tipo_dni', 'pfor_correo', 'pro_id', 'can_id', 'pfor_institucion', 'uaca_id', 'eaca_id', 'pfor_estudio_anterior', 'pfor_estado', 'pfor_estado_logico'], 'required'],
            [['pro_id', 'can_id', 'uaca_id', 'eaca_id', 'ins_id'], 'integer'],
            [['pfor_fecha_registro', 'pfor_fecha_creacion', 'pfor_fecha_modificacion'], 'safe'],
            [['pfor_nombres', 'pfor_apellidos'], 'string', 'max' => 60],
            [['pfor_identificacion'], 'string', 'max' => 15],
            [['pfor_tipo_dni'], 'string', 'max' => 5],
            [['pfor_correo'], 'string', 'max' => 50],
            [['pfor_celular', 'pfor_telefono'], 'string', 'max' => 20],
            [['pfor_institucion'], 'string', 'max' => 500],
            [['pfor_estudio_anterior', 'pfor_carrera_anterior', 'pfor_estado', 'pfor_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pfor_id' => 'Pfor ID',
            'pfor_nombres' => 'Pfor Nombres',
            'pfor_apellidos' => 'Pfor Apellidos',
            'pfor_identificacion' => 'Pfor Identificacion',
            'pfor_tipo_dni' => 'Pfor Tipo Dni',
            'pfor_correo' => 'Pfor Correo',
            'pfor_celular' => 'Pfor Celular',
            'pfor_telefono' => 'Pfor Telefono',
            'pro_id' => 'Pro ID',
            'can_id' => 'Can ID',
            'pfor_institucion' => 'Pfor Institucion',
            'uaca_id' => 'Uaca ID',
            'eaca_id' => 'Eaca ID',
            'pfor_estudio_anterior' => 'Pfor Estudio Anterior',
            'ins_id' => 'Ins ID',
            'pfor_carrera_anterior' => 'Pfor Carrera Anterior',
            'pfor_estado' => 'Pfor Estado',
            'pfor_fecha_registro' => 'Pfor Fecha Registro',
            'pfor_fecha_creacion' => 'Pfor Fecha Creacion',
            'pfor_fecha_modificacion' => 'Pfor Fecha Modificacion',
            'pfor_estado_logico' => 'Pfor Estado Logico',
        ];
    }
    

    /**
     * Function obtener carreras segun unidad academica 
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function consultarCarreraProgXUnidad($unidad) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "
                SELECT distinct eac.eaca_nombre as name,
                        eac.eaca_id as id                        
                    FROM
                        " . $con->dbname . ".modalidad_estudio_unidad as mcn
                        INNER JOIN " . $con->dbname . ".estudio_academico as eac on eac.eaca_id = mcn.eaca_id
                    WHERE 
                        mcn.uaca_id =:unidad AND                        
                        eac.eaca_estado_logico=:estado AND
                        eac.eaca_estado=:estado AND
                        mcn.meun_estado_logico = :estado AND
                        mcn.meun_estado = :estado
                        ORDER BY name asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":unidad", $unidad, \PDO::PARAM_INT);
        $comando->bindParam(":modalidad", $modalidad, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }   
    
    /**
     * Function consultar por Identificación
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function consultarXIdentificacion($identificacion)
    {
        $con = \Yii::$app->db_externo;
        $estado = 1;        
        $sql = "    SELECT 'S' existe
                    FROM 
                         " . $con->dbname . ".persona_formulario
                    WHERE pfor_identificacion = :identificacion AND
                        pfor_estado=:estado AND
                        pfor_estado_logico=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);       
        $comando->bindParam(":identificacion", $identificacion, \PDO::PARAM_STR); 
        $resultData = $comando->queryOne();
        return $resultData;        
    }
    
    /**
     * Function insertar personas insertPersonaFormulario
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function insertPersonaFormulario($con, $data) {  
        $estado = 1;
        $fecha_actual = date(Yii::$app->params["dateTimeByDefault"]);        
        if ($data['pfor_est_ant']==1) {
            $sql = "INSERT INTO " . $con->dbname . ".persona_formulario
            (pfor_tipo_dni,pfor_identificacion,pfor_nombres,pfor_apellidos,pfor_correo,pfor_celular,pfor_telefono,
             pro_id,can_id, pfor_institucion, uaca_id, eaca_id, pfor_estudio_anterior, ins_id, pfor_carrera_anterior, 
             pfor_fecha_registro, pfor_estado, pfor_estado_logico) VALUES
            (:pfor_tipo_dni,:pfor_identificacion,:pfor_nombres,:pfor_apellidos,:pfor_correo,:pfor_celular,:pfor_telefono,
             :pro_id,:can_id, :pfor_institucion, :uaca_id, :eaca_id, :pfor_est_ant, :ins_id, :pfor_carrera_ant, 
             :pfor_fecha_registro, :pfor_estado, :pfor_estado)";
        } else {
            $sql = "INSERT INTO " . $con->dbname . ".persona_formulario
            (pfor_tipo_dni,pfor_identificacion,pfor_nombres,pfor_apellidos,pfor_correo,pfor_celular,pfor_telefono,
             pro_id,can_id, pfor_institucion, uaca_id, eaca_id, pfor_estudio_anterior, 
             pfor_fecha_registro, pfor_estado, pfor_estado_logico) VALUES
            (:pfor_tipo_dni,:pfor_identificacion,:pfor_nombres,:pfor_apellidos,:pfor_correo,:pfor_celular,:pfor_telefono,
             :pro_id,:can_id, :pfor_institucion, :uaca_id, :eaca_id, :pfor_est_ant, 
             :pfor_fecha_registro, :pfor_estado, :pfor_estado)";
        }        
                
        $command = $con->createCommand($sql);        
        $command->bindParam(":pfor_tipo_dni",  $data['pfor_tipoidentifica'], \PDO::PARAM_STR);
        $command->bindParam(":pfor_identificacion",  $data['pfor_identificacion'], \PDO::PARAM_STR);
        $command->bindParam(":pfor_nombres",  $data['pfor_nombres'], \PDO::PARAM_STR);
        $command->bindParam(":pfor_apellidos", $data['pfor_apellidos'], \PDO::PARAM_STR);
        $command->bindParam(":pfor_correo", $data['pfor_correo'], \PDO::PARAM_STR);
        $command->bindParam(":pfor_celular", $data['pfofr_celular'], \PDO::PARAM_STR);
        $command->bindParam(":pfor_telefono", $data['pfor_telefono'], \PDO::PARAM_STR);       
        $command->bindParam(":pro_id", $data['pro_id'], \PDO::PARAM_INT);
        $command->bindParam(":can_id", $data['can_id'], \PDO::PARAM_INT);    
        $command->bindParam(":pfor_institucion", $data['pfor_institucion'], \PDO::PARAM_STR);    
        $command->bindParam(":uaca_id", $data['uaca_id'], \PDO::PARAM_INT);    
        $command->bindParam(":eaca_id", $data['eaca_id'], \PDO::PARAM_INT);    
        $command->bindParam(":pfor_est_ant", $data['pfor_est_ant'], \PDO::PARAM_STR);  
        if ($data['pfor_est_ant']==1) {
            $command->bindParam(":ins_id", $data['ins_id'], \PDO::PARAM_INT);    
            $command->bindParam(":pfor_carrera_ant", $data['pfor_carrera_ant'], \PDO::PARAM_STR);                 
        }                                                              
        $command->bindParam(":pfor_fecha_registro", $fecha_actual, \PDO::PARAM_STR);         
        $command->bindParam(":pfor_estado", $estado, \PDO::PARAM_STR);      
        $command->execute();
        return $con->getLastInsertID();
    }
}
