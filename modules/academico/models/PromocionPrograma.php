<?php

namespace app\modules\academico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "promocion_programa".
 *
 * @property int $ppro_id
 * @property string $ppro_anio
 * @property string $ppro_mes
 * @property string $ppro_codigo
 * @property int $uaca_id
 * @property int $mod_id
 * @property int $eaca_id
 * @property int $ppro_num_paralelo
 * @property int $ppro_cupo
 * @property int $ppro_usuario_ingresa
 * @property string $ppro_estado
 * @property string $ppro_fecha_creacion
 * @property int $ppro_usuario_modifica
 * @property string $ppro_fecha_modificacion
 * @property string $ppro_estado_logico
 *
 * @property MatriculacionProgramaInscrito[] $matriculacionProgramaInscritos
 * @property ParaleloPromocionPrograma[] $paraleloPromocionProgramas
 * @property UnidadAcademica $uaca
 * @property Modalidad $mod
 * @property EstudioAcademico $eaca
 */
class PromocionPrograma extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'promocion_programa';
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
            [['ppro_anio', 'ppro_mes', 'ppro_codigo', 'uaca_id', 'mod_id', 'eaca_id', 'ppro_num_paralelo', 'ppro_cupo', 'ppro_estado', 'ppro_estado_logico'], 'required'],
            [['uaca_id', 'mod_id', 'eaca_id', 'ppro_num_paralelo', 'ppro_cupo', 'ppro_usuario_ingresa', 'ppro_usuario_modifica'], 'integer'],
            [['ppro_fecha_creacion', 'ppro_fecha_modificacion'], 'safe'],
            [['ppro_anio'], 'string', 'max' => 4],
            [['ppro_mes'], 'string', 'max' => 2],
            [['ppro_codigo'], 'string', 'max' => 20],
            [['ppro_estado', 'ppro_estado_logico'], 'string', 'max' => 1],
            [['uaca_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadAcademica::className(), 'targetAttribute' => ['uaca_id' => 'uaca_id']],
            [['mod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modalidad::className(), 'targetAttribute' => ['mod_id' => 'mod_id']],
            [['eaca_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstudioAcademico::className(), 'targetAttribute' => ['eaca_id' => 'eaca_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'ppro_id' => 'Ppro ID',
            'ppro_anio' => 'Ppro Anio',
            'ppro_mes' => 'Ppro Mes',
            'ppro_codigo' => 'Ppro Codigo',
            'uaca_id' => 'Uaca ID',
            'mod_id' => 'Mod ID',
            'eaca_id' => 'Eaca ID',
            'ppro_num_paralelo' => 'Ppro Num Paralelo',
            'ppro_cupo' => 'Ppro Cupo',
            'ppro_usuario_ingresa' => 'Ppro Usuario Ingresa',
            'ppro_estado' => 'Ppro Estado',
            'ppro_fecha_creacion' => 'Ppro Fecha Creacion',
            'ppro_usuario_modifica' => 'Ppro Usuario Modifica',
            'ppro_fecha_modificacion' => 'Ppro Fecha Modificacion',
            'ppro_estado_logico' => 'Ppro Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculacionProgramaInscritos() {
        return $this->hasMany(MatriculacionProgramaInscrito::className(), ['ppro_id' => 'ppro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParaleloPromocionProgramas() {
        return $this->hasMany(ParaleloPromocionPrograma::className(), ['ppro_id' => 'ppro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUaca() {
        return $this->hasOne(UnidadAcademica::className(), ['uaca_id' => 'uaca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMod() {
        return $this->hasOne(Modalidad::className(), ['mod_id' => 'mod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEaca() {
        return $this->hasOne(EstudioAcademico::className(), ['eaca_id' => 'eaca_id']);
    }

    /**
     * Function getPromocion
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>
     * @param   
     * @return  $resultData (información del aspirante)
     */
    public static function getPromocion($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db;
        $con1 = \Yii::$app->db_academico;    
        $estado = 1;
        $columnsAdd = "";    

        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['search'] != "") {
                $str_search .= "ppr.ppro_codigo like :search AND ";
            }
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $str_search .= "ppr.uaca_id = :unidad AND ";
            }
            if ($arrFiltro['modalidad'] != "" && $arrFiltro['modalidad'] > 0) {
                $str_search .= "ppr.mod_id = :modalidad AND ";
            }
            if ($arrFiltro['programa'] != "" && $arrFiltro['programa'] > 0) {
                $str_search .= "ppr.eaca_id = :programa AND ";
            }            
        } 
        $sql = "SELECT 
                    ppr.ppro_codigo as codigo,
                    ppr.ppro_anio as anio,
                    CASE ppro_mes
                        WHEN  1 THEN 'Enero'
                        WHEN  2 THEN 'Febrero'
                        WHEN  3 THEN 'Marzo'
                        WHEN  4 THEN 'Abril'
                        WHEN  5 THEN 'Mayo'
                        WHEN  6 THEN 'Junio'
                        WHEN  7 THEN 'Julio'
                        WHEN  8 THEN 'Agosto'
                        WHEN  9 THEN 'Septiembre'
                        WHEN  10 THEN 'Octubre'
                        WHEN  11 THEN 'Noviembre'
                        WHEN  12 THEN 'Diciembre' 
                        ELSE ' ' END as mes,
                    uaca.uaca_nombre as unidad,
                    moda.mod_nombre as modalidad,
                    ea.eaca_nombre as programa,
                    ppr.ppro_num_paralelo as paralelo
                FROM " . $con1->dbname . ".promocion_programa ppr
                    INNER JOIN " . $con1->dbname . ".unidad_academica uaca on uaca.uaca_id = ppr.uaca_id
                    INNER JOIN " . $con1->dbname . ".modalidad moda on moda.mod_id = ppr.mod_id
                    INNER JOIN " . $con1->dbname . ".estudio_academico ea on ea.eaca_id = ppr.eaca_id
                WHERE 
                $str_search
                ppr.ppro_estado = :estado AND
                ppr.ppro_estado_logico = :estado AND                 
                uaca.uaca_estado = :estado AND
                uaca.uaca_estado_logico = :estado AND                
                moda.mod_estado = :estado AND
                moda.mod_estado_logico = :estado AND                
                ea.eaca_estado = :estado AND
                ea.eaca_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);     
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['search'] != "") {
                $search_cond = "%" . $arrFiltro["search"] . "%";
                $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
            }
            $unidad = $arrFiltro["unidad"];
            if ($arrFiltro['unidad'] != "" && $arrFiltro['unidad'] > 0) {
                $comando->bindParam(":unidad", $unidad, \PDO::PARAM_INT);
            }
            $modalidad = $arrFiltro["modalidad"];
            if ($arrFiltro['modalidad'] != "" && $arrFiltro['modalidad'] > 0) {
                $comando->bindParam(":modalidad", $modalidad, \PDO::PARAM_INT);
            }
            $programa = $arrFiltro["programa"];
            if ($arrFiltro['programa'] != "" && $arrFiltro['programa'] > 0) {
                $comando->bindParam(":programa", $programa, \PDO::PARAM_INT);
            }            
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
                    'ppr.ppro_codigo',
                    ' ppr.ppro_anio',
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
