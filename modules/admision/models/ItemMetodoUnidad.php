<?php

namespace app\modules\admision\models;

use Yii;

/**
 * This is the model class for table "item_metodo_unidad".
 *
 * @property int $imni_id
 * @property int $ite_id
 * @property int $ming_id
 * @property int $uaca_id
 * @property int $mod_id
 * @property int $mest_id
 * @property int $imni_usu_ingreso
 * @property int $imni_usu_modifica
 * @property string $imni_estado
 * @property string $imni_fecha_creacion
 * @property string $imni_fecha_modificacion
 * @property string $imni_estado_logico
 *
 * @property Item $ite
 */
class ItemMetodoUnidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_metodo_unidad';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_facturacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imni_id', 'ite_id', 'imni_usu_ingreso', 'imni_estado', 'imni_estado_logico'], 'required'],
            [['imni_id', 'ite_id', 'ming_id', 'uaca_id', 'mod_id', 'mest_id', 'imni_usu_ingreso', 'imni_usu_modifica'], 'integer'],
            [['imni_fecha_creacion', 'imni_fecha_modificacion'], 'safe'],
            [['imni_estado', 'imni_estado_logico'], 'string', 'max' => 1],
            [['imni_id'], 'unique'],
            [['ite_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['ite_id' => 'ite_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'imni_id' => 'Imni ID',
            'ite_id' => 'Ite ID',
            'ming_id' => 'Ming ID',
            'uaca_id' => 'Uaca ID',
            'mod_id' => 'Mod ID',
            'mest_id' => 'Mest ID',
            'imni_usu_ingreso' => 'Imni Usu Ingreso',
            'imni_usu_modifica' => 'Imni Usu Modifica',
            'imni_estado' => 'Imni Estado',
            'imni_fecha_creacion' => 'Imni Fecha Creacion',
            'imni_fecha_modificacion' => 'Imni Fecha Modificacion',
            'imni_estado_logico' => 'Imni Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIte()
    {
        return $this->hasOne(Item::className(), ['ite_id' => 'ite_id']);
    }
    
    /**
     * Function consultarXitemMetniv
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Para obtener el id del item, filtrando por nivel de interés,
     *                       modalidad y método de ingreso.)
     */
    public function consultarXitemMetniv($nint_id, $mod_id, $ming_id) {        
        $con = \Yii::$app->db_facturacion;        
        $estado = 1;
        $sql = "SELECT ite_id 
                FROM  " . $con->dbname . ".item_metodo_unidad
                WHERE uaca_id = :nint_id
                      and mod_id = :mod_id
                      and ming_id = :ming_id
                      and imni_estado = :estado
                      and imni_estado_logico = :estado";        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":nint_id", $nint_id, \PDO::PARAM_INT);
        $comando->bindParam(":ming_id", $ming_id, \PDO::PARAM_INT);
        $comando->bindParam(":mod_id", $mod_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;                
    }
}
