<?php

namespace app\modules\repositorio\models;
use yii\data\ArrayDataProvider;
use Yii;

/**
 * This is the model class for table "documento_repositorio".
 *
 * @property int $dre_id
 * @property int $est_id
 * @property int $dre_tipo
 * @property string $dre_codificacion
 * @property string $dre_ruta
 * @property string $dre_imagen
 * @property int $dre_usu_modifica
 * @property string $dre_estado
 * @property string $dre_fecha_archivo
 * @property string $dre_fecha_creacion
 * @property string $dre_fecha_modificacion
 * @property string $dre_estado_logico
 *
 * @property Estandar $est
 */
class DocumentoRepositorio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento_repositorio';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_repositorio');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['est_id', 'dre_codificacion', 'dre_ruta', 'dre_imagen', 'dre_estado', 'dre_estado_logico'], 'required'],
            [['est_id', 'dre_tipo', 'dre_usu_modifica'], 'integer'],
            [['dre_fecha_archivo', 'dre_fecha_creacion', 'dre_fecha_modificacion'], 'safe'],
            [['dre_codificacion', 'dre_imagen'], 'string', 'max' => 100],
            [['dre_ruta'], 'string', 'max' => 200],
            [['dre_estado', 'dre_estado_logico'], 'string', 'max' => 1],
            [['est_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estandar::className(), 'targetAttribute' => ['est_id' => 'est_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dre_id' => 'Dre ID',
            'est_id' => 'Est ID',
            'dre_tipo' => 'Dre Tipo',
            'dre_codificacion' => 'Dre Codificacion',
            'dre_ruta' => 'Dre Ruta',
            'dre_imagen' => 'Dre Imagen',
            'dre_usu_modifica' => 'Dre Usu Modifica',
            'dre_estado' => 'Dre Estado',
            'dre_fecha_archivo' => 'Dre Fecha Archivo',
            'dre_fecha_creacion' => 'Dre Fecha Creacion',
            'dre_fecha_modificacion' => 'Dre Fecha Modificacion',
            'dre_estado_logico' => 'Dre Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEst()
    {
        return $this->hasOne(Estandar::className(), ['est_id' => 'est_id']);
    }
    
    
     /**
     * Function consultarDocumentos consultar documentos
     * @author Grace Viteri <analistadesarrollo01@uteg.edu.ec>;
     * @param 
     * @return
     */
    public function consultarDocumentos($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_repositorio;        
        $estado = 1;
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['est_id'] != "") {
                $str_search = "and est_id = :est_id ";
            }
            if ($arrFiltro['search'] != "") {
                $str_search = "and dre_imagen like :archivo ";                
            }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "and dre_fecha_archivo >= :fec_ini and ";
                $str_search .= "dre_fecha_archivo <= :fec_fin ";
            }            
        }
        $sql = "SELECT 	dre_imagen, case when dre_tipo='1' then 'Público' else 'Privado' end tipo,  
                        dre_descripcion, dre_fecha_archivo, dre_fecha_creacion, dre_ruta
                FROM " . $con->dbname . ".documento_repositorio dr
                WHERE dre_estado = :estado
                      and dre_estado_logico = :estado ";              
        if (!empty($str_search)) {
            $sql .= " $str_search  
                    ORDER BY dre_fecha_creacion desc ";
        } else {
            $sql .= " ORDER BY dre_fecha_creacion desc";
        }
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $est_id = $arrFiltro["est_id"];
            $archivo = "%" . $arrFiltro["search"] . "%";   
            $fecha_ini = $arrFiltro["f_ini"];
            $fecha_fin = $arrFiltro["f_fin"];
            if ($arrFiltro['est_id'] != "") {
                $comando->bindParam(":est_id", $est_id, \PDO::PARAM_INT);
            }
            if ($arrFiltro['search'] != "") {
                $comando->bindParam(":archivo", $archivo, \PDO::PARAM_STR);
            } 
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
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
