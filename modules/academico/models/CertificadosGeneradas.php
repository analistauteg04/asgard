<?php

namespace app\modules\academico\models;

use yii\base\Exception;
use Yii;
use yii\data\ArrayDataProvider;
use app\models\Utilities;

/**
 * This is the model class for table "certificados_generadas".
 *
 * @property int $cgen_id
 * @property int $egen_id
 * @property string $cgen_codigo
 * @property string $cgen_observacion
 * @property string $cgen_fecha_codigo_generado
 * @property string $cgen_fecha_certificado_subido
 * @property string $cgen_fecha_caducidad
 * @property string $cgen_ruta_archivo_pdf
 * @property int $cgen_usuario_ingreso
 * @property int $cgen_usuario_modifica
 * @property string $cgen_estado
 * @property string $cgen_fecha_creacion
 * @property string $cgen_fecha_modificacion
 * @property string $cgen_estado_logico
 *
 * @property EspeciesGeneradas $egen
 */
class CertificadosGeneradas extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'certificados_generadas';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_academico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['egen_id', 'cgen_codigo', 'cgen_estado_logico'], 'required'],
            [['egen_id', 'cgen_usuario_ingreso', 'cgen_usuario_modifica'], 'integer'],
            [['cgen_observacion'], 'string'],
            [['cgen_fecha_codigo_generado', 'cgen_fecha_certificado_subido', 'cgen_fecha_caducidad', 'cgen_fecha_creacion', 'cgen_fecha_modificacion'], 'safe'],
            [['cgen_codigo'], 'string', 'max' => 100],
            [['cgen_ruta_archivo_pdf'], 'string', 'max' => 500],
            [['cgen_estado', 'cgen_estado_logico'], 'string', 'max' => 1],
            [['cgen_codigo'], 'unique'],
            [['egen_id'], 'exist', 'skipOnError' => true, 'targetClass' => EspeciesGeneradas::className(), 'targetAttribute' => ['egen_id' => 'egen_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'cgen_id' => 'Cgen ID',
            'egen_id' => 'Egen ID',
            'cgen_codigo' => 'Cgen Codigo',
            'cgen_observacion' => 'Cgen Observacion',
            'cgen_fecha_codigo_generado' => 'Cgen Fecha Codigo Generado',
            'cgen_fecha_certificado_subido' => 'Cgen Fecha Certificado Subido',
            'cgen_fecha_caducidad' => 'Cgen Fecha Caducidad',
            'cgen_ruta_archivo_pdf' => 'Cgen Ruta Archivo Pdf',
            'cgen_usuario_ingreso' => 'Cgen Usuario Ingreso',
            'cgen_usuario_modifica' => 'Cgen Usuario Modifica',
            'cgen_estado' => 'Cgen Estado',
            'cgen_fecha_creacion' => 'Cgen Fecha Creacion',
            'cgen_fecha_modificacion' => 'Cgen Fecha Modificacion',
            'cgen_estado_logico' => 'Cgen Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEgen() {
        return $this->hasOne(EspeciesGeneradas::className(), ['egen_id' => 'egen_id']);
    }

    /**
     * Function insertarCodigocertificado
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return cgen_id
     */
    public function insertarCodigocertificado($egen_id, $cgen_codigo, $cgen_fecha_codigo_generado, $cgen_estado_certificado, $cgen_usuario_ingreso) {
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "cgen_estado";
        $bdet_sql = "1";

        $param_sql .= ", cgen_estado_logico";
        $bdet_sql .= ", 1";

        if (isset($egen_id)) {
            $param_sql .= ", egen_id";
            $bdet_sql .= ", :egen_id";
        }
        if (isset($cgen_codigo)) {
            $param_sql .= ", cgen_codigo";
            $bdet_sql .= ", :cgen_codigo";
        }
        if (isset($cgen_fecha_codigo_generado)) {
            $param_sql .= ", cgen_fecha_codigo_generado";
            $bdet_sql .= ", :cgen_fecha_codigo_generado";
        }
        if (isset($cgen_estado_certificado)) {
            $param_sql .= ", cgen_estado_certificado";
            $bdet_sql .= ", :cgen_estado_certificado";
        }
        if (isset($cgen_usuario_ingreso)) {
            $param_sql .= ", cgen_usuario_ingreso";
            $bdet_sql .= ", :cgen_usuario_ingreso";
        }
        try {
            $sql = "INSERT INTO " . $con->dbname . ".certificados_generadas ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);

            if (isset($egen_id)) {
                $comando->bindParam(':egen_id', $egen_id, \PDO::PARAM_INT);
            }
            if (isset($cgen_codigo)) {
                $comando->bindParam(':cgen_codigo', $cgen_codigo, \PDO::PARAM_STR);
            }
            if (!empty((isset($cgen_fecha_codigo_generado)))) {
                $comando->bindParam(':cgen_fecha_codigo_generado', $cgen_fecha_codigo_generado, \PDO::PARAM_STR);                
            }
            if (!empty((isset($cgen_estado_certificado)))) {
                $comando->bindParam(':cgen_estado_certificado', $cgen_estado_certificado, \PDO::PARAM_STR);
            }
            if (!empty((isset($cgen_usuario_ingreso)))) {
                $comando->bindParam(':cgen_usuario_ingreso', $cgen_usuario_ingreso, \PDO::PARAM_INT);
            }           
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.certificados_generadas');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

}
