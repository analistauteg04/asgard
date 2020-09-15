<?php

namespace app\modules\academico\models;

use Yii;
use \yii\data\ActiveDataProvider;
use \yii\data\ArrayDataProvider;
use yii\base\Exception;
use yii\helpers\VarDumper;
use app\models\Persona;

/**
 * This is the model class for table "planificacion_estudiante".
 *
 * @property int $pes_id
 * @property int $pla_id
 * @property int $per_id
 * @property string $pes_jornada
 * @property string $pes_cod_carrera
 * @property string $pes_carrera
 * @property string $pes_dni
 * @property string $pes_nombres
 * @property string $pes_egresado
 * @property string $pes_tutoria_nombre
 * @property string $pes_tutoria_cod
 * @property string $pes_mat_b1_h1_nombre
 * @property string $pes_mat_b1_h1_cod
 * @property string $pes_mat_b1_h2_nombre
 * @property string $pes_mat_b1_h2_cod
 * @property string $pes_mat_b1_h3_nombre
 * @property string $pes_mat_b1_h3_cod
 * @property string $pes_mat_b1_h4_nombre
 * @property string $pes_mat_b1_h4_cod
 * @property string $pes_mat_b1_h5_nombre
 * @property string $pes_mat_b1_h5_cod
 * @property string $pes_mat_b1_h6_nombre
 * @property string $pes_mat_b1_h6_cod
 * @property string $pes_mat_b2_h1_nombre
 * @property string $pes_mat_b2_h1_cod
 * @property string $pes_mat_b2_h2_nombre
 * @property string $pes_mat_b2_h2_cod
 * @property string $pes_mat_b2_h3_nombre
 * @property string $pes_mat_b2_h3_cod
 * @property string $pes_mat_b2_h4_nombre
 * @property string $pes_mat_b2_h4_cod
 * @property string $pes_mat_b2_h5_nombre
 * @property string $pes_mat_b2_h5_cod
 * @property string $pes_mat_b2_h6_nombre
 * @property string $pes_mat_b2_h6_cod
 * @property string $pes_estado
 * @property string $pes_fecha_creacion
 * @property int $pes_usuario_modifica
 * @property string $pes_fecha_modificacion
 * @property string $pes_estado_logico
 *
 * @property Planificacion $pla
 * @property RegistroOnline[] $registroOnlines
 */
class PlanificacionEstudiante extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'planificacion_estudiante';
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
            [['pla_id', 'per_id', 'pes_estado', 'pes_estado_logico'], 'required'],
            [['pla_id', 'per_id', 'pes_usuario_modifica'], 'integer'],
            [['pes_fecha_creacion', 'pes_fecha_modificacion'], 'safe'],
            [['pes_jornada'], 'string', 'max' => 3],
            [['pes_cod_carrera', 'pes_tutoria_cod', 'pes_mat_b1_h1_cod', 'pes_mat_b1_h2_cod', 'pes_mat_b1_h3_cod', 'pes_mat_b1_h4_cod', 'pes_mat_b1_h5_cod', 'pes_mat_b1_h6_cod', 'pes_mat_b2_h1_cod', 'pes_mat_b2_h2_cod', 'pes_mat_b2_h3_cod', 'pes_mat_b2_h4_cod', 'pes_mat_b2_h5_cod', 'pes_mat_b2_h6_cod'], 'string', 'max' => 20],
            [['pes_carrera', 'pes_tutoria_nombre', 'pes_mat_b1_h1_nombre', 'pes_mat_b1_h2_nombre', 'pes_mat_b1_h3_nombre', 'pes_mat_b1_h4_nombre', 'pes_mat_b1_h5_nombre', 'pes_mat_b1_h6_nombre', 'pes_mat_b2_h1_nombre', 'pes_mat_b2_h2_nombre', 'pes_mat_b2_h3_nombre', 'pes_mat_b2_h4_nombre', 'pes_mat_b2_h5_nombre', 'pes_mat_b2_h6_nombre'], 'string', 'max' => 100],
            [['pes_dni'], 'string', 'max' => 15],
            [['pes_nombres'], 'string', 'max' => 200],
            [['pes_egresado', 'pes_estado', 'pes_estado_logico'], 'string', 'max' => 1],
            [['pla_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planificacion::className(), 'targetAttribute' => ['pla_id' => 'pla_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'pes_id' => 'Pes ID',
            'pla_id' => 'Pla ID',
            'per_id' => 'Per ID',
            'pes_jornada' => 'Pes Jornada',
            'pes_cod_carrera' => 'Pes Cod Carrera',
            'pes_carrera' => 'Pes Carrera',
            'pes_dni' => 'Pes Dni',
            'pes_nombres' => 'Pes Nombres',
            'pes_egresado' => 'Pes Egresado',
            'pes_tutoria_nombre' => 'Pes Tutoria Nombre',
            'pes_tutoria_cod' => 'Pes Tutoria Cod',
            'pes_mat_b1_h1_nombre' => 'Pes Mat B1 H1 Nombre',
            'pes_mat_b1_h1_cod' => 'Pes Mat B1 H1 Cod',
            'pes_mat_b1_h2_nombre' => 'Pes Mat B1 H2 Nombre',
            'pes_mat_b1_h2_cod' => 'Pes Mat B1 H2 Cod',
            'pes_mat_b1_h3_nombre' => 'Pes Mat B1 H3 Nombre',
            'pes_mat_b1_h3_cod' => 'Pes Mat B1 H3 Cod',
            'pes_mat_b1_h4_nombre' => 'Pes Mat B1 H4 Nombre',
            'pes_mat_b1_h4_cod' => 'Pes Mat B1 H4 Cod',
            'pes_mat_b1_h5_nombre' => 'Pes Mat B1 H5 Nombre',
            'pes_mat_b1_h5_cod' => 'Pes Mat B1 H5 Cod',
            'pes_mat_b1_h6_nombre' => 'Pes Mat B1 H6 Nombre',
            'pes_mat_b1_h6_cod' => 'Pes Mat B1 H6 Cod',
            'pes_mat_b2_h1_nombre' => 'Pes Mat B2 H1 Nombre',
            'pes_mat_b2_h1_cod' => 'Pes Mat B2 H1 Cod',
            'pes_mat_b2_h2_nombre' => 'Pes Mat B2 H2 Nombre',
            'pes_mat_b2_h2_cod' => 'Pes Mat B2 H2 Cod',
            'pes_mat_b2_h3_nombre' => 'Pes Mat B2 H3 Nombre',
            'pes_mat_b2_h3_cod' => 'Pes Mat B2 H3 Cod',
            'pes_mat_b2_h4_nombre' => 'Pes Mat B2 H4 Nombre',
            'pes_mat_b2_h4_cod' => 'Pes Mat B2 H4 Cod',
            'pes_mat_b2_h5_nombre' => 'Pes Mat B2 H5 Nombre',
            'pes_mat_b2_h5_cod' => 'Pes Mat B2 H5 Cod',
            'pes_mat_b2_h6_nombre' => 'Pes Mat B2 H6 Nombre',
            'pes_mat_b2_h6_cod' => 'Pes Mat B2 H6 Cod',
            'pes_estado' => 'Pes Estado',
            'pes_fecha_creacion' => 'Pes Fecha Creacion',
            'pes_usuario_modifica' => 'Pes Usuario Modifica',
            'pes_fecha_modificacion' => 'Pes Fecha Modificacion',
            'pes_estado_logico' => 'Pes Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPla() {
        return $this->hasOne(Planificacion::className(), ['pla_id' => 'pla_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistroOnlines() {
        return $this->hasMany(RegistroOnline::className(), ['pes_id' => 'pes_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllPlanificacionesGrid($search = NULL, $dataProvider = false) {
        $iduser = Yii::$app->session->get('PB_iduser', FALSE);
        $search_cond = "%" . $search . "%";
        $str_search = "";
        if (isset($search)) {
            $str_search = "(do.doc_uni_departamento like :search OR ";
            $str_search .= "do.doc_proceso like :search) AND ";
        }
        $sql = "SELECT 
                    do.doc_id as id,
                    do.doc_uni_departamento as Departamento,
                    do.doc_proceso as Proceso,                    
                    do.doc_tipo_informacion as TipoInfo,
                    do.doc_observaciones as Observaciones,
                    do.doc_estado_documento as Estado, 
                FROM 
                    documento as do
                    inner join clase as cla on cla.cla_id = do.cla_id
                    inner join serie as ser on ser.ser_id = do.ser_id
                    inner join subserie as sub on sub.sub_id = do.sub_id
                WHERE 
                    $str_search
                    do.doc_estado_logico=1 and
                    cla.cla_estado_logico=1 and
                    ser.ser_estado_logico=1 and
                    sub.sub_estado_logico=1
                    ORDER BY do.doc_id;";
        $comando = Yii::$app->db_documental->createCommand($sql);
        if (isset($search)) {
            $comando->bindParam(":search", $search_cond, \PDO::PARAM_STR);
        }
        $res = $comando->queryAll();
        foreach ($res as $key => $valor) {
            foreach ($valor as $key2 => $valor2) {
                if (strcasecmp($key2, "TipoInfo") == 0) {
                    $res[$key][$key2] = $this->getValueTipoInformacionByKey($valor2);
                }

                if (strcasecmp($key2, "Estado") == 0) {
                    $res[$key][$key2] = $this->getValueEstadoDocumentoByKey($valor2);
                }
            }
        }

        if ($dataProvider) {
            $dataProvider = new ArrayDataProvider([
                'key' => 'doc_id',
                'allModels' => $res,
                'pagination' => [
                    'pageSize' => Yii::$app->params["pageSize"],
                ],
                'sort' => [
                    'attributes' => ['Departamento', 'Proceso', 'Codigo', 'TipoInfo', 'Observaciones', 'Estado'],
                ],
            ]);
            return $dataProvider;
        }
        return $res;
    }

    public function processFile($fname, $pla_id) {
        $file = Yii::$app->basePath . Yii::$app->params['documentFolder'] . "planificacion/" . $fname;
        $fila = 0;
        $chk_ext = explode(".", $file);
        $con = \Yii::$app->db_academico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        /* print("pasa cargar"); */
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }
        /* print_r($chk_ext); */
        if (strtolower(end($chk_ext)) == "xls" || strtolower(end($chk_ext)) == "xlsx") {
            //Creacion de PHPExcel object
            try {
                $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
                $dataArr = array();
                $validacion = false;
                $row_global = 0;

                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $worksheetTitle = $worksheet->getTitle();
                    $highestRow = $worksheet->getHighestRow(); // e.g. 10 
                    $highestColumn = $worksheet->getHighestDataColumn(); // e.g 'F'                    
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                    /* print('######');
                      print($worksheetTitle);
                      print(";");
                      print($highestRow);
                      print(";");
                      print($highestColumn);
                      print(";");
                      print($highestColumnIndex);
                      print('######'); */
                    //lectura del Archivo XLS filas y Columnas
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        $row_global = $row_global + 1;
                        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $dataArr[$row_global][$col] = $cell->getValue();
                        }
                    }
                    /* unset($dataArr[1], $dataArr[2]);                     */
                }

                /*  return $dataArr; */
                /* print($row_global . "\n");
                  print(sizeof($dataArr) . "\n");
                  print_r($dataArr); */

                $fila = 0;
                foreach ($dataArr as $val) {
                    /* print("#");
                      print(gettype($val[1]));
                      print("#"); */
                    if (!is_null($val[4]) || $val[4]) {
                        $val[4] = strval($val[4]);
                        $per_id_estudiante = Persona::ObtenerPersonabyCedulaPasaporteRuc($val[4], $val[4], $val[4]);
                        $fila++;
                        /* print(strlen($val[5]));
                          print($ser_cod_str); */
                        /* print(gettype($ser_cod_str)); */
                        /* print("AntesGuardar"); */

                        $save_documento = $this->saveDocumentoDB($val, $pla_id, $per_id_estudiante);
                        if (!$save_documento) {
                            /* print("IFErrorSave"); */
                            $arroout["status"] = FALSE;
                            $arroout["error"] = null;
                            $arroout["message"] = "Error al guardar el registro de la Fila => N°$fila Cedula => $val[4]. No se encontró al estudiante.";
                            $arroout["data"] = null;
                            $arroout["validate"] = $val;
                            \app\models\Utilities::putMessageLogFile('error fila ' . $fila);
                            return $arroout;
                        }
                    }
                }
                /* print("AfterFOR"); */
                if ($trans !== null)
                    $trans->commit();
                // print_r($dataArr);
                $arroout["status"] = TRUE;
                $arroout["error"] = null;
                $arroout["message"] = null;
                $arroout["data"] = null;
                $arroout["validate"] = $fila;
                return $arroout;
            } catch (\Exception $ex) {
                if ($trans !== null)
                    $trans->rollback();
                $arroout["status"] = FALSE;
                $arroout["error"] = null;
                $arroout["message"] = null;
                $arroout["data"] = null;
                return $arroout;
            }
        }
    }

    public function saveDocumentoDB($val, $pla_id, $per_id_estudiante) {
        // try {
        /* print_r($val); */
        /* print("$$");
          print($val[10]);
          print(gettype($val[10]));
          print("$$"); */
        /* print($pla_id);
          print($per_id); */
        $model_planificacion_estudiante = new PlanificacionEstudiante();
        $model_planificacion_estudiante->pla_id = $pla_id;


        $model_planificacion_estudiante->per_id = $per_id_estudiante;
        $model_planificacion_estudiante->pes_jornada = $val[1];
        /*  $model_planificacion_estudiante->pes_cod_carrera = $val[2]; */
        $model_planificacion_estudiante->pes_carrera = $val[3];
        $model_planificacion_estudiante->pes_dni = strval($val[4]);
        $model_planificacion_estudiante->pes_nombres = $val[5];
        /* $es_egresado = "";
          if($val[6] == "egresado"){
          $es_egresado = $val[6];
          }
          $model_planificacion_estudiante->pes_egresado = $es_egresado;
          if(!is_null($val[7]) || $val[7] != ""){
          $array_tutoria = explode(" {", $val[7]);
          $nombre_tutoria = $array_tutoria[0];
          $codigo_tutoria = substr($array_tutoria[1], 0 , -1);
          $model_planificacion_estudiante->pes_tutoria_nombre = $nombre_tutoria;
          $model_planificacion_estudiante->pes_tutoria_cod = $codigo_tutoria;
          } else {
          $model_planificacion_estudiante->pes_tutoria_nombre = null;
          $model_planificacion_estudiante->pes_tutoria_cod = null;
          } */


        /*  $array_mat_b1h1_nom = explode(" {", $val[8]);
          $nombre__mat_b1h1 = $array_mat_b1h1_nom[0];
          $codigo_mat_b1h1 = substr($array_mat_b1h1_nom[1], 0 , -1); */
        $model_planificacion_estudiante->pes_mat_b1_h1_nombre = $val[6];
        /*  $model_planificacion_estudiante->pes_mat_b1_h1_cod = $codigo_mat_b1h1; */

        /*  $array_mat_b1h2_nom = explode(" {", $val[9]);
          $nombre__mat_b1h2 = $array_mat_b1h2_nom[0];
          $codigo_mat_b1h2 = substr($array_mat_b1h2_nom[1], 0 , -1); */
        $model_planificacion_estudiante->pes_mat_b1_h2_nombre = $val[7];
        /*   $model_planificacion_estudiante->pes_mat_b1_h2_cod = $codigo_mat_b1h2; */

        /*  $array_mat_b1h3_nom = explode(" {", $val[10]);
          $nombre__mat_b1h3 = $array_mat_b1h3_nom[0];
          $codigo_mat_b1h3 = substr($array_mat_b1h3_nom[1], 0 , -1); */
        $model_planificacion_estudiante->pes_mat_b1_h3_nombre = $val[8];
        /*   $model_planificacion_estudiante->pes_mat_b1_h3_cod = $codigo_mat_b1h3; */

        /*  $array_mat_b1h4_nom = explode(" {", $val[11]);
          $nombre__mat_b1h4 = $array_mat_b1h4_nom[0];
          $codigo_mat_b1h4 = substr($array_mat_b1h4_nom[1], 0 , -1); */
        $model_planificacion_estudiante->pes_mat_b1_h4_nombre = $val[9];
        /*  $model_planificacion_estudiante->pes_mat_b1_h4_cod = $codigo_mat_b1h4; */

        /*  $array_mat_b1h5_nom = explode(" {", $val[12]);
          $nombre__mat_b1h5 = $array_mat_b1h5_nom[0];
          $codigo_mat_b1h5 = substr($array_mat_b1h5_nom[1], 0 , -1); */
        $model_planificacion_estudiante->pes_mat_b1_h5_nombre = $val[10];
        /*  $model_planificacion_estudiante->pes_mat_b1_h5_cod = $codigo_mat_b1h5; */
        
        $model_planificacion_estudiante->pes_mat_b1_h6_nombre = $val[11];
        
        /*  $array_mat_b2h1_nom = explode(" {", $val[13]);
          $nombre__mat_b2h1 = $array_mat_b2h1_nom[0];
          $codigo_mat_b2h1 = substr($array_mat_b2h1_nom[1], 0 , -1); */
        $model_planificacion_estudiante->pes_mat_b2_h1_nombre = $val[12];
        /* $model_planificacion_estudiante->pes_mat_b2_h1_cod = $codigo_mat_b2h1; */

        /*  $array_mat_b2h2_nom = explode(" {", $val[14]);
          $nombre__mat_b2h2 = $array_mat_b2h2_nom[0];
          $codigo_mat_b2h2 = substr($array_mat_b2h2_nom[1], 0 , -1); */
        $model_planificacion_estudiante->pes_mat_b2_h2_nombre = $val[13];
        /*   $model_planificacion_estudiante->pes_mat_b2_h2_cod = $codigo_mat_b2h2; */

        /*   $array_mat_b2h3_nom = explode(" {", $val[15]);
          $nombre__mat_b2h3 = $array_mat_b2h3_nom[0];
          $codigo_mat_b2h3 = substr($array_mat_b2h3_nom[1], 0 , -1); */
        $model_planificacion_estudiante->pes_mat_b2_h3_nombre = $val[14];
        /*  $model_planificacion_estudiante->pes_mat_b2_h3_cod = $codigo_mat_b2h3; */

        /*   $array_mat_b2h4_nom = explode(" {", $val[16]);
          $nombre__mat_b2h4 = $array_mat_b2h4_nom[0];
          $codigo_mat_b2h4 = substr($array_mat_b2h4_nom[1], 0 , -1); */
        $model_planificacion_estudiante->pes_mat_b2_h4_nombre = $val[15];
        /*  $model_planificacion_estudiante->pes_mat_b2_h4_cod = $codigo_mat_b2h4;
         */
        /*  $array_mat_b2h5_nom = explode(" {", $val[17]);
          $nombre__mat_b2h5 = $array_mat_b2h5_nom[0];
          $codigo_mat_b2h5 = substr($array_mat_b2h5_nom[1], 0 , -1); */
        $model_planificacion_estudiante->pes_mat_b2_h5_nombre = $val[16];
        /*  $model_planificacion_estudiante->pes_mat_b2_h5_cod = $codigo_mat_b2h5; */
        
        $model_planificacion_estudiante->pes_mat_b2_h6_nombre = $val[17];
        
        $model_planificacion_estudiante->pes_estado = "1";
        $model_planificacion_estudiante->pes_estado_logico = "1";xº
        /* if($val[4] == "0925029605") {
          var_dump($model_planificacion_estudiante);
          }
          print("AntesReturn"); */
        /* print($model_planificacion_estudiante); */

        return $model_planificacion_estudiante->save();
    }

    public static function getCarreras() {
        $con_academico = \Yii::$app->db_academico;
        $sql = "SELECT @row_number:=@row_number+1 as pes_id, pes_carrera " .
                "FROM " . Yii::$app->db_academico->dbname . ".planificacion_estudiante, (SELECT @row_number:=0) AS t " .
                "WHERE pes_estado=1 AND pes_estado_logico=1 " .
                "GROUP BY pes_carrera";

        $comando = $con_academico->createCommand($sql);
        $resultData = $comando->queryAll();

        return $resultData;
    }

}
