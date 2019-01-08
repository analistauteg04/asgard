<?php

namespace app\modules\marketing\models;

use yii\data\ArrayDataProvider;
use DateTime;
use Yii;

/**
 * This is the model class for table "solicitudins_documento".
 *
 * @property int $sdoc_id
 * @property int $sins_id
 * @property int $int_id
 * @property int $dadj_id
 * @property string $sdoc_archivo
 * @property string $sdoc_observacion
 * @property int $sdoc_usuario_ingreso
 * @property int $sdoc_usuario_modifica
 * @property string $sdoc_estado
 * @property string $sdoc_fecha_creacion
 * @property string $sdoc_fecha_modificacion
 * @property string $sdoc_estado_logico
 *
 * @property SolicitudInscripcion $sins
 * @property Interesado $int
 * @property DocumentoAdjuntar $dadj
 */
class Email extends \app\modules\marketing\components\CActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lista';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_mailing');
    }

    /**
     * {@inheritdoc}
     */
   
}
