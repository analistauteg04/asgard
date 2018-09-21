<?php

namespace app\modules\financiero\models;

use Yii;

/**
 * This is the model class for table "detalle_descuento_item".
 *
 * @property int $ddit_id
 * @property int $dite_id
 * @property string $ddit_descripcion
 * @property string $ddit_tipo_beneficio
 * @property double $ddit_porcentaje
 * @property double $ddit_valor
 * @property string $ddit_finicio
 * @property string $ddit_ffin
 * @property string $ddit_estado_descuento
 * @property int $ddit_usu_creacion
 * @property int $ddit_usu_modificacion
 * @property string $ddit_estado
 * @property string $ddit_fecha_creacion
 * @property string $ddit_fecha_modificacion
 * @property string $ddit_estado_logico
 *
 * @property DescuentoItem $dite
 * @property HistorialDescuentoItem[] $historialDescuentoItems
 */
class DetalleDescuentoItem extends \app\modules\financiero\components\CActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'detalle_descuento_item';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_facturacion');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['dite_id', 'ddit_estado_descuento', 'ddit_estado'], 'required'],
            [['dite_id', 'ddit_usu_creacion', 'ddit_usu_modificacion'], 'integer'],
            [['ddit_porcentaje', 'ddit_valor'], 'number'],
            [['ddit_finicio', 'ddit_ffin', 'ddit_fecha_creacion', 'ddit_fecha_modificacion'], 'safe'],
            [['ddit_descripcion'], 'string', 'max' => 100],
            [['ddit_tipo_beneficio', 'ddit_estado_descuento', 'ddit_estado', 'ddit_estado_logico'], 'string', 'max' => 1],
            [['dite_id'], 'exist', 'skipOnError' => true, 'targetClass' => DescuentoItem::className(), 'targetAttribute' => ['dite_id' => 'dite_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'ddit_id' => 'Ddit ID',
            'dite_id' => 'Dite ID',
            'ddit_descripcion' => 'Ddit Descripcion',
            'ddit_tipo_beneficio' => 'Ddit Tipo Beneficio',
            'ddit_porcentaje' => 'Ddit Porcentaje',
            'ddit_valor' => 'Ddit Valor',
            'ddit_finicio' => 'Ddit Finicio',
            'ddit_ffin' => 'Ddit Ffin',
            'ddit_estado_descuento' => 'Ddit Estado Descuento',
            'ddit_usu_creacion' => 'Ddit Usu Creacion',
            'ddit_usu_modificacion' => 'Ddit Usu Modificacion',
            'ddit_estado' => 'Ddit Estado',
            'ddit_fecha_creacion' => 'Ddit Fecha Creacion',
            'ddit_fecha_modificacion' => 'Ddit Fecha Modificacion',
            'ddit_estado_logico' => 'Ddit Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDite() {
        return $this->hasOne(DescuentoItem::className(), ['dite_id' => 'dite_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialDescuentoItems() {
        return $this->hasMany(HistorialDescuentoItem::className(), ['ddit_id' => 'ddit_id']);
    }

    /**
     * Function consultarDesctoxitem
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Para obtener el id del item, filtrando por nivel de interés,
     *                       modalidad y método de ingreso.)
     */
    public function consultarDesctoxitem($ite_id) {
        $con = \Yii::$app->db_facturacion;
        $estado = 1;
        $sql = "SELECT ddi.ddit_id as id, ddi.ddit_descripcion as name
                FROM " . $con->dbname . ".detalle_descuento_item ddi inner join " . $con->dbname . ".descuento_item di
                        on di.dite_id = ddi.dite_id
                where di.ite_id = :ite_id
                      and ddi.ddit_estado_descuento = 'A'
                      and di.dite_estado = :estado
                      and di.dite_estado_logico = :estado
                      and ddi.ddit_estado = :estado
                      and ddi.ddit_estado_logico = :estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":ite_id", $ite_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultarValdctoItem
     * @author  Grace Viteri <analistadesarrollo01@uteg.edu.ec>
     * @param   
     * @return  $resultData (Para obtener el valor del descuento del item.)
     */
    public function consultarValdctoItem($dite_id) {
        $con = \Yii::$app->db_facturacion;
        $estado = 1;
        $sql = "SELECT ddit_tipo_beneficio, ddit_porcentaje, ddit_valor 
                FROM " . $con->dbname . ".detalle_descuento_item ddi
                WHERE ddi.ddit_id = :dite_id
                    and ddi.ddit_estado = :estado
                    and ddi.ddit_estado_logico = :estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":dite_id", $dite_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

}
