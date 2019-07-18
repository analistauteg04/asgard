<?php

namespace app\modules\financiero\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "solicitud_boton_pago".
 *
 * @property int $sbpa_id
 * @property int $pben_id
 * @property string $sbpa_fecha_solicitud
 * @property string $sbpa_estado
 * @property string $sbpa_fecha_creacion
 * @property string $sbpa_fecha_modificacion
 * @property string $sbpa_estado_logico
 *
 * @property DetalleSolicitudBotonPago[] $detalleSolicitudBotonPagos
 * @property OrdenPago[] $ordenPagos
 * @property PersonaBeneficiaria $pben
 */
class SolicitudBotonPago extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'solicitud_boton_pago';
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
            [['pben_id'], 'integer'],
            [['sbpa_fecha_solicitud', 'sbpa_fecha_creacion', 'sbpa_fecha_modificacion'], 'safe'],
            [['sbpa_estado', 'sbpa_estado_logico'], 'required'],
            [['sbpa_estado', 'sbpa_estado_logico'], 'string', 'max' => 1],
            [['pben_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonaBeneficiaria::className(), 'targetAttribute' => ['pben_id' => 'pben_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'sbpa_id' => 'Sbpa ID',
            'pben_id' => 'Pben ID',
            'sbpa_fecha_solicitud' => 'Sbpa Fecha Solicitud',
            'sbpa_estado' => 'Sbpa Estado',
            'sbpa_fecha_creacion' => 'Sbpa Fecha Creacion',
            'sbpa_fecha_modificacion' => 'Sbpa Fecha Modificacion',
            'sbpa_estado_logico' => 'Sbpa Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleSolicitudBotonPagos() {
        return $this->hasMany(DetalleSolicitudBotonPago::className(), ['sbpa_id' => 'sbpa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenPagos() {
        return $this->hasMany(OrdenPago::className(), ['sbpa_id' => 'sbpa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPben() {
        return $this->hasOne(PersonaBeneficiaria::className(), ['pben_id' => 'pben_id']);
    }

    public function insertSolicitudBotonPago($con, $id_pben) {
        $estado = 1;
        $fecha_solicitud = date(Yii::$app->params["dateTimeByDefault"]);
        $sql = "INSERT INTO " . $con->dbname . ".solicitud_boton_pago
            (pben_id, sbpa_fecha_solicitud, sbpa_estado, sbpa_estado_logico) VALUES
            (:id_pben,:fecha_solicitud,:sbpa_estado,:sbpa_estado)";
        $command = $con->createCommand($sql);
        $command->bindParam(":id_pben", $id_pben, \PDO::PARAM_INT);
        $command->bindParam(":fecha_solicitud", $fecha_solicitud, \PDO::PARAM_STR);
        $command->bindParam(":sbpa_estado", $estado, \PDO::PARAM_STR);
        $command->execute();
        return $con->getLastInsertID();
    }

    /**
     * Function consultarPagoExterno (Consulta pagos externos de boton de pago)
     * @author  Kleber Loayza <analistadesarrollo03@uteg.edu.ec>
     * @param   
     * @return  
     */
    public function consultarPagoExterno($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_facturacion;
        $con1 = \Yii::$app->db_financiero;
        $estado = 1;
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            // if ($arrFiltro['search'] != "" && $arrFiltro['search'] != "") {
            $str_search .= "and (pben.pben_nombre like :search OR ";
            $str_search .= "pben.pben_apellido like :search ) AND ";
            // }
            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "docu.doc_fecha_pago >= :fec_ini AND ";
                $str_search .= "docu.doc_fecha_pago <= :fec_fin AND ";
            }
        }
        $sql = "
                select distinct
                    sbpa.sbpa_id as id,
                    vres.reference as referencia,
                    concat(pben.pben_nombre,' ',pben.pben_apellido) as estudiante,
                    docu.doc_nombres_cliente as persona_factura,
                    ifnull(docu.doc_cedula,'') as cedula_factura,
                    docu.doc_fecha_pago as fecha_pago,
                    docu.doc_valor as total_pago,
                    docu.doc_pagado as estado,                   
                    docu.doc_id, ifnull(op.sbpa_id,0) as sbpa_op
                from
                    " . $con->dbname . ".solicitud_boton_pago as sbpa
                    join " . $con->dbname . ".persona_beneficiaria as pben on pben.pben_id = sbpa.pben_id
                    join " . $con->dbname . ".documento as docu on docu.sbpa_id = sbpa.sbpa_id
                    join " . $con1->dbname . ".vpos_response as vres on vres.ordenPago = docu.doc_id and vres.tipo_orden = 2
                    left join " . $con->dbname . ".orden_pago op on op.sbpa_id = sbpa.sbpa_id
                where 1=1
                    $str_search
            ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":status", $estado, \PDO::PARAM_STR);
        //VERIFICAR SI LOS PARAMETROS $doc_id y $opag_id SE VAN USAR SINO BORRAR
        /* $comando->bindParam(":doc_id", $doc_id, \PDO::PARAM_INT);
          $comando->bindParam(":opag_id", $opag_id, \PDO::PARAM_INT); */
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["search"] . "%";
            $fecha_ini = $arrFiltro["f_ini"] . " 00:00:00";
            $fecha_fin = $arrFiltro["f_fin"] . " 23:59:59";
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
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
                    'referencia',
                    'fecha_solicitud',
                    'estudiante',
                    'fecha_pago',
                    'total_pago',
                    'estado'
                ],
            ],
        ]);
        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    public function consultarHistoralTransacciones($per_id, $arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_facturacion;
        $con1 = \Yii::$app->db_financiero;
        $estado = 1;
        $sql = " 
             select
                opag.opag_id as id,
                vpre.reference as referencia,
                concat(per.per_pri_nombre,' ',per.per_pri_apellido)  as estudiante,
                opag.opag_fecha_pago_total as fecha_pago,
                opag.opag_valor_pagado as total_pago,
                opag.opag_estado_pago as estado
            from 
                db_facturacion.orden_pago as opag
                join db_captacion.solicitud_inscripcion as sins on sins.sins_id = opag.sins_id
                join db_captacion.interesado as inte on inte.int_id = sins.int_id
                join db_asgard.persona as per on per.per_id = inte.per_id
                join db_financiero.vpos_response as vpre on vpre.ordenPago = opag.opag_id and vpre.tipo_orden = 1
                where
                per.per_id = :per_id
            ";
        $sql .= " union ";
        $sql .= " 
             select
                opag.opag_id as id,
                vpre.reference as referencia,
                concat(per.per_pri_nombre,' ',per.per_pri_apellido)  as estudiante,
                opag.opag_fecha_pago_total as fecha_pago,
                opag.opag_valor_pagado as total_pago,
                opag.opag_estado_pago as estado
            from 
                db_facturacion.orden_pago as opag
                join db_captacion.solicitud_inscripcion as sins on sins.sins_id = opag.sins_id
                join db_captacion.interesado as inte on inte.int_id = sins.int_id
                join db_asgard.persona as per on per.per_id = inte.per_id
                join db_facturacion.documento as doc on doc.sbpa_id = opag.sbpa_id
                join db_financiero.vpos_response as vpre on vpre.ordenPago = doc.doc_id and vpre.tipo_orden = 2
                where
                per.per_id = :per_id
                ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":status", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":per_id", $per_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [
                    'referencia',
                    'estudiante',
                    'fecha_pago',
                    'total_pago',
                    'estado'
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
