<?php

namespace app\modules\marcacionhistorico\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * This is the model class for table "registro_marcacion_historial".
 *
 * @property int $rmhi_id
 * @property int $haph_id
 * @property string $rmhi_fecha_hora_entrada
 * @property string $rmhi_fecha_hora_salida
 * @property string $rmhi_estado
 * @property string $rmhi_fecha_creacion
 * @property string $rmhi_fecha_modificacion
 * @property string $rmhi_estado_logico
 *
 * @property HorarioAsignaturaPeriodoHistorial $haph
 */
class RegistroMarcacionHistorial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registro_marcacion_historial';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_marcacion_historico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['haph_id', 'rmhi_estado', 'rmhi_estado_logico'], 'required'],
            [['haph_id'], 'integer'],
            [['rmhi_fecha_hora_entrada', 'rmhi_fecha_hora_salida', 'rmhi_fecha_creacion', 'rmhi_fecha_modificacion'], 'safe'],
            [['rmhi_estado', 'rmhi_estado_logico'], 'string', 'max' => 1],
            [['haph_id'], 'exist', 'skipOnError' => true, 'targetClass' => HorarioAsignaturaPeriodoHistorial::className(), 'targetAttribute' => ['haph_id' => 'haph_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rmhi_id' => 'Rmhi ID',
            'haph_id' => 'Haph ID',
            'rmhi_fecha_hora_entrada' => 'Rmhi Fecha Hora Entrada',
            'rmhi_fecha_hora_salida' => 'Rmhi Fecha Hora Salida',
            'rmhi_estado' => 'Rmhi Estado',
            'rmhi_fecha_creacion' => 'Rmhi Fecha Creacion',
            'rmhi_fecha_modificacion' => 'Rmhi Fecha Modificacion',
            'rmhi_estado_logico' => 'Rmhi Estado Logico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHaph()
    {
        return $this->hasOne(HorarioAsignaturaPeriodoHistorial::className(), ['haph_id' => 'haph_id']);
    }
    /**
     * Function consultarMarcacionHistorica
     * @author  Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>    
     * @property  
     * @return  
     */
    public function consultarMarcacionHistorica($arrFiltro = array(), $onlyData = false) {
        $con = \Yii::$app->db_academico;
        $con1 = \Yii::$app->db_asgard;
        $con2 = \Yii::$app->db_marcacion_historico;
        $estado = 1;
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $str_search .= "(per.per_pri_nombre like :profesor OR ";
            $str_search .= "per.per_seg_nombre like :profesor OR ";
            $str_search .= "per.per_pri_apellido like :profesor OR ";
            $str_search .= "per.per_seg_nombre like :profesor )  AND ";
            $str_search .= "asig.asi_nombre like :materia  AND ";

            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $str_search .= "rmh.rmhi_fecha_creacion >= :fec_ini AND ";
                $str_search .= "rmh.rmhi_fecha_creacion <= :fec_fin AND ";
            }
            /*if ($arrFiltro['periodo'] != "" && $arrFiltro['periodo'] > 0) {
                $str_search .= " hap.paca_id = :periodo AND ";
            }*/
        }
        if ($onlyData == false) {
             $periodoacademico = ', rmh.haph_id as periodo ';           
        }
        $sql = "
               SELECT rmh.rmhi_id,
                    -- rmh.haph_id,
                    CONCAT(ifnull(per.per_pri_nombre,' '), ' ', ifnull(per.per_pri_apellido,' ')) as nombres,
                    asig.asi_nombre as materia,  
                    DATE_FORMAT(rmh.rmhi_fecha_hora_entrada, '%Y-%m-%d') as fecha,
                        DATE_FORMAT(rmh.rmhi_fecha_hora_entrada, '%H:%i:%s') as hora_inicio,
                    DATE_FORMAT(rmh.rmhi_fecha_hora_salida, '%H:%i:%s') as hora_salida
                    $periodoacademico                                  
                    FROM " . $con2->dbname . ".registro_marcacion_historial rmh
                    INNER JOIN " . $con2->dbname . ".horario_asignatura_periodo_historial hap on hap.haph_id = rmh.haph_id
                    INNER JOIN " . $con->dbname . ".profesor profe on profe.pro_id = hap.pro_id
                    INNER JOIN " . $con1->dbname . ".persona per on per.per_id = profe.per_id 
                    INNER JOIN " . $con->dbname . ".asignatura asig on asig.asi_id = hap.asi_id                  
                    WHERE $str_search                    
                    rmh.rmhi_estado = :estado AND
                    rmh.rmhi_estado_logico = :estado AND
                    hap.haph_estado = :estado AND
                    hap.haph_estado_logico = :estado AND
                    profe.pro_estado = :estado AND
                    profe.pro_estado_logico = :estado AND
                    per.per_estado = :estado AND
                    per.per_estado_logico = :estado AND
                    asig.asi_estado = :estado AND
                    asig.asi_estado_logico = :estado
                    GROUP BY nombres,materia,fecha, rmh.rmhi_id
                    ORDER BY fecha DESC
               ";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $search_cond = "%" . $arrFiltro["profesor"] . "%";
            $comando->bindParam(":profesor", $search_cond, \PDO::PARAM_STR);
            $fecha_ini = $arrFiltro["f_ini"] . " 00:00:00";
            $fecha_fin = $arrFiltro["f_fin"] . " 23:59:59";
            $materia = "%" . $arrFiltro["materia"] . "%";
            $comando->bindParam(":materia", $materia, \PDO::PARAM_STR);

            if ($arrFiltro['f_ini'] != "" && $arrFiltro['f_fin'] != "") {
                $comando->bindParam(":fec_ini", $fecha_ini, \PDO::PARAM_STR);
                $comando->bindParam(":fec_fin", $fecha_fin, \PDO::PARAM_STR);
            }
            /*if ($arrFiltro['periodo'] != "" && $arrFiltro['periodo'] > 0) {
                $periodo = $arrFiltro["periodo"];
                $comando->bindParam(":periodo", $periodo, \PDO::PARAM_INT);
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
    
    
    /**
     * Function carga archivo csv a base de datos
     * @author Giovanni Vergara <analistadesarrollo02@uteg.edu.ec>;
     * @param
     * @return
     */
    public function CargarArchivo($fname, $ruta) {
        //if ($tipoProceso == "LEADS") {
            //$path = Yii::$app->basePath . Yii::$app->params['documentFolder'] . "leads/" . $fname;
            $path = $ruta.$fname;
            //return $mod_pergestion->insertarDtosPersonaGestion($emp_id, $tipoProceso);
            $carga_archivo = $this->uploadFile($fname, $path);
            return $carga_archivo;
            if ($carga_archivo['status']) {                
                return $mod_pergestion->insertarDtosPersonaGestion($emp_id, $tipoProceso);
            } else {
                return $carga_archivo;
            }
        //} else {
            //PROCESO PARA SUBIR EN LOTES LEADS COLOMBIA
            //return $mod_pergestion->insertarDtosPersonaGestionLotes($emp_id, $tipoProceso);
        //}
    }
    
    public function uploadFile($fname, $file) {
        $filaError = 0;
        $file=Yii::$app->basePath .$file.$fname;
        $chk_ext = explode(".", $fname);
        $con = \Yii::$app->db_marcacion_historico;
        $trans = $con->getTransaction(); // se obtiene la transacción actual
        if ($trans !== null) {
            $trans = null; // si existe la transacción entonces no se crea una
        } else {
            $trans = $con->beginTransaction(); // si no existe la transacción entonces se crea una
        }        
        if (strtolower(end($chk_ext)) == "csv") {
            //si es correcto, entonces damos permisos de lectura para subir                  
            try {
                $handle = fopen($file, "r");
                $cont = 0;
                //$this->deletetablaTemp($con);

                while (($data = fgetcsv($handle, ",")) !== FALSE) {
                    $filaError++;
                    if ($cont != 0) {
                        $haph_id=$this->InsertarHistorial($con,$data);
                        //if ($haph_id > 0) {
                        if (!$haph_id) {//Si no devuelve nada no inserto datos
                            $arroout["status"] = FALSE;
                            $arroout["error"] = null;
                            $arroout["message"] = " Error en la Fila => N°$filaError Nombre => $data[3]";
                            $arroout["data"] = null;
                            throw new Exception('Error, Item no almacenado');                            
                        }
                        /*$model = new PersonaGestionTmp(); //isset
                        $model->pgest_carr_nombre = ($emp_id == "1") ? EstudioAcademico::consultarIdsEstudioAca($data[0]) : EstudioAcademico::consultarIdsModEstudio($emp_id, $data[0]); //"$data[0]";
                        $model->pgest_contacto = PersonaGestionTmp::consultarIdsConocimientoCanal($data[1]); //"$data[1]";
                        $model->pgest_horario = "$data[2]";
                        $model->pgest_unidad_academica = UnidadAcademica::consultarIdsUnid_Academica($data[3]); //"$data[3]";
                        $model->pgest_modalidad = Modalidad::consultarIdsModalidad($data[4]); //"$data[4]";
                        $model->pgest_nombre = "$data[5]";
                        $model->pgest_numero = "$data[6]";
                        $model->pgest_correo = "$data[7]";
                        $model->pgest_comentario = "$data[8]";

                        if (!$model->save()) {
                            $arroout["status"] = FALSE;
                            $arroout["error"] = null;
                            $arroout["message"] = " Error en la Fila => N°$filaError Nombre => $data[5]";
                            $arroout["data"] = null;
                            throw new Exception('Error, Item no almacenado');
                        }*/
                    }
                    $cont++;
                }
                fclose($handle);
                if ($trans !== null)
                    $trans->commit();

                $arroout["status"] = TRUE;
                $arroout["error"] = null;
                $arroout["message"] = null;
                $arroout["data"] = null;
                //return true;
                return $arroout;
            } catch (Exception $ex) {
                fclose($handle);
                if ($trans !== null)
                    $trans->rollback();
                //return false;
                return $arroout;
            }
        }else if (strtolower(end($chk_ext)) == "xls" || strtolower(end($chk_ext)) == "xlsx") {
            //Create new PHPExcel object            
            $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            $dataArr = array();    
            try {
                //$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                    $worksheetTitle = $worksheet->getTitle();
                    $highestRow = 6;//$worksheet->getHighestRow(); // e.g. 10 
                    $highestColumn = $worksheet->getHighestDataColumn(); // e.g 'F'
                    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                    //lectura del Archivo XLS filas y Columnas
                    for ($row = 1; $row <= $highestRow; ++$row) {
                        for ($col = 0; $col <= $highestColumnIndex; ++$col) {
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $val = $cell->getValue();
                            $dataArr[$row][$col] = $val;
                        }
                    }
                    unset($dataArr[1]); // Se elimina la cabecera de titulos del file
                }
                //$this->deletetablaTemp($con);            
                $filaError = 1;
                foreach ($dataArr as $val) {
                    $filaError++;                    
                    $haph_id = $this->InsertarHistorial($con, $val);
                    //if ($haph_id > 0) {
                    if (!$haph_id) {//Si no devuelve nada no inserto datos
                        $arroout["status"] = FALSE;
                        $arroout["error"] = null;
                        $arroout["message"] = " Error en la Fila => N°$filaError Nombre => $val[3]";
                        $arroout["data"] = null;
                        throw new Exception('Error, Item no almacenado');
                    }

                    
                }
                if ($trans !== null)
                    $trans->commit();                    
                    
                $arroout["status"] = TRUE;
                $arroout["error"] = null;
                $arroout["message"] = null;
                $arroout["data"] = null;
                //return true;
                return $arroout;
            } catch (Exception $ex) {
                if ($trans !== null)
                    $trans->rollback();
                    \app\models\Utilities::putMessageLogFile('Error en la Fila => N° ' .$filaError .' Nombre =>'. $val[6]); 
                //return false;
                return $arroout;                
            }
        }
    }
    
    private function InsertarHistorial($con, $dataInfo) {
        
        $idsData=0;
        \app\models\Utilities::putMessageLogFile($dataInfo[3]);
        $IdsPro=$this->consultarIdDocente($dataInfo[3]);
        $IdsPro=($IdsPro!=0)?$IdsPro:0;        
        $asi_id=$this->consultarIdAsignatura($dataInfo[1]);        
        
        $sql = "INSERT INTO " . $con->dbname . ".horario_asignatura_periodo_historial
            (asi_id,pahi_id,pro_id,uaca_id,mod_id,dia_id,haph_fecha_clase,haph_hora_entrada,
             haph_hora_salida,haph_estado,haph_fecha_creacion,haph_estado_logico)VALUES
            (:asi_id,:pahi_id,:pro_id,:uaca_id,:mod_id,:dia_id,:haph_fecha_clase,:haph_hora_entrada,
             :haph_hora_salida,1, CURRENT_TIMESTAMP(),1);";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":asi_id", $asi_id, \PDO::PARAM_INT);
        $comando->bindParam(":pahi_id", intval($dataInfo[2]), \PDO::PARAM_INT);
        $comando->bindParam(":pro_id", $IdsPro, \PDO::PARAM_INT);
        $comando->bindParam(":uaca_id", intval($dataInfo[5]), \PDO::PARAM_INT);
        $comando->bindParam(":mod_id", intval($dataInfo[6]), \PDO::PARAM_INT);
        $comando->bindParam(":dia_id", intval($dataInfo[7]), \PDO::PARAM_INT);
        $comando->bindParam(":haph_fecha_clase", $dataInfo[8], \PDO::PARAM_STR);
        $comando->bindParam(":haph_hora_entrada", $dataInfo[9], \PDO::PARAM_STR);
        $comando->bindParam(":haph_hora_salida", $dataInfo[10], \PDO::PARAM_STR);
        $comando->execute();
        return $con->getLastInsertID();
    }
    
    private function consultarIdDocente($Cedula) {
        $con = \Yii::$app->db_academico;  
        $con1 = \Yii::$app->db_asgard;        
        $sql = "SELECT pro_id Ids FROM " . $con->dbname . ".profesor
                    WHERE  pro_estado=1 AND pro_estado_logico=1
                    AND per_id=(SELECT per_id FROM " . $con1->dbname . ".persona "
                                 . " WHERE per_cedula=:per_cedula);";
        
        $comando = $con->createCommand($sql);
        $comando->bindParam(":per_cedula", $Cedula, \PDO::PARAM_STR);
        //return $comando->queryAll();
        $rawData=$comando->queryScalar();
        if ($rawData === false)
            return 0; //en caso de que existe problema o no retorne nada tiene 1 por defecto 
        return $rawData;
    }  
    
    private function consultarIdAsignatura($nombre) {
        $con = \Yii::$app->db_academico; 
        $sql = "SELECT asi_id FROM " . $con->dbname . ".asignatura "
                . "WHERE asi_estado=1 AND asi_estado_logico=1 AND asi_nombre=:asi_nombre; ";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":asi_nombre", $nombre, \PDO::PARAM_STR);
        //return $comando->queryAll();
        $rawData=$comando->queryScalar();
        if ($rawData === false)
            return 0; //en caso de que existe problema o no retorne nada tiene 1 por defecto 
        return $rawData;
    }  
    
   

}
