<?php

namespace app\modules\academico\models;
use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "malla_academica".
 *
 * @property int $maca_id
 * @property string $maca_tipo
 * @property string $maca_codigo
 * @property string $maca_nombre
 * @property string $maca_fecha_vigencia_inicio
 * @property string $maca_fecha_vigencia_fin
 * @property int $maca_usuario_ingreso
 * @property int $maca_usuario_modifica
 * @property string $maca_estado
 * @property string $maca_fecha_creacion
 * @property string $maca_fecha_modificacion
 * @property string $maca_estado_logico
 *
 * @property MallaAcademicaDetalle[] $mallaAcademicaDetalles
 * @property MallaUnidadModalidad[] $mallaUnidadModalidads
 * @property PlanificacionAcademicaMalla[] $planificacionAcademicaMallas
 */
class MallaAcademica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'malla_academica';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_academico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['maca_nombre', 'maca_usuario_ingreso', 'maca_estado', 'maca_estado_logico'], 'required'],
            [['maca_fecha_vigencia_inicio', 'maca_fecha_vigencia_fin', 'maca_fecha_creacion', 'maca_fecha_modificacion'], 'safe'],
            [['maca_usuario_ingreso', 'maca_usuario_modifica'], 'integer'],
            [['maca_tipo', 'maca_estado', 'maca_estado_logico'], 'string', 'max' => 1],
            [['maca_codigo'], 'string', 'max' => 50],
            [['maca_nombre'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'maca_id' => 'Maca ID',
            'maca_tipo' => 'Maca Tipo',
            'maca_codigo' => 'Maca Codigo',
            'maca_nombre' => 'Maca Nombre',
            'maca_fecha_vigencia_inicio' => 'Maca Fecha Vigencia Inicio',
            'maca_fecha_vigencia_fin' => 'Maca Fecha Vigencia Fin',
            'maca_usuario_ingreso' => 'Maca Usuario Ingreso',
            'maca_usuario_modifica' => 'Maca Usuario Modifica',
            'maca_estado' => 'Maca Estado',
            'maca_fecha_creacion' => 'Maca Fecha Creacion',
            'maca_fecha_modificacion' => 'Maca Fecha Modificacion',
            'maca_estado_logico' => 'Maca Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMallaAcademicaDetalles()
    {
        return $this->hasMany(MallaAcademicaDetalle::className(), ['maca_id' => 'maca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMallaUnidadModalidads()
    {
        return $this->hasMany(MallaUnidadModalidad::className(), ['maca_id' => 'maca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanificacionAcademicaMallas()
    {
        return $this->hasMany(PlanificacionAcademicaMalla::className(), ['maca_id' => 'maca_id']);
    }
    
    
     /**
     * Function consultar mallas académicas
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>         
     * @property  
     * @return  
     */
    public function consultarMallas($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_academico;
        
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['search'] != "") {
                $str_search .= "m.maca_nombre like :malla AND ";                
            }            
        }
            
        $sql = "SELECT  maca_id, maca_codigo, maca_nombre, 
                        ifnull(maca_fecha_vigencia_inicio,'') as fechainicial, 
                        ifnull(maca_fecha_vigencia_fin,'') as fechafin
                FROM " . $con->dbname . ".malla_academica m
                WHERE $str_search
                      maca_estado = '1'
                      and maca_estado_logico = '1'";

        $comando = $con->createCommand($sql);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['search'] != "") {
                $search_cond = "%" . $arrFiltro["search"] . "%";
                $comando->bindParam(":malla", $search_cond, \PDO::PARAM_STR);
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
     * Function consultar detalle de mallas académicas
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>         
     * @property  
     * @return  
     */
    public function consultarDetallemallaXid($maca_id, $arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_academico;
        
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['search'] != "") {
                $str_search .= "(a.asi_nombre like :asignatura) AND ";                
            }            
        }
            
        $sql = "SELECT  d.made_codigo_asignatura,    
                        a.asi_nombre, 
                        d.made_semestre,
                        d.made_credito,
                        u.uest_nombre,       
                        f.fmac_nombre,
                        ifnull(asi.asi_nombre,'') as materia_requisito
                FROM db_academico.malla_academica m inner join db_academico.malla_academica_detalle d on d.maca_id = m.maca_id
                    inner join db_academico.asignatura a on a.asi_id = d.asi_id
                    inner join db_academico.unidad_estudio u on u.uest_id = d.uest_id
                    inner join db_academico.nivel_estudio n on n.nest_id = d.nest_id
                    inner join db_academico.formacion_malla_academica f on f.fmac_id = d.fmac_id
                    left join db_academico.asignatura asi on asi.asi_id = d.made_asi_requisito
                WHERE $str_search
                    m.maca_id = :malla
                    and m.maca_estado = '1'
                    and m.maca_estado_logico = '1'
                    and d.made_estado = '1'
                    and d.made_estado = '1'";

        $comando = $con->createCommand($sql);        
        $comando->bindParam(":malla", $maca_id, \PDO::PARAM_INT);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['search'] != "") {
                $search_cond = "%" . $arrFiltro["search"] . "%";
                $comando->bindParam(":asignatura", $search_cond, \PDO::PARAM_STR);
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
