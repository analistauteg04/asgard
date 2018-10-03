<?php

namespace app\modules\admision\models;

use yii\data\ArrayDataProvider;
use DateTime;
use Yii;

/**
 * This is the model class for table "solicitudins_documento".
 *
 * @property integer $sdoc_id
 * @property integer $sins_id
 * @property integer $int_id
 * @property integer $dadj_id
 * @property string $sdoc_archivo
 * @property string $sdoc_estado
 * @property string $sdoc_fecha_creacion
 * @property string $sdoc_fecha_modificacion
 * @property string $sdoc_estado_logico
 *
 * @property SolicitudInscripcion $sins
 * @property Interesado $int
 * @property DocumentoAdjuntar $dadj
 */
class SolicitudinsDocumento extends \app\modules\admision\components\CActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        //return 'solicitudins_documento';
        return \Yii::$app->db_captacion->dbname . '.solicitudins_documento';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['sins_id', 'int_id', 'dadj_id', 'sdoc_archivo', 'sdoc_estado', 'sdoc_estado_logico'], 'required'],
            [['sins_id', 'int_id', 'dadj_id'], 'integer'],
            [['sdoc_fecha_creacion', 'sdoc_fecha_modificacion'], 'safe'],
            [['sdoc_archivo'], 'string', 'max' => 500],
            [['sdoc_estado', 'sdoc_estado_logico'], 'string', 'max' => 1],
            [['sins_id'], 'exist', 'skipOnError' => true, 'targetClass' => SolicitudInscripcion::className(), 'targetAttribute' => ['sins_id' => 'sins_id']],
            [['int_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interesado::className(), 'targetAttribute' => ['int_id' => 'int_id']],
            [['dadj_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentoAdjuntar::className(), 'targetAttribute' => ['dadj_id' => 'dadj_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'sdoc_id' => 'Sdoc ID',
            'sins_id' => 'Sins ID',
            'int_id' => 'Int ID',
            'dadj_id' => 'Dadj ID',
            'sdoc_archivo' => 'Sdoc Archivo',
            'sdoc_estado' => 'Sdoc Estado',
            'sdoc_fecha_creacion' => 'Sdoc Fecha Creacion',
            'sdoc_fecha_modificacion' => 'Sdoc Fecha Modificacion',
            'sdoc_estado_logico' => 'Sdoc Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSins() {
        return $this->hasOne(SolicitudInscripcion::className(), ['sins_id' => 'sins_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInt() {
        return $this->hasOne(Interesado::className(), ['int_id' => 'int_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDadj() {
        return $this->hasOne(DocumentoAdjuntar::className(), ['dadj_id' => 'dadj_id']);
    }

    /**
     * Function consulta solicitud id del x interesado
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   $usuario_id (id del interesado).  
     * @return  $resultData (id de la ultima solicitud).
     */

    /**
     * Function consultaDatosinteresado
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   $usuario_id (id del usuario).  
     * @return  $resultData (id del interesado).
     */
    public function getSolicitudxInteresado($int_id) {
        $con = \Yii::$app->db_captacion;        
        $estado = 1;
        $sql = "SELECT sins_id             
                FROM  " . $con->dbname . ".solicitudins_documento 
                WHERE 
                    int_id = :int_id AND
                    sdoc_estado_logico=:estado AND
                    sdoc_estado=:estado
                order by sdoc_fecha_creacion desc limit 1";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    public function insertNewDocument($sins_id, $int_id, $dadj_id, $sdoc_archivo){
        $con = \Yii::$app->db_captacion;
        $estado = 1;

        $sql = "INSERT INTO " . \Yii::$app->db_captacion->dbname . ".solicitudins_documento 
                (sins_id, int_id, dadj_id, sdoc_archivo, sdoc_estado, sdoc_estado_logico)
                VALUES(:sins_id, :int_id, :dadj_id, :sdoc_archivo, :estado, :estado)";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":sins_id", $sins_id, \PDO::PARAM_INT);
        $comando->bindParam(":int_id", $int_id, \PDO::PARAM_INT);
        $comando->bindParam(":dadj_id", $dadj_id, \PDO::PARAM_INT);
        $comando->bindParam(":sdoc_archivo", $sdoc_archivo, \PDO::PARAM_STR);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_INT);
        $resultData = $comando->execute();
        return $resultData;
    }

}
