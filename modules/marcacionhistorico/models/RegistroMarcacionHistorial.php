<?php

namespace app\modules\marcacionhistorico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "registro_marcacion_historial".
 *
 * @property int $rmhi_id
 * @property int $haph_id
 * @property string $rmhi_fecha_hora_entrada
 * @property string $rmhi_fecha_hora_salida
 * @property string $rmhi_estado
 * @property string $rmhi_fecha_creacion
 * @property string $rmhi_fecha_modificacion
 * @property string $rmhi_estado_logico
 *
 * @property HorarioAsignaturaPeriodoHistorial $haph
 */
class RegistroMarcacionHistorial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registro_marcacion_historial';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_marcacion_historico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['haph_id', 'rmhi_estado', 'rmhi_estado_logico'], 'required'],
            [['haph_id'], 'integer'],
            [['rmhi_fecha_hora_entrada', 'rmhi_fecha_hora_salida', 'rmhi_fecha_creacion', 'rmhi_fecha_modificacion'], 'safe'],
            [['rmhi_estado', 'rmhi_estado_logico'], 'string', 'max' => 1],
            [['haph_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioAsignaturaPeriodoHistorial::className(), 'targetAttribute' => ['haph_id' => 'haph_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rmhi_id' => 'Rmhi ID',
            'haph_id' => 'Haph ID',
            'rmhi_fecha_hora_entrada' => 'Rmhi Fecha Hora Entrada',
            'rmhi_fecha_hora_salida' => 'Rmhi Fecha Hora Salida',
            'rmhi_estado' => 'Rmhi Estado',
            'rmhi_fecha_creacion' => 'Rmhi Fecha Creacion',
            'rmhi_fecha_modificacion' => 'Rmhi Fecha Modificacion',
            'rmhi_estado_logico' => 'Rmhi Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHaph()
    {
        return $this->hasOne(HorarioAsignaturaPeriodoHistorial::className(), ['haph_id' => 'haph_id']);
    }
    /**
     * Function consultarMarcacionHistorica
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>    
     * @property  
     * @return  
     */
    public function consultarMarcacionHistorica($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $con2 = \Yii::$app->db_marcacion_historico;
        $estado = 1;
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search .= "(per.per_pri_nombre like :profesor OR ";
            $str_search .= "per.per_seg_nombre like :profesor OR ";
            $str_search .= "per.per_pri_apellido like :profesor OR ";
            $str_search .= "per.per_seg_nombre like :profesor )  AND ";
            $str_search .= "asig.asi_nombre like :materia  AND ";

            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "rmh.rmhi_fecha_creacion >= :fec_ini AND ";
                $str_search .= "rmh.rmhi_fecha_creacion <= :fec_fin AND ";
            }
            /*if ($arrFiltro['periodo'] != "" && $arrFiltro['periodo'] > 0) {
                $str_search .= " hap.paca_id = :periodo AND ";
            }*/
        }
        if ($onlyData == false) {
             $periodoacademico = ', rmh.haph_id as periodo ';           
        }
        $sql = "
               SELECT rmh.rmhi_id,
                    -- rmh.haph_id,
                    CONCAT(ifnull(per.per_pri_nombre,' '), ' ', ifnull(per.per_pri_apellido,' ')) as nombres,
                    asig.asi_nombre as materia,  
                    DATE_FORMAT(rmh.rmhi_fecha_hora_entrada, '%Y-%m-%d') as fecha,
                        DATE_FORMAT(rmh.rmhi_fecha_hora_entrada, '%H:%i:%s') as hora_inicio,
                    DATE_FORMAT(rmh.rmhi_fecha_hora_salida, '%H:%i:%s') as hora_salida
                    $periodoacademico                                  
                    FROM " . $con2->dbname . ".registro_marcacion_historial rmh
                    INNER JOIN " . $con2->dbname . ".horario_asignatura_periodo_historial hap on hap.haph_id = rmh.haph_id
                    INNER JOIN " . $con->dbname . ".profesor profe on profe.pro_id = hap.pro_id
                    INNER JOIN " . $con1->dbname . ".persona per on per.per_id = profe.per_id 
                    INNER JOIN " . $con->dbname . ".asignatura asig on asig.asi_id = hap.asi_id                  
                    WHERE $str_search                    
                    rmh.rmhi_estado = :estado AND
                    rmh.rmhi_estado_logico = :estado AND
                    hap.haph_estado = :estado AND
                    hap.haph_estado_logico = :estado AND
                    profe.pro_estado = :estado AND
                    profe.pro_estado_logico = :estado AND
                    per.per_estado = :estado AND
                    per.per_estado_logico = :estado AND
                    asig.asi_estado = :estado AND
                    asig.asi_estado_logico = :estado
                    GROUP BY nombres,materia,fecha, rmh.rmhi_id
                    ORDER BY fecha DESC
               ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["profesor"] . "%";
            $comando->bindParam(":profesor", $search_cond, \PDO::PARAM_STR);
            $fecha_ini = $arrFiltro["f_ini"] . " 00:00:00";
            $fecha_fin = $arrFiltro["f_fin"] . " 23:59:59";
            $materia = "%" . $arrFiltro["materia"] . "%";
            $comando->bindParam(":materia", $materia, \PDO::PARAM_STR);

            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
            }
            /*if ($arrFiltro['periodo'] != "" && $arrFiltro['periodo'] > 0) {
                $periodo = $arrFiltro["periodo"];
                $comando->bindParam(":periodo", $periodo, \PDO::PARAM_INT);
            }*/
        }
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
}
