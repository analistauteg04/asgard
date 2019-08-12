<?php

namespace app\modules\admision\models;

use Yii;

/**
 * This is the model class for table "inscrito_maestria".
 *
 * @property int $imae_id
 * @property int $cemp_id
 * @property int $gint_id
 * @property int $pai_id_
 * @property int $pro_id
 * @property int $can_id
 * @property string $imae_tipo_documento
 * @property string $imae_documento
 * @property string $imae_primer_nombre
 * @property string $imae_segundo_nombre
 * @property string $imae_primer_apellido
 * @property string $imae_segundo_apellido
 * @property string $imae_revisar_urgente
 * @property string $imae_cumple_requisito
 * @property string $imae_agente
 * @property string $imae_fecha_inscripcion
 * @property string $imae_fecha_pago
 * @property double $imae_pago_inscripcion
 * @property double $imae_valor_maestria
 * @property int $fpag_id
 * @property string $imae_estado_pago
 * @property string $imae_convenios
 * @property int $imae_usuario
 * @property int $imae_usuario_modif
 * @property string $imae_estado
 * @property string $imae_fecha_creacion
 * @property string $imae_fecha_modificacion
 * @property string $imae_estado_logico
 *
 * @property GrupoIntroductorio $gint
 */
class InscritoMaestria extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'inscrito_maestria';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_crm');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['cemp_id', 'gint_id', 'pai_id_', 'pro_id', 'can_id', 'fpag_id', 'imae_usuario', 'imae_usuario_modif'], 'integer'],
            [['gint_id', 'imae_primer_nombre', 'imae_primer_apellido', 'imae_usuario', 'imae_estado', 'imae_estado_logico'], 'required'],
            [['imae_pago_inscripcion', 'imae_valor_maestria'], 'number'],
            [['imae_fecha_creacion', 'imae_fecha_modificacion'], 'safe'],
            [['imae_tipo_documento', 'imae_cumple_requisito', 'imae_estado_pago'], 'string', 'max' => 2],
            [['imae_documento'], 'string', 'max' => 50],
            [['imae_primer_nombre', 'imae_segundo_nombre', 'imae_primer_apellido', 'imae_segundo_apellido', 'imae_revisar_urgente', 'imae_agente', 'imae_convenios'], 'string', 'max' => 100],
            [['imae_fecha_inscripcion', 'imae_fecha_pago'], 'string', 'max' => 20],
            [['imae_estado', 'imae_estado_logico'], 'string', 'max' => 1],
            [['gint_id'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoIntroductorio::className(), 'targetAttribute' => ['gint_id' => 'gint_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'imae_id' => 'Imae ID',
            'cemp_id' => 'Cemp ID',
            'gint_id' => 'Gint ID',
            'pai_id_' => 'Pai ID',
            'pro_id' => 'Pro ID',
            'can_id' => 'Can ID',
            'imae_tipo_documento' => 'Imae Tipo Documento',
            'imae_documento' => 'Imae Documento',
            'imae_primer_nombre' => 'Imae Primer Nombre',
            'imae_segundo_nombre' => 'Imae Segundo Nombre',
            'imae_primer_apellido' => 'Imae Primer Apellido',
            'imae_segundo_apellido' => 'Imae Segundo Apellido',
            'imae_revisar_urgente' => 'Imae Revisar Urgente',
            'imae_cumple_requisito' => 'Imae Cumple Requisito',
            'imae_agente' => 'Imae Agente',
            'imae_fecha_inscripcion' => 'Imae Fecha Inscripcion',
            'imae_fecha_pago' => 'Imae Fecha Pago',
            'imae_pago_inscripcion' => 'Imae Pago Inscripcion',
            'imae_valor_maestria' => 'Imae Valor Maestria',
            'fpag_id' => 'Fpag ID',
            'imae_estado_pago' => 'Imae Estado Pago',
            'imae_convenios' => 'Imae Convenios',
            'imae_usuario' => 'Imae Usuario',
            'imae_usuario_modif' => 'Imae Usuario Modif',
            'imae_estado' => 'Imae Estado',
            'imae_fecha_creacion' => 'Imae Fecha Creacion',
            'imae_fecha_modificacion' => 'Imae Fecha Modificacion',
            'imae_estado_logico' => 'Imae Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGint() {
        return $this->hasOne(GrupoIntroductorio::className(), ['gint_id' => 'gint_id']);
    }

    /**
     * Function insertarInscritoMaestria grabar la inserción inscritos.
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarInscritoMaestria($cemp_id, $gint_id, $pai_id, $pro_id, $can_id, $imae_tipo_documento, $imae_documento, $imae_primer_nombre, $imae_segundo_nombre, $imae_primer_apellido, $imae_segundo_apellido, $imae_revisar_urgente, $imae_cumple_requisito, $imae_agente, $imae_fecha_inscripcion, $imae_fecha_pago, $imae_pago_inscripcion, $imae_valor_maestria, $fpag_id, $imae_estado_pago, $imae_convenios, $imae_usuario, $imae_fecha_creacion) {
        $con = \Yii::$app->db_crm;
         
        $param_sql = "imae_estado";
        $bdet_sql = "1";

        $param_sql .= ", imae_estado_logico";
        $bdet_sql .= ", 1";        

        if (isset($cemp_id)) {
            $param_sql .= ", cemp_id";
            $bdet_sql .= ", :cemp_id";
        }
        if (isset($gint_id)) {
            $param_sql .= ", gint_id";
            $bdet_sql .= ", :gint_id";
        }
        if (isset($pai_id)) {
            $param_sql .= ", pai_id";
            $bdet_sql .= ", :pai_id";
        }
        if (isset($pro_id)) {
            $param_sql .= ", pro_id";
            $bdet_sql .= ", :pro_id";
        }
        if (isset($can_id)) {
            $param_sql .= ", can_id";
            $bdet_sql .= ", :can_id";
        }
        if (!empty((isset($imae_tipo_documento)))) { 
            $param_sql .= ", imae_tipo_documento";
            $bdet_sql .= ", :imae_tipo_documento";
        }
        if (!empty((isset($imae_documento)))) {
            $param_sql .= ", imae_documento";
            $bdet_sql .= ", :imae_documento";
        }
        if (!empty((isset($imae_primer_nombre)))) {
            $param_sql .= ", imae_primer_nombre";
            $bdet_sql .= ", :imae_primer_nombre";
        }
        if (!empty((isset($imae_segundo_nombre)))) {
            $param_sql .= ", imae_segundo_nombre";
            $bdet_sql .= ", :imae_segundo_nombre";
        }
        if (!empty((isset($imae_primer_apellido)))) {
            $param_sql .= ", imae_primer_apellido";
            $bdet_sql .= ", :imae_primer_apellido";
        }
        if (!empty((isset($imae_segundo_apellido)))) {
            $param_sql .= ", imae_segundo_apellido";
            $bdet_sql .= ", :imae_segundo_apellido";
        }
        if (!empty((isset($imae_revisar_urgente)))) {
            $param_sql .= ", imae_revisar_urgente";
            $bdet_sql .= ", :imae_revisar_urgente";
        }
        if (!empty((isset($imae_cumple_requisito)))) {
            $param_sql .= ", imae_cumple_requisito";
            $bdet_sql .= ", :imae_cumple_requisito";
        }
        if (!empty((isset($imae_agente)))) {
            $param_sql .= ", imae_agente";
            $bdet_sql .= ", :imae_agente";
        }
        if (!empty((isset($imae_fecha_inscripcion)))) {
            $param_sql .= ", imae_fecha_inscripcion";
            $bdet_sql .= ", :imae_fecha_inscripcion";
        }
        if (!empty((isset($imae_fecha_pago)))) {
            $param_sql .= ", imae_fecha_pago";
            $bdet_sql .= ", :imae_fecha_pago";
        }
        if (!empty((isset($imae_pago_inscripcion)))) {
            $param_sql .= ", imae_pago_inscripcion";
            $bdet_sql .= ", :imae_pago_inscripcion";
        }
        if (!empty((isset($imae_valor_maestria)))) {
            $param_sql .= ", imae_valor_maestria";
            $bdet_sql .= ", :imae_valor_maestria";
        }
        if (!empty((isset($fpag_id)))) {
            $param_sql .= ", fpag_id";
            $bdet_sql .= ", :fpag_id";
        }
        if (!empty((isset($imae_estado_pago)))) {
            $param_sql .= ", imae_estado_pago";
            $bdet_sql .= ", :imae_estado_pago";
        }
        if (!empty((isset($imae_convenios)))) {
            $param_sql .= ", imae_convenios";
            $bdet_sql .= ", :imae_convenios";
        }
        if (isset($imae_usuario)) {
            $param_sql .= ", imae_usuario";
            $bdet_sql .= ", :imae_usuario";
        }     
        if (isset($imae_fecha_creacion)) {
            $param_sql .= ", imae_fecha_creacion";
            $bdet_sql .= ", :imae_fecha_creacion";
        }
        
        try {
            $sql = "INSERT INTO " . $con->dbname . ".inscrito_maestria ($param_sql) VALUES($bdet_sql)";
            
            $comando = $con->createCommand($sql);
            if (isset($cemp_id)) {
                $comando->bindParam(':cemp_id', $cemp_id, \PDO::PARAM_INT);
                \app\models\Utilities::putMessageLogFile('$cemp_id:'.$cemp_id);  
            }
            if (isset($gint_id)) {
                $comando->bindParam(':gint_id', $gint_id, \PDO::PARAM_INT);
                \app\models\Utilities::putMessageLogFile('$gint_id:'.$gint_id);  
            }
            if (isset($pai_id)) {
                $comando->bindParam(':pai_id', $pai_id, \PDO::PARAM_INT);
                \app\models\Utilities::putMessageLogFile('$pai_id:'.$pai_id);  
            }
            if (isset($pro_id)) {
                $comando->bindParam(':pro_id', $pro_id, \PDO::PARAM_INT);
                \app\models\Utilities::putMessageLogFile('$pro_id:'.$pro_id);  
            }
            if (isset($can_id)) {
                $comando->bindParam(':can_id', $can_id, \PDO::PARAM_INT);
                \app\models\Utilities::putMessageLogFile('$can_id:'.$can_id);  
            }
            if (!empty((isset($imae_tipo_documento)))) {
                $comando->bindParam(':imae_tipo_documento', $imae_tipo_documento, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_tipo_documento:'.$imae_tipo_documento);  
            }
            if (isset($imae_documento)) {
                $comando->bindParam(':imae_documento', $imae_documento, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_documento:'.$imae_documento);  
            }
            if (!empty((isset($imae_primer_nombre)))) {
                $comando->bindParam(':imae_primer_nombre', $imae_primer_nombre, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_primer_nombre:'.$imae_primer_nombre);  
            }
            if (!empty((isset($imae_segundo_nombre)))) {
                $comando->bindParam(':imae_segundo_nombre', $imae_segundo_nombre, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_segundo_nombre:'.$imae_segundo_nombre);  
            }
            if (!empty((isset($imae_primer_apellido)))) {
                $comando->bindParam(':imae_primer_apellido', $imae_primer_apellido, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_primer_apellido:'.$imae_primer_apellido);  
            }
            if (!empty((isset($imae_segundo_apellido)))) {
                $comando->bindParam(':imae_segundo_apellido', $imae_segundo_apellido, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_segundo_apellido:'.$imae_segundo_apellido);  
            }            
            if (!empty((isset($imae_revisar_urgente)))) {
                $comando->bindParam(':imae_revisar_urgente', $imae_revisar_urgente, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_revisar_urgente:'.$imae_revisar_urgente);  
            }
            if (!empty((isset($imae_cumple_requisito)))) {
                $comando->bindParam(':imae_cumple_requisito', $imae_cumple_requisito, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_cumple_requisito:'.$imae_cumple_requisito);  
            }
            if (!empty((isset($imae_agente)))) {
                $comando->bindParam(':imae_agente', $imae_agente, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_agente:'.$imae_agente);  
            }
            if (!empty((isset($imae_fecha_inscripcion)))) {
                $comando->bindParam(':imae_fecha_inscripcion', $imae_fecha_inscripcion, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_fecha_inscripcion:'.$imae_fecha_inscripcion);  
            }
            if (!empty((isset($imae_fecha_pago)))) {
                $comando->bindParam(':imae_fecha_pago', $imae_fecha_pago, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_fecha_pago:'.$imae_fecha_pago);  
            }
            if (!empty((isset($imae_pago_inscripcion)))) {
                $comando->bindParam(':imae_pago_inscripcion', $imae_pago_inscripcion, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_pago_inscripcion:'.$imae_pago_inscripcion);  
            }
            if (!empty((isset($imae_valor_maestria)))) {
                $comando->bindParam(':imae_valor_maestria', $imae_valor_maestria, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_valor_maestria:'.$imae_valor_maestria);  
            }           
            if (!empty((isset($fpag_id)))) {
                $comando->bindParam(':fpag_id', $fpag_id, \PDO::PARAM_INT);
                \app\models\Utilities::putMessageLogFile('$fpag_id:'.$fpag_id);  
            }
            if (!empty((isset($imae_estado_pago)))) {
                $comando->bindParam(':imae_estado_pago', $imae_estado_pago, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_estado_pago:'.$imae_estado_pago);  
            }
            if (!empty((isset($imae_convenios)))) {
                $comando->bindParam(':imae_convenios', $imae_convenios, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_convenios:'.$imae_convenios);  
            }
            if (!empty((isset($imae_usuario)))) {
                $comando->bindParam(':imae_usuario', $imae_usuario, \PDO::PARAM_INT);
                \app\models\Utilities::putMessageLogFile('$imae_usuario:'.$imae_usuario);  
            }
             if (!empty((isset($imae_fecha_creacion)))) {
                $comando->bindParam(':imae_fecha_creacion', $imae_fecha_creacion, \PDO::PARAM_STR);
                \app\models\Utilities::putMessageLogFile('$imae_fecha_creacion:'.$imae_fecha_creacion);  
            }
            $result = $comando->execute();            
            return $con->getLastInsertID($con->dbname . '.inscrito_maestria');
        } catch (Exception $ex) {           
            return FALSE;
        }
    }

}
