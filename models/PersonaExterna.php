<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona_externa".
 *
 * @property int $pext_id
 * @property string $pext_nombres
 * @property string $pext_apellidos
 * @property string $pext_correo
 * @property string $pext_celular
 * @property string $pext_telefono
 * @property string $pext_genero
 * @property int $pext_edad
 * @property int $nins_id
 * @property int $pro_id
 * @property int $can_id
 * @property string $pext_estado
 * @property string $pext_fecha_creacion
 * @property string $pext_fecha_modificacion
 * @property string $pext_estado_logico
 *
 * @property PersonaExternaIntereses[] $personaExternaIntereses
 */
class PersonaExterna extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona_externa';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_mailing');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pext_nombres', 'pext_apellidos', 'pext_correo', 'pext_celular', 'pext_genero', 'pext_edad', 'nins_id', 'pro_id', 'can_id', 'pext_estado', 'pext_estado_logico'], 'required'],
            [['pext_edad', 'nins_id', 'pro_id', 'can_id'], 'integer'],
            [['pext_fecha_creacion', 'pext_fecha_modificacion'], 'safe'],
            [['pext_nombres', 'pext_apellidos'], 'string', 'max' => 60],
            [['pext_correo'], 'string', 'max' => 50],
            [['pext_celular', 'pext_telefono'], 'string', 'max' => 20],
            [['pext_genero', 'pext_estado', 'pext_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pext_id' => 'Pext ID',
            'pext_nombres' => 'Pext Nombres',
            'pext_apellidos' => 'Pext Apellidos',
            'pext_correo' => 'Pext Correo',
            'pext_celular' => 'Pext Celular',
            'pext_telefono' => 'Pext Telefono',
            'pext_genero' => 'Pext Genero',
            'pext_edad' => 'Pext Edad',
            'nins_id' => 'Nins ID',
            'pro_id' => 'Pro ID',
            'can_id' => 'Can ID',
            'pext_estado' => 'Pext Estado',
            'pext_fecha_creacion' => 'Pext Fecha Creacion',
            'pext_fecha_modificacion' => 'Pext Fecha Modificacion',
            'pext_estado_logico' => 'Pext Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaExternaIntereses()
    {
        return $this->hasMany(PersonaExternaIntereses::className(), ['pext_id' => 'pext_id']);
    }
    
    public function insertPersonaExterna($con, $data) {  
        $estado = 1;
        $fecha_actual = date(Yii::$app->params["dateTimeByDefault"]);        
        $sql = "INSERT INTO " . $con->dbname . ".persona_externa
            (pext_nombres,pext_apellidos,pext_correo,pext_celular,pext_telefono,pext_genero,pext_edad,nins_id,pro_id,can_id,eve_id,
             pext_fecha_registro,pext_ip_registro,pext_estado,pext_estado_logico) VALUES
            (:pext_nombres,:pext_apellidos,:pext_correo,:pext_celular,:pext_telefono,:pext_genero,:pext_edad,:nins_id,:pro_id,:can_id,:eve_id,
             :pext_fecha_registro, TO_BASE64(:pext_ip_registro), :pben_estado, :pben_estado)";
        $command = $con->createCommand($sql);
        $command->bindParam(":pext_nombres",  $data['pext_nombres'], \PDO::PARAM_STR);
        $command->bindParam(":pext_apellidos", $data['pext_apellidos'], \PDO::PARAM_STR);
        $command->bindParam(":pext_correo", $data['pext_correo'], \PDO::PARAM_STR);
        $command->bindParam(":pext_celular", $data['pext_celular'], \PDO::PARAM_STR);
        $command->bindParam(":pext_telefono", $data['pext_telefono'], \PDO::PARAM_STR);
        $command->bindParam(":pext_genero", $data['pext_genero'], \PDO::PARAM_STR);
        $command->bindParam(":pext_edad", $data['pext_edad'], \PDO::PARAM_INT);
        $command->bindParam(":nins_id", $data['nins_id'], \PDO::PARAM_INT);
        $command->bindParam(":pro_id", $data['pro_id'], \PDO::PARAM_INT);
        $command->bindParam(":can_id", $data['can_id'], \PDO::PARAM_INT);        
        $command->bindParam(":eve_id", $data['eve_id'], \PDO::PARAM_INT); 
        $command->bindParam(":pext_fecha_registro", $fecha_actual, \PDO::PARAM_STR); 
        $command->bindParam(":pext_ip_registro", $data['pext_ip_registro'], \PDO::PARAM_STR); 
        $command->bindParam(":pben_estado", $estado, \PDO::PARAM_STR);            
        $command->execute();
        return $con->getLastInsertID();
    }
    
    public function consultarEvento()
    {
        $con = \Yii::$app->db_mailing;
        $estado = 1;
        $fecha_actual = date(Yii::$app->params["dateTimeByDefault"]);
        $sql = "    SELECT 
                        eve_id AS id,
                        eve_nombres AS value
                    FROM 
                         " . $con->dbname . ".evento
                    WHERE (:fecha_actual between eve_fecha_inicio and eve_fecha_fin) AND
                        eve_estado=:estado AND
                        eve_estado_logico=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);       
        $comando->bindParam(":fecha_actual", $fecha_actual, \PDO::PARAM_STR); 
        $resultData = $comando->queryAll();
        return $resultData;        
    }
}
