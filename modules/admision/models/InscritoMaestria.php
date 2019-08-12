<?php

namespace app\modules\admision\models;

use Yii;

/**
 * This is the model class for table "inscrito_maestria".
 *
 * @property int $imae_id
 * @property int $cemp_id
 * @property int $gint_id
 * @property int $pai_id_
 * @property int $pro_id
 * @property int $can_id
 * @property string $imae_tipo_documento
 * @property string $imae_documento
 * @property string $imae_primer_nombre
 * @property string $imae_segundo_nombre
 * @property string $imae_primer_apellido
 * @property string $imae_segundo_apellido
 * @property string $imae_revisar_urgente
 * @property string $imae_cumple_requisito
 * @property string $imae_agente
 * @property string $imae_fecha_inscripcion
 * @property string $imae_fecha_pago
 * @property double $imae_pago_inscripcion
 * @property double $imae_valor_maestria
 * @property int $fpag_id
 * @property string $imae_estado_pago
 * @property string $imae_convenios
 * @property int $imae_usuario
 * @property int $imae_usuario_modif
 * @property string $imae_estado
 * @property string $imae_fecha_creacion
 * @property string $imae_fecha_modificacion
 * @property string $imae_estado_logico
 *
 * @property GrupoIntroductorio $gint
 */
class InscritoMaestria extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'inscrito_maestria';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_crm');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['cemp_id', 'gint_id', 'pai_id_', 'pro_id', 'can_id', 'fpag_id', 'imae_usuario', 'imae_usuario_modif'], 'integer'],
            [['gint_id', 'imae_primer_nombre', 'imae_primer_apellido', 'imae_usuario', 'imae_estado', 'imae_estado_logico'], 'required'],
            [['imae_pago_inscripcion', 'imae_valor_maestria'], 'number'],
            [['imae_fecha_creacion', 'imae_fecha_modificacion'], 'safe'],
            [['imae_tipo_documento', 'imae_cumple_requisito', 'imae_estado_pago'], 'string', 'max' => 2],
            [['imae_documento'], 'string', 'max' => 50],
            [['imae_primer_nombre', 'imae_segundo_nombre', 'imae_primer_apellido', 'imae_segundo_apellido', 'imae_revisar_urgente', 'imae_agente', 'imae_convenios'], 'string', 'max' => 100],
            [['imae_fecha_inscripcion', 'imae_fecha_pago'], 'string', 'max' => 20],
            [['imae_estado', 'imae_estado_logico'], 'string', 'max' => 1],
            [['gint_id'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoIntroductorio::className(), 'targetAttribute' => ['gint_id' => 'gint_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'imae_id' => 'Imae ID',
            'cemp_id' => 'Cemp ID',
            'gint_id' => 'Gint ID',
            'pai_id_' => 'Pai ID',
            'pro_id' => 'Pro ID',
            'can_id' => 'Can ID',
            'imae_tipo_documento' => 'Imae Tipo Documento',
            'imae_documento' => 'Imae Documento',
            'imae_primer_nombre' => 'Imae Primer Nombre',
            'imae_segundo_nombre' => 'Imae Segundo Nombre',
            'imae_primer_apellido' => 'Imae Primer Apellido',
            'imae_segundo_apellido' => 'Imae Segundo Apellido',
            'imae_revisar_urgente' => 'Imae Revisar Urgente',
            'imae_cumple_requisito' => 'Imae Cumple Requisito',
            'imae_agente' => 'Imae Agente',
            'imae_fecha_inscripcion' => 'Imae Fecha Inscripcion',
            'imae_fecha_pago' => 'Imae Fecha Pago',
            'imae_pago_inscripcion' => 'Imae Pago Inscripcion',
            'imae_valor_maestria' => 'Imae Valor Maestria',
            'fpag_id' => 'Fpag ID',
            'imae_estado_pago' => 'Imae Estado Pago',
            'imae_convenios' => 'Imae Convenios',
            'imae_usuario' => 'Imae Usuario',
            'imae_usuario_modif' => 'Imae Usuario Modif',
            'imae_estado' => 'Imae Estado',
            'imae_fecha_creacion' => 'Imae Fecha Creacion',
            'imae_fecha_modificacion' => 'Imae Fecha Modificacion',
            'imae_estado_logico' => 'Imae Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGint() {
        return $this->hasOne(GrupoIntroductorio::className(), ['gint_id' => 'gint_id']);
    }

    /**
     * Function insertarInscritoMaestria grabar la inserción inscritos.
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function insertarInscritoMaestria($cemp_id, $gint_id, $pai_id, $pro_id, $can_id, $imae_tipo_documento, $imae_documento, $imae_primer_nombre, $imae_segundo_nombre, $imae_primer_apellido, $imae_segundo_apellido, $imae_revisar_urgente, $imae_cumple_requisito, $imae_agente, $imae_fecha_inscripcion, $imae_fecha_pago, $imae_pago_inscripcion, $imae_valor_maestria, $fpag_id, $imae_estado_pago, $imae_convenios, $imae_usuario, $imae_fecha_creacion) {
        $con = \Yii::$app->db_crm;
        // 24
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }

        $param_sql = "imae_estado";
        $bdet_sql = "1";

        $param_sql .= ", imae_estado_logico";
        $bdet_sql .= ", 1";        

        if (isset($cemp_id)) {
            $param_sql .= ", cemp_id";
            $bdet_sql .= ", :cemp_id";
        }
        if (isset($gint_id)) {
            $param_sql .= ", gint_id";
            $bdet_sql .= ", :gint_id";
        }
        if (isset($pai_id)) {
            $param_sql .= ", pai_id";
            $bdet_sql .= ", :pai_id";
        }
        if (isset($pro_id)) {
            $param_sql .= ", pro_id";
            $bdet_sql .= ", :pro_id";
        }
        if (isset($can_id)) {
            $param_sql .= ", can_id";
            $bdet_sql .= ", :can_id";
        }
        if (isset($imae_tipo_documento)) {
            $param_sql .= ", imae_tipo_documento";
            $bdet_sql .= ", :imae_tipo_documento";
        }
        if (isset($imae_documento)) {
            $param_sql .= ", imae_documento";
            $bdet_sql .= ", :imae_documento";
        }
        if (isset($imae_primer_nombre)) {
            $param_sql .= ", imae_primer_nombre";
            $bdet_sql .= ", :imae_primer_nombre";
        }
        if (isset($imae_segundo_nombre)) {
            $param_sql .= ", imae_segundo_nombre";
            $bdet_sql .= ", :imae_segundo_nombre";
        }
        if (isset($imae_primer_apellido)) {
            $param_sql .= ", imae_primer_apellido";
            $bdet_sql .= ", :imae_primer_apellido";
        }
        if (isset($imae_segundo_apellido)) {
            $param_sql .= ", imae_segundo_apellido";
            $bdet_sql .= ", :imae_segundo_apellido";
        }
        if (isset($imae_revisar_urgente)) {
            $param_sql .= ", imae_revisar_urgente";
            $bdet_sql .= ", :imae_revisar_urgente";
        }
        if (isset($imae_cumple_requisito)) {
            $param_sql .= ", imae_cumple_requisito";
            $bdet_sql .= ", :imae_cumple_requisito";
        }
        if (isset($imae_agente)) {
            $param_sql .= ", imae_agente";
            $bdet_sql .= ", :imae_agente";
        }
        if (isset($imae_fecha_inscripcion)) {
            $param_sql .= ", imae_fecha_inscripcion";
            $bdet_sql .= ", :imae_fecha_inscripcion";
        }
        if (isset($imae_fecha_pago)) {
            $param_sql .= ", imae_fecha_pago";
            $bdet_sql .= ", :imae_fecha_pago";
        }
        if (isset($imae_pago_inscripcion)) {
            $param_sql .= ", imae_pago_inscripcion";
            $bdet_sql .= ", :imae_pago_inscripcion";
        }
        if (isset($imae_valor_maestria)) {
            $param_sql .= ", imae_valor_maestria";
            $bdet_sql .= ", :imae_valor_maestria";
        }
        if (isset($fpag_id)) {
            $param_sql .= ", fpag_id";
            $bdet_sql .= ", :fpag_id";
        }
        if (isset($imae_estado_pago)) {
            $param_sql .= ", imae_estado_pago";
            $bdet_sql .= ", :imae_estado_pago";
        }
        if (isset($imae_convenios)) {
            $param_sql .= ", imae_convenios";
            $bdet_sql .= ", :imae_convenios";
        }
        if (isset($imae_usuario)) {
            $param_sql .= ", imae_usuario";
            $bdet_sql .= ", :imae_usuario";
        }     
        if (isset($imae_fecha_creacion)) {
            $param_sql .= ", imae_fecha_creacion";
            $bdet_sql .= ", :imae_fecha_creacion";
        }
        
        try {
            $sql = "INSERT INTO " . $con->dbname . ".inscrito_maestria ($param_sql) VALUES($bdet_sql)";
            $comando = $con->createCommand($sql);
            if (isset($cemp_id)) {
                $comando->bindParam(':cemp_id', $cemp_id, \PDO::PARAM_INT);
            }
            if (isset($gint_id)) {
                $comando->bindParam(':gint_id', $gint_id, \PDO::PARAM_INT);
            }
            if (isset($pai_id)) {
                $comando->bindParam(':pai_id', $pai_id, \PDO::PARAM_INT);
            }
            if (isset($pro_id)) {
                $comando->bindParam(':pro_id', $pro_id, \PDO::PARAM_INT);
            }
            if (isset($can_id)) {
                $comando->bindParam(':can_id', $can_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($imae_tipo_documento)))) {
                $comando->bindParam(':imae_tipo_documento', $imae_tipo_documento, \PDO::PARAM_STR);
            }
            if (isset($imae_documento)) {
                $comando->bindParam(':imae_documento', $imae_documento, \PDO::PARAM_STR);
            }
            if (!empty((isset($imae_primer_nombre)))) {
                $comando->bindParam(':imae_primer_nombre', $imae_primer_nombre, \PDO::PARAM_STR);
            }
            if (isset($imae_segundo_nombre)) {
                $comando->bindParam(':imae_segundo_nombre', $imae_segundo_nombre, \PDO::PARAM_STR);
            }
            if (!empty((isset($imae_primer_apellido)))) {
                $comando->bindParam(':imae_primer_apellido', $imae_primer_apellido, \PDO::PARAM_STR);
            }
            if (!empty((isset($imae_segundo_apellido)))) {
                $comando->bindParam(':imae_segundo_apellido', $imae_segundo_apellido, \PDO::PARAM_STR);
            }            
            if (!empty((isset($imae_revisar_urgente)))) {
                $comando->bindParam(':imae_revisar_urgente', $imae_revisar_urgente, \PDO::PARAM_INT);
            }
            if (!empty((isset($imae_cumple_requisito)))) {
                $comando->bindParam(':imae_cumple_requisito', $imae_cumple_requisito, \PDO::PARAM_STR);
            }
            if (!empty((isset($imae_agente)))) {
                $comando->bindParam(':imae_agente', $imae_agente, \PDO::PARAM_STR);
            }
            if (!empty((isset($imae_fecha_inscripcion)))) {
                $comando->bindParam(':imae_fecha_inscripcion', $imae_fecha_inscripcion, \PDO::PARAM_INT);
            }
            if (!empty((isset($imae_fecha_pago)))) {
                $comando->bindParam(':imae_fecha_pago', $imae_fecha_pago, \PDO::PARAM_STR);
            }
            if (!empty((isset($imae_pago_inscripcion)))) {
                $comando->bindParam(':imae_pago_inscripcion', $imae_pago_inscripcion, \PDO::PARAM_STR);
            }
            if (!empty((isset($imae_valor_maestria)))) {
                $comando->bindParam(':imae_valor_maestria', $imae_valor_maestria, \PDO::PARAM_STR);
            }           
            if (!empty((isset($fpag_id)))) {
                $comando->bindParam(':fpag_id', $fpag_id, \PDO::PARAM_INT);
            }
            if (!empty((isset($imae_estado_pago)))) {
                $comando->bindParam(':imae_estado_pago', $imae_estado_pago, \PDO::PARAM_STR);
            }
            if (!empty((isset($imae_convenios)))) {
                $comando->bindParam(':imae_convenios', $imae_convenios, \PDO::PARAM_STR);
            }
            if (!empty((isset($imae_usuario)))) {
                $comando->bindParam(':imae_usuario', $imae_usuario, \PDO::PARAM_INT);
            }
             if (!empty((isset($imae_fecha_creacion)))) {
                $comando->bindParam(':imae_fecha_creacion', $imae_fecha_creacion, \PDO::PARAM_STR);
            }
            $result = $comando->execute();
            if ($trans !== null)
                $trans->commit();
            return $con->getLastInsertID($con->dbname . '.inscrito_maestria');
        } catch (Exception $ex) {
            if ($trans !== null)
                $trans->rollback();
            return FALSE;
        }
    }

    function getAllInscritosGrid($search = NULL, $date_ini = NULL, $date_end= NULL, $dataProvider = false){
        //$iduser    = Yii::$app->session->get('PB_iduser', FALSE);
        //$idempresa = Yii::$app->session->get('PB_idempresa', FALSE);
        $search_cond = "%".$search."%";
        $str_search = "";
        if(isset($search) && $search != ""){
            $str_search .= "(im.imae_primer_nombre like :search OR ";
            $str_search .= "im.imae_segundo_nombre like :search OR ";
            $str_search .= "im.imae_primer_apellido like :search OR ";
            $str_search .= "im.imae_segundo_apellido like :search OR ";
            $str_search .= "pr.pro_nombre like :search OR ";
            $str_search .= "pa.can_nombre like :search OR ";
            $str_search .= "im.imae_agente like :search) AND ";
        }
        if(isset($date_ini) && $date_ini != ""){
            $str_search .= "im.imae_fecha_inscripcion >= $date_ini AND ";
        }
        if(isset($date_end) && $date_end != ""){
            $str_search .= "im.imae_fecha_inscripcion <= $date_end AND ";
        }
        $con = \Yii::$app->db_crm;
        $trans = $con->getTransaction();
        if ($trans !== null) {
            $trans = null;
        } else {
            $trans = $con->beginTransaction();
        }
        $sql = "SELECT 
                    imae_id,
                    im.cemp_id,
                    im.gint_id,
                    gi.gint_nombre AS grupoIntroductorio,
                    ce.cemp_id AS convenio,
                    im.imae_tipo_documento AS dni,
                    im.imae_primer_nombre + ' ' + im.imae_segundo_nombre + ' ' + im.imae_primer_apellido + ' ' im.imae_segundo_apellido as nombres,
                    pa.pai_nombre AS pais,
                    pr.pro_nombre AS provincia,
                    pa.can_nombre AS canton,
                    
                    im.imae_fecha_inscripcion AS fecha_inscripcion,
                    im.imae_fecha_pago AS fecha_pago,
                    '".Yii::$app->params["currency"]."' + im.imae_pago_inscripcion AS pago_inscripcion,
                    '".Yii::$app->params["currency"]."' + im.imae_valor_maestria AS valor_maestria,
                    fp.fpag_nombre AS forma_pago,
                    im.imae_agente AS agente,
                    im.imae_estado_pago AS estado_pago
                FROM 
                    ".$con->dbname . ".inscrito_maestria AS im 
                    INNER JOIN ".Yii::$app->db->dbname.".pais AS pa ON pa.pai_id = im.pai_id
                    INNER JOIN ".Yii::$app->db->dbname.".provincia AS pr ON pr.pro_id = im.pro_id
                    INNER JOIN ".Yii::$app->db->dbname.".canton AS ca ON ca.can_id = im.can_id
                    INNER JOIN ".Yii::$app->db_facturacion->dbname.".forma_pago AS fp ON fp.fpag_id = im.fpag_id
                    INNER JOIN ".$con->dbname.".grupo_introductorio AS gi ON gi.gint_id = im.gint_id
                    INNER LEFT JOIN ".Yii::$app->db_captacion->dbname.".convenio_empresa AS ce ON ce.cemp_id = im.cemp_id
                WHERE 
                    $str_search
                    im.imae_estado=1 AND
                    im.imae_estado_logico=1 
                ORDER BY im.imae_fecha_inscripcion DESC;";
        $comando = Yii::$app->db->createCommand($sql);
        if(isset($search)){
            $comando->bindParam(":search",$search_cond, \PDO::PARAM_STR);
        }
        $res = $comando->queryAll();
        if($dataProvider){
            $dataProvider = new ArrayDataProvider([
                'key' => 'imae_id',
                'allModels' => $res,
                'pagination' => [
                    'pageSize' => Yii::$app->params["pageSize"],
                ],
                'sort' => [
                    'attributes' => ['pais', 'provincia', 'canton', 'fecha_inscripcion', 'agente', 'estado_pago', 'forma_pago'],
                ],
            ]);
            return $dataProvider;
        }
        return $res;
    }

}
