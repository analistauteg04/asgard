<?php

namespace app\models;

use yii\data\ArrayDataProvider;
use Yii;


/**
 * This is the model class for table "carrera".
 *
 * @property integer $car_id
 * @property string $car_nombre
 * @property string $car_descripcion
 * @property integer $car_total_asignatura
 * @property integer $car_duracion_anio
 * @property string $car_estado_carrera
 * @property string $car_estado
 * @property string $car_fecha_creacion
 * @property string $car_fecha_aprobacion
 * @property string $car_fecha_modificacion
 * @property string $car_estado_logico
 */
class Carrera extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrera';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_academico');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car_nombre', 'car_descripcion', 'car_estado_carrera', 'car_estado', 'car_estado_logico'], 'required'],
            [['car_total_asignatura', 'car_duracion_anio'], 'integer'],
            [['car_fecha_creacion', 'car_fecha_aprobacion', 'car_fecha_modificacion'], 'safe'],
            [['car_nombre'], 'string', 'max' => 200],
            [['car_descripcion'], 'string', 'max' => 500],
            [['car_estado_carrera'], 'string', 'max' => 2],
            [['car_estado', 'car_estado_logico'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'car_id' => 'Car ID',
            'car_nombre' => 'Car Nombre',
            'car_descripcion' => 'Car Descripcion',
            'car_total_asignatura' => 'Car Total Asignatura',
            'car_duracion_anio' => 'Car Duracion Anio',
            'car_estado_carrera' => 'Car Estado Carrera',
            'car_estado' => 'Car Estado',
            'car_fecha_creacion' => 'Car Fecha Creacion',
            'car_fecha_aprobacion' => 'Car Fecha Aprobacion',
            'car_fecha_modificacion' => 'Car Fecha Modificacion',
            'car_estado_logico' => 'Car Estado Logico',
        ];
    }
    
/**
     * @return \yii\db\ActiveQuery
     */
    public function getFac() {
        return $this->hasOne(Facultad::className(), ['fac_id' => 'fac_id']);
    }

    public function consultarCarreraXUni($nint_id) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                    car.car_id AS id,
                    car.car_nombre AS value  
               FROM " . $con->dbname . ".modalidad_carrera_nivel mcn
                    INNER JOIN " . $con->dbname . ".carrera as car on car.car_id = mcn.car_id
               WHERE  car.car_estado_logico = :estado AND
                    car.car_estado = :estado AND
                    car.car_estado_logico=:estado AND 
                    mcn.mcni_estado=:estado AND
                    mcn.mcni_estado_logico=:estado AND
                    mcn.mod_id=:nint_id";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":nint_id", $nint_id, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    public function consultarNombreCarrera($carrera_id) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT                     
                    car.car_nombre 
               FROM " . $con->dbname . ".carrera car                    
               WHERE car.car_id = :carrera_id AND 
                    car.car_estado = :estado AND
                    car.car_estado_logico=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":carrera_id", $carrera_id, \PDO::PARAM_INT);
        $resultData = $comando->queryOne();
        return $resultData;
    }

    /* Esta funcion es para poder realizar la maquetacion de la asignacion de materia, puesto que aun 
     * no se cuenta con su propio modelo, una vez realiazado el modelo , pasarlo alli y borrar de aqui
      Giovanni Vergara Zárate 14/03/2018 13:58 */

    /**
     * Function Obtiene listado de materias
     * @author Giovanni Ver <analistadesarrollo01@uteg.edu.ec>;
     * @param
     * @return
     */
    public function listadoMateria() {
        $con = \Yii::$app->db_academico;
        $estado = 1;


        $sql = "SELECT  asi_id as id, 
                        asi_nombre as asi_nombre                  
                FROM "
                . $con->dbname . ".asignatura 
                WHERE   asi_estado = :estado AND
                        asi_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [],
            ],
        ]);

        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    public function listadoAreaConocimiento() {
        $con = \Yii::$app->db_academico;
        $estado = 1;


        $sql = "SELECT  acon_id as id, 
                        acon_nombre as area_conocimiento                  
                FROM "
                . $con->dbname . ".area_conocimiento 
                WHERE   acon_estado = :estado AND
                        acon_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [],
            ],
        ]);

        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function obtener Facultad segun nivel interes estudio
     * @author  
     * @property       
     * @return  
     */
    public function consultarFacultad($nivelinteres) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                    fact.fac_id as id,
                    fact.fac_nombre as name
                FROM 
                    " . $con->dbname . ".facultad as fact            
                WHERE   
                    fact.nint_id=:nivelinteres AND
                    fact.fac_estado_logico=:estado AND 
                    fact.fac_estado=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":nivelinteres", $nivelinteres, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function obtener Facultad segun nivel interes estudio
     * @author  
     * @property       
     * @return  
     */
    public function consultarAreaconocimiento() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                    acon.acon_id as id     ,
                    acon.acon_nombre as name
                FROM 
                    " . $con->dbname . ".area_conocimiento as acon            
                WHERE                    
                    acon.acon_estado_logico=:estado AND 
                    acon.acon_estado=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function consultas las carreras
     * @author  
     * @property       
     * @return  
     */
    public function consultarCarrera($arrFiltro = array()) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            if ($arrFiltro['facultad'] != "" && $arrFiltro['facultad'] > 0) {
                $str_search .= " cam.mod_id = :modalidad AND";
            }
            if ($arrFiltro['subareaeva'] != "" && $arrFiltro['subareaeva'] > 0) {
                $str_search .= " sca.scon_id = :subarea AND";
            }
            if ($arrFiltro['asignaeva'] != "") {
                $str_search .= " cas.asi_id = :asignatura AND";
            }
        }
        $sql = "SELECT 
                    car.car_id as id,
                    car.car_nombre as name
                    FROM
                    " . $con->dbname . ".sub_conoc_asignatura as sca
                    INNER JOIN " . $con->dbname . ".carrera_asignatura cas ON cas.asi_id = sca.asi_id
                    INNER JOIN " . $con->dbname . ".carrera_malla cam ON cam.car_id = cas.car_id
                    INNER JOIN " . $con->dbname . ".carrera car ON car.car_id = cam.car_id
                    WHERE ";
        if ($str_search != "") {
            $sql .= " $str_search ";
        } else {
            $sql .= "cam.mod_id = 0 AND
                     sca.scon_id = 0 AND  
                     cas.asi_id = 0 AND ";
        }
        $sql .= " sca.scas_estado = :estado AND
                  sca.scas_estado_logico AND
                  cas.casi_estado = :estado AND
                  cas.casi_estado_logico = :estado AND
                  cam.cmal_estado = :estado AND
                  cam.cmal_estado_logico = :estado AND
                  car.car_estado = :estado AND
                  car.car_estado_logico = :estado";

        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        if (isset($arrFiltro) && count($arrFiltro) > 0) {
            $modalidad = $arrFiltro["facultad"];
            $subarea = $arrFiltro["subareaeva"];
            $asignatura = $arrFiltro["asignaeva"];
            if ($arrFiltro['facultad'] != "" && $arrFiltro['facultad'] > 0) {
                $comando->bindParam(":modalidad", $modalidad, \PDO::PARAM_INT);
            }
            if ($arrFiltro['subareaeva'] != "" && $arrFiltro['subareaeva'] > 0) {
                $comando->bindParam(":subarea", $subarea, \PDO::PARAM_INT);
            }
            if ($arrFiltro['asignaeva'] != "") {
                $comando->bindParam(":asignatura", $asignatura, \PDO::PARAM_INT);
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
                'attributes' => [],
            ],
        ]);

        if ($onlyData) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    public function consultarMateriaArea($subarea, $data) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT a.asi_id as id, 
                      a.asi_nombre as name                     
                FROM 
                    " . $con->dbname . ".sub_conoc_asignatura sb
                    Join " . $con->dbname . ".asignatura a
                    on a.asi_id = sb.asi_id
                WHERE sb.scon_id= :subarea  
                AND sb.scas_estado  =:estado 
                AND sb.scas_estado_logico=:estado 
                AND a.asi_estado =:estado 
                AND a.asi_estado_logico =:estado
                ORDER BY name";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":subarea", $subarea, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => Yii::$app->params["pageSize"],
            ],
            'sort' => [
                'attributes' => [],
            ],
        ]);       
        if ($data == 1) {
            return $resultData;
        } else {
            return $dataProvider;
        }
    }

    /**
     * Function obtener Facultad segun nivel interes estudio
     * @author  
     * @property       
     * @return  
     */
    public function consultaMateria($carrera) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                    asi.asi_id as id,
                    asi.asi_nombre as name
                FROM 
                    " . $con->dbname . ".carrera_asignatura casi "
                . "INNER JOIN  " . $con->dbname . ".	asignatura asi ON asi.asi_id = casi.asi_id
                WHERE   
                    casi.car_id=:carrera AND
                    casi.casi_estado_logico=:estado AND 
                    casi.casi_estado=:estado AND
                    asi.asi_estado_logico=:estado AND 
                    asi.asi_estado=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":carrera", $carrera, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function obtener año academico
     * @author  Giovanni Ver <analistadesarrollo02@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function consultaAnio() {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                    aac.aaca_id as id,
                    aac.aaca_nombre as name
                FROM 
                    " . $con->dbname . ".anio_academico as aac            
                WHERE                   
                    aac.aaca_estado_logico=:estado AND 
                    aac.aaca_estado=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function obtener Facultad segun nivel interes estudio
     * @author  Giovanni Ver <analistadesarrollo02@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function consultarSubAreaConocimiento($area) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                    sacon.scon_id as id     ,
                    sacon.scon_nombre as name
                FROM 
                    " . $con->dbname . ".subarea_conocimiento as sacon            
                WHERE   sacon.acon_id = :area AND            
                    sacon.scon_estado=:estado AND 
                    sacon.scon_estado_logico=:estado
                    order by sacon.acon_id";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":area", $area, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }

    /**
     * Function obtener Modalidad segun nivel interes estudio
     * @author  Giovanni Ver <analistadesarrollo02@uteg.edu.ec>;
     * @property       
     * @return  
     */
    public function consultarModalidad($nivelinteres) {
        $con = \Yii::$app->db_academico;
        $estado = 1;
        $sql = "SELECT 
                    moda.mod_id as id,
                    moda.mod_nombre as name
                FROM 
                    " . $con->dbname . ".modalidad as moda            
                WHERE   
                    (moda.mod_nivel_grado=:nivelinteres OR moda.mod_nivel_posgrado=:nivelinteres) AND
                    moda.mod_estado_logico=:estado AND 
                    moda.mod_estado=:estado";
        $comando = $con->createCommand($sql);
        $comando->bindParam(":estado", $estado, \PDO::PARAM_STR);
        $comando->bindParam(":nivelinteres", $nivelinteres, \PDO::PARAM_INT);
        $resultData = $comando->queryAll();
        return $resultData;
    }
    
}
