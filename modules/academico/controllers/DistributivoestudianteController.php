<?php

namespace app\modules\academico\controllers;

use Yii;
use app\modules\academico\models\Asignatura;
use app\modules\academico\models\DistributivoAcademico;
use app\modules\academico\models\DistributivoAcademicoEstudiante;
use app\modules\academico\models\DistributivoAcademicoHorario;
use app\modules\academico\models\SemestreAcademico;
use app\modules\academico\models\UnidadAcademica;
use app\modules\academico\models\TipoDistributivo;
use app\modules\academico\models\PromocionPrograma;
use app\modules\academico\models\ParaleloPromocionPrograma;
use app\modules\academico\models\Modalidad;
use app\modules\academico\models\PeriodoAcademicoMetIngreso;
use yii\helpers\ArrayHelper;
use app\models\Utilities;
use app\modules\academico\Module as academico;
use app\modules\admision\Module as admision;
use app\models\ExportFile;
use app\models\Persona;
use app\modules\academico\models\Profesor;
use Exception;
use yii\data\ArrayDataProvider;

academico::registerTranslations();
admision::registerTranslations();

class DistributivoestudianteController extends \app\components\CController {

    public function actionIndex($id) {
        $per_id = @Yii::$app->session->get("PB_perid");
        $emp_id = @Yii::$app->session->get("PB_idempresa");
        $distributivoEst_model = new DistributivoAcademicoEstudiante();
        if(!isset($id) && $id <= 0){
            return $this->redirect('distributivoacademico/index');
        }
        
        $data = Yii::$app->request->get();

        if ($data['PBgetFilter']) {
            $search = $data['search'];
            $id = $data['id'];
            $model = $distributivoEst_model->getListadoDistributivoEstudiante($id, $search);
            return $this->render('index-grid', [
                        "model" => $model,
            ]);
        }
        
        $distributivo_model = DistributivoAcademico::findOne($id);
        $distributivo_hora = DistributivoAcademicoHorario::findOne($distributivo_model->daho_id);
        $mod_modalidad = Modalidad::findOne($distributivo_hora->mod_id);
        $mod_unidad = UnidadAcademica::findOne($distributivo_hora->uaca_id);
        $mod_asignatura = Asignatura::findOne($distributivo_model->asi_id);
        $mod_periodo = new PeriodoAcademicoMetIngreso();
        $periodo = $mod_periodo->consultarPeriodoAcademico($distributivo_model->paca_id);
        $mod_profesor = Profesor::findOne($distributivo_model->pro_id);
        $mod_persona = Persona::findOne($mod_profesor->per_id);
        $arr_jornada = array("0" => "Todos", "1" => "(M) Matutino", "2" => "(N) Nocturno", "3" => "(S) Semipresencial", "4" => "(D) Distancia");
        $model = $distributivoEst_model->getListadoDistributivoEstudiante($id);

        return $this->render('index', [
                    'unidad' => $mod_unidad->uaca_nombre,
                    'profesor' => $mod_persona->per_pri_nombre . " " . $mod_persona->per_pri_apellido,
                    'modalidad' => $mod_modalidad->mod_nombre,
                    'periodo' => $periodo[0]['name'],
                    'materia' => $mod_asignatura->asi_nombre,
                    'horario' => $distributivo_hora->daho_horario,
                    'model' => $model,
                    'jornada' => $arr_jornada[$distributivo_hora->daho_jornada],
        ]);
    }

    

}