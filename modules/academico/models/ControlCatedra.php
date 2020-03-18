<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "control_catedra".
 *
 * @property int $cca_id
 * @property int $hape_id
 * @property int $eaca_id
 * @property string $cca_fecha_registro
 * @property string $cca_titulo_unidad
 * @property string $cca_tema
 * @property string $cca_trabajo_autopractico
 * @property string $cca_logro_aprendizaje
 * @property string $cca_observacion
 * @property string $cca_direccion_ip
 * @property int $usu_id
 * @property string $cca_estado
 * @property string $cca_fecha_creacion
 * @property string $cca_fecha_modificacion
 * @property string $cca_estado_logico
 *
 * @property HorarioAsignaturaPeriodo $hape
 * @property EstudioAcademico $eaca
 * @property DetalleCatedraActividad[] $detalleCatedraActividads
 * @property DetalleValorDesarrollo[] $detalleValorDesarrollos
 */
class ControlCatedra extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'control_catedra';
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
            [['hape_id', 'cca_titulo_unidad', 'cca_tema', 'cca_trabajo_autopractico', 'cca_logro_aprendizaje', 'usu_id', 'cca_estado', 'cca_estado_logico'], 'required'],
            [['hape_id', 'eaca_id', 'usu_id'], 'integer'],
            [['cca_fecha_registro', 'cca_fecha_creacion', 'cca_fecha_modificacion'], 'safe'],
            [['cca_titulo_unidad'], 'string', 'max' => 500],
            [['cca_tema', 'cca_trabajo_autopractico', 'cca_logro_aprendizaje', 'cca_observacion'], 'string', 'max' => 2000],
            [['cca_direccion_ip'], 'string', 'max' => 20],
            [['cca_estado', 'cca_estado_logico'], 'string', 'max' => 1],
            [['hape_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioAsignaturaPeriodo::className(), 'targetAttribute' => ['hape_id' => 'hape_id']],
            [['eaca_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstudioAcademico::className(), 'targetAttribute' => ['eaca_id' => 'eaca_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'cca_id' => 'Cca ID',
            'hape_id' => 'Hape ID',
            'eaca_id' => 'Eaca ID',
            'cca_fecha_registro' => 'Cca Fecha Registro',
            'cca_titulo_unidad' => 'Cca Titulo Unidad',
            'cca_tema' => 'Cca Tema',
            'cca_trabajo_autopractico' => 'Cca Trabajo Autopractico',
            'cca_logro_aprendizaje' => 'Cca Logro Aprendizaje',
            'cca_observacion' => 'Cca Observacion',
            'cca_direccion_ip' => 'Cca Direccion Ip',
            'usu_id' => 'Usu ID',
            'cca_estado' => 'Cca Estado',
            'cca_fecha_creacion' => 'Cca Fecha Creacion',
            'cca_fecha_modificacion' => 'Cca Fecha Modificacion',
            'cca_estado_logico' => 'Cca Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHape() {
        return $this->hasOne(HorarioAsignaturaPeriodo::className(), ['hape_id' => 'hape_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEaca() {
        return $this->hasOne(EstudioAcademico::className(), ['eaca_id' => 'eaca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCatedraActividads() {
        return $this->hasMany(DetalleCatedraActividad::className(), ['cca_id' => 'cca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleValorDesarrollos() {
        return $this->hasMany(DetalleValorDesarrollo::className(), ['cca_id' => 'cca_id']);
    }

    /**
     * Function consultarMateriasMarcabyPro
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>    
     * @property integer $userid
     * @return  
     */
    public function consultarHorarioxhapeid($hape_id, $onlyData = false) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $estado = 1;
        $sql = "
                    SELECT
                        hap.hape_hora_entrada as entrada,
                        hap.hape_hora_salida as salida,
                        hap.dia_id as dia,
                        hap.uaca_id as unidad,
                        hap.mod_id as modalidad,
                        asig.asi_nombre as materia,
                        hap.pro_id as profesor,
                        concat(pers.per_pri_nombre, ' ',pers.per_pri_apellido) as docente,
                        ifnull(CONCAT(sem.saca_anio,' (',blq.baca_nombre,'-',sem.saca_nombre,')'),sem.saca_anio) as periodo
                        FROM
                        db_academico.horario_asignatura_periodo hap
                        INNER JOIN " . $con->dbname . ".profesor prof ON prof.pro_id = hap.pro_id
                        INNER JOIN " . $con->dbname . ".asignatura asig ON asig.asi_id = hap.asi_id
                        INNER JOIN " . $con->dbname . ".periodo_academico paca ON paca.paca_id = hap.paca_id
                        LEFT JOIN " . $con->dbname . ".semestre_academico sem ON sem.saca_id = paca.saca_id
                        LEFT JOIN " . $con->dbname . ".bloque_academico blq ON blq.baca_id = paca.baca_id
                        INNER JOIN " . $con1->dbname . ".persona pers ON pers.per_id = prof.per_id
                        WHERE
                        DATE_FORMAT(hap.hape_fecha_clase,'%Y-%m-%d') is null AND paca_fecha_fin > now() AND paca_fecha_inicio <= now() AND
                        hap.hape_id = :hape_id AND
                        hap.hape_estado = :estado AND
                        hap.hape_estado_logico = :estado AND
                        prof.pro_estado = :estado AND
                        prof.pro_estado_logico = :estado AND
                        asig.asi_estado = :estado AND
                        asig.asi_estado_logico = :estado AND
                        paca.paca_activo = 'A' 
               ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":hape_id", $hape_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [
                ],
            ],
        ]);
        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function obtener Modalidad segun nivel interes estudio
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function consultarActividadevaluacion() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT ace.aeva_id as id,
                       ace.aeva_nombre as value
                    FROM " . $con->dbname . ".actividad_evaluacion ace                 
                    WHERE 
                    ace.aeva_estado_logico = :estado
                    and ace.aeva_estado = :estado                    
                    -- ORDER BY name asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function obtener Modalidad segun nivel interes estudio
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function consultarValordesarrollo() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT vde.vdes_id as id,
                       vde.vdes_nombre as value
                    FROM " . $con->dbname . ".valor_desarrollo vde                 
                    WHERE 
                    vde.vdes_estado_logico = :estado
                    and vde.vdes_estado = :estado                    
                    -- ORDER BY name asc";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

}
