<?php

namespace app\modules\academico\models;

use Yii;
use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;
/* use app\models\Persona; */
/* use app\modules\academico\models\PlanificacionEstudiante; */

/**
 * This is the model class for table "registro_online".
 *
 * @property integer $ron_id
 * @property integer $per_id
 * @property integer $pes_id
 * @property integer $pes_num_orden
 * @property string $ron_fecha_registro
 * @property string $ron_anio
 * @property string $ron_semestre
 * @property string $ron_modalidad
 * @property string $ron_carrera
 * @property string $ron_categoria_est
 * @property string $ron_valor_arancel
 * @property string $ron_estado_registro
 * @property string $ron_estado
 * @property string $ron_fecha_creacion
 * @property string $ron_usuario_modifica
 * @property string $ron_fecha_modifcacion
 * @property string $ron_estado_logico
 */

class RegistroOnline extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'registro_online';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db_academico');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['per_id','pes_id','pes_num_orden','ron_estado_registro','ron_estado','ron_estado_logico'],'required'],
            [['ron_fecha_registro','ron_fecha_creacion','ron_fecha_modificacion'], 'safe'],
            [['ron_estado_registro','ron_estado_logico','ron_estado'], 'string', 'max' => 1],
            /* [['per_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['per_id' => 'per_id']], */
            /* [['pes_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanificacionEstudiante::className(), 'targetAttribute' => ['pes_id' => 'pes_id']], */
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'ron_id' => 'Pro ID',
            'per_id' => 'Per ID',
            'pes_id' => 'Pes ID',
            'pes_num_orden' => 'Pes Num Orden',
            'ron_fecha_registro' => 'Ron Fecha Registro',
            'ron_anio' => 'Ron Anio',
            'ron_semestre' => 'Ron Semestre',
            'ron_modalidad' => 'Ron Modalidad',
            'ron_carrera' => 'Ron Carrera',
            'ron_categoria_est' => 'Ron Categoria Estudiante',
            'ron_valor_arancel' => 'Ron Valor Arancel',
            'ron_estado_registro' => 'Ron Estado Registro',
            'ron_estado' => 'Ron Estado',
            'ron_fecha_creacion' => 'Ron Fecha Creacion',
            'ron_usuario_modifica' => 'Ron Usuario Modifica',
            'ron_fecha_modifcacion' => 'Ron Fecha Modificacion',
            'ron_estado_logico' => 'Ron Estado Logico',
        ];
    }
}
