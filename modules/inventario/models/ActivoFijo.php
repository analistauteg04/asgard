<?php

namespace app\modules\inventario\models;
use yii\data\ArrayDataProvider;

use Yii;

/**
 * This is the model class for table "activo_fijo".
 *
 * @property int $afij_id
 * @property int $einv_id
 * @property int $are_id
 * @property int $cat_id
 * @property int $afij_secuencia
 * @property string $afij_codigo
 * @property string $afij_custodio
 * @property string $afij_descripcion
 * @property string $afij_marca
 * @property string $afij_modelo
 * @property string $afij_num_serie
 * @property int $afij_cantidad
 * @property string $afij_ram
 * @property string $afij_disco_hdd
 * @property string $afij_disco_ssd
 * @property string $afij_procesador
 * @property string $afij_ip
 * @property string $afij_estado
 * @property string $afij_fecha_creacion
 * @property string $afij_fecha_modificacion
 * @property string $afij_estado_logico
 *
 * @property Categoria $cat
 * @property EmpresaInventario $einv
 */
class ActivoFijo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activo_fijo';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_inventario');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['einv_id', 'are_id', 'cat_id', 'afij_secuencia', 'afij_codigo', 'afij_custodio', 'afij_estado', 'afij_estado_logico'], 'required'],
            [['einv_id', 'are_id', 'cat_id', 'afij_secuencia', 'afij_cantidad'], 'integer'],
            [['afij_fecha_creacion', 'afij_fecha_modificacion'], 'safe'],
            [['afij_codigo'], 'string', 'max' => 50],
            [['afij_custodio'], 'string', 'max' => 200],
            [['afij_descripcion'], 'string', 'max' => 1000],
            [['afij_marca', 'afij_modelo', 'afij_num_serie', 'afij_ram', 'afij_disco_hdd', 'afij_disco_ssd', 'afij_procesador', 'afij_ip'], 'string', 'max' => 100],
            [['afij_estado', 'afij_estado_logico'], 'string', 'max' => 1],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['cat_id' => 'cat_id']],
            [['einv_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpresaInventario::className(), 'targetAttribute' => ['einv_id' => 'einv_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'afij_id' => 'Afij ID',
            'einv_id' => 'Einv ID',
            'are_id' => 'Are ID',
            'cat_id' => 'Cat ID',
            'afij_secuencia' => 'Afij Secuencia',
            'afij_codigo' => 'Afij Codigo',
            'afij_custodio' => 'Afij Custodio',
            'afij_descripcion' => 'Afij Descripcion',
            'afij_marca' => 'Afij Marca',
            'afij_modelo' => 'Afij Modelo',
            'afij_num_serie' => 'Afij Num Serie',
            'afij_cantidad' => 'Afij Cantidad',
            'afij_ram' => 'Afij Ram',
            'afij_disco_hdd' => 'Afij Disco Hdd',
            'afij_disco_ssd' => 'Afij Disco Ssd',
            'afij_procesador' => 'Afij Procesador',
            'afij_ip' => 'Afij Ip',
            'afij_estado' => 'Afij Estado',
            'afij_fecha_creacion' => 'Afij Fecha Creacion',
            'afij_fecha_modificacion' => 'Afij Fecha Modificacion',
            'afij_estado_logico' => 'Afij Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Categoria::className(), ['cat_id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEinv()
    {
        return $this->hasOne(EmpresaInventario::className(), ['einv_id' => 'einv_id']);
    }
    
    /**
     * Function consultarInventario consultar inventario
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param 
     * @return
     */
    public function consultarInventario($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_inventario;        
        $estado = 1;
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            /*if (($arrFiltro['est_id'] != "") && ($arrFiltro['est_id'] > 0)) {
                $str_search = "and dr.est_id = :est_id ";
            }            
            if (($arrFiltro['mod_id'] != "") && ($arrFiltro['mod_id'] > 0)){
                $str_search .= "and f.mod_id = :mod_id ";
            }
            if (($arrFiltro['cat_id'] != "") && ($arrFiltro['cat_id'] > 0)){
                $str_search .= "and e.fun_id = :fun_id ";
            }
            if (($arrFiltro['comp_id'] != "") && ($arrFiltro['comp_id'] > 0)){
                $str_search .= "and e.com_id = :comp_id ";
            }*/
        }
        $sql = "SELECT 	af.afij_codigo, af.afij_custodio, 
                        af.afij_marca, af.afij_modelo,
                        af.afij_num_serie, af.afij_cantidad,
                        ei.einv_descripcion as empresa,
                        a.are_descripcion as area, 
                        d.dep_nombre as departamento,
                        c.cat_descripcion as categoria
                FROM db_inventario.activo_fijo af inner join db_inventario.empresa_inventario ei on af.einv_id = ei.einv_id
                     inner join db_general.area a on a.are_id = af.are_id
                     inner join db_general.departamento d on d.dep_id = a.dep_id
                     inner join db_inventario.categoria c on c.cat_id = af.cat_id
                WHERE afij_estado = :estado and afij_estado_logico = :estado
                ORDER BY 1";        
                       
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {           
            $archivo = "%" . $arrFiltro["search"] . "%";               
            /*$mod_id = $arrFiltro["mod_id"];
            $fun_id = $arrFiltro["cat_id"];
            $comp_id = $arrFiltro["comp_id"];*/            
            if ($arrFiltro['search'] != "") {
                $comando->bindParam(":archivo", $archivo, \PDO::PARAM_STR);
            }             
            /*if (($arrFiltro['mod_id'] != "") && ($arrFiltro['mod_id'] > 0)){
                $comando->bindParam(":mod_id", $mod_id, \PDO::PARAM_INT);
            }
            if (($arrFiltro['cat_id'] != "") && ($arrFiltro['cat_id'] > 0)){
                $comando->bindParam(":fun_id", $fun_id, \PDO::PARAM_INT);
            }
            if (($arrFiltro['comp_id'] != "") && ($arrFiltro['comp_id'] > 0)){
                $comando->bindParam(":comp_id", $comp_id, \PDO::PARAM_INT);
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
