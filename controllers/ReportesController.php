<?php

namespace app\controllers;

use Yii;
use app\components\CController;
use app\models\Grupo;
use app\models\Rol;
use app\models\Accion;
use app\models\Modulo;
use app\models\ObjetoModulo;
use app\models\Aplicacion;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
use app\models\Utilities;
use app\models\Reporte;
use app\models\Empresa;
use app\models\ExportFile;
use app\modules\academico\Module as academico;
academico::registerTranslations();
class ReportesController extends CController {
    public function actionIndex() {    
        $empresa_mod = new Empresa();
        $empresa = $empresa_mod->getAllEmpresa();
        return $this->render('index',[
            'arr_empresa' => ArrayHelper::map(array_merge([["id" => "0", "value" => "Todas"]], $empresa), "id", "value"),
        ]);
    }
    public function actionExpexcelreport(){
        $objDat= new Reporte();
        //$data["estado"]= $_GET["estado"];
        $data["op"]= $_GET["op"];
        $data["f_ini"]= $_GET["f_ini"];
        $data["f_fin"]= $_GET["f_fin"];
        $data["search_dni"]= $_GET["searchdni"];
        $data["empresa_id"]= $_GET["empresa_id"];
        //$data["valor"]= $_GET["valor"];
        switch ($data["op"]) {
            case '1'://GRADO
                $arrData=$objDat->consultarActividadporOportunidad($data);
                $arrHeader = array("N° Oport","Fecha","Empresa","Nombres","Apellidos","Unidad Academica","Estado","Observacion");
                $nombarch = "ActividadesOportunidad-" . date("YmdHis").".xls";
                break;
            case '2'://POSGRADO
                $arrData=$objDat->consultarOportunidadProximaAten($data);
                $arrHeader = array(
                            "N° Oport","Fecha Atencion","F.Prox.At","Empresa","Cedula",
                            "Nombres","Apellidos","Unidad Academica","Canal Contacto",
                            "Estado Oport.", "Observacion", "Agente"
                );
                $nombarch = "EstadoOportunidad-" . date("YmdHis").".xls";
                break;
            case '3'://Aspirantes
                $arrData=$objDat->consultarAspirantesPendientes($data);
                $arrHeader = 
                        array(
                            "DNI",
                            "Fecha Solicitud",
                            "Num. Solicitud",
                            "Nombres",                        
                            "Apellidos",
                            "Empresa",
                            "Unidad Academica",
                            "Carrera",
                            "Modalidad",
                            "Agente",
                            "Estado Solicitud",
                            "Estado Documentos",
                            "Estado Pago"
                        );                
                $nombarch = "Aspirantes-" . date("YmdHis").".xls";
                break;
        }
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");        
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');               
        $nameReport = yii::t("formulario", "Application Reports");
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L","M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrData, $colPosition);
        exit;
    }
    
    public function actionInscriptos() {    
        return $this->render('inscriptos',[
            //'arr_empresa' => ArrayHelper::map(array_merge([["id" => "0", "value" => "Todas"]], $empresa), "id", "value"),
        ]);
    }
    public function actionExpexcelinscriptos(){
        $objDat= new Reporte();
        $arrHeader = array();
        $TotEst = array();
        $EmpCol = array();
        $arrDataNew = array();
        $anio= $_GET["anio"];
        $arrData=$objDat->consultarInscriptos($anio);
        $nombarch = "Inscriptos-" . date("YmdHis").".xls";
        //Utilities::putMessageLogFile($arrData);
        $aux="";
        //Obtener datos de cabercera
        $arrHeader[]="Venta x Mes";
        $arrHeader[]="Estudiantes";
        //$arrHeader[]="No Convenio";
        for($i=0; $i<count($arrData); $i++){            
            if($arrData[$i]['cemp_nombre']!=$aux){
                $columna=$arrData[$i]['cemp_nombre'];
                if(!$this->existeColumna($columna, $arrHeader)){
                    $arrHeader[]=$columna;
                }                
                $aux=$columna;
            }         
        }
        //Utilities::putMessageLogFile($arrHeader);
        //Crear Cuerpo de Datos
        $aux="";
        for($i=0; $i<count($arrData); $i++){  
            if($arrData[$i]['cemp_nombre']!=$aux){
                $conEmp=$arrData[$i]['cemp_nombre'];//FIjar la columna
                if(!$this->existeColumna($conEmp, $EmpCol)){
                    $EmpCol[]=$conEmp;
                    for($j=0; $j<12; $j++){//Recorrer el nuevo Array
                        $arrDataNew[$j]['Mes']=$this->retornaMes($j+1);
                        $arrDataNew[$j]['Total']=0;
                        //$arrDataNew[$j]['NO_CON']=0;
                        $cant=$this->numEstudiantes($conEmp, $j+1, $arrData);
                        $arrDataNew[$j][$conEmp]=$cant;
                        $TotEst[$j]+=$cant;
                    }
                }                
                $aux=$conEmp; 
            }
            
        }
        //Actualiza Totales
        for($j=0; $j<12; $j++){
            $arrDataNew[$j]['Total']=$TotEst[$j];
        }
        
        ini_set('memory_limit', '256M');
        $content_type = Utilities::mimeContentType("xls");        
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment;filename=" . $nombarch);
        header('Cache-Control: max-age=0');               
        $nameReport = yii::t("formulario", "Application Reports");
        $colPosition = array("C", "D", "E", "F", "G", "H", "I", "J", "K", "L","M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        Utilities::generarReporteXLS($nombarch, $nameReport, $arrHeader, $arrDataNew, $colPosition);
        exit;
       
    }
    
    private function existeColumna($columna,$arrHeader) {
        for($i=0; $i<count($arrHeader); $i++){
            //Utilities::putMessageLogFile($arrHeader[$i]);
            if($arrHeader[$i]==$columna){
               return true; 
            }
        }
        return false;
    }
    private function numEstudiantes($Empresa,$Mes,$arrData) {
        $valor =0;
        for($i=0; $i<count($arrData); $i++){
            if($arrData[$i]['MES']==$Mes && $arrData[$i]['cemp_nombre']==$Empresa){
               return $arrData[$i]['CANT'];
            }
        }
        return $valor;
    }
       
            


    private function retornaMes($number){
        $valor = "";
        switch ($number){
            case 1: 
                $valor = "Enero";
                break;
            case 2: 
                $valor = "Febrero";
                break;
            case 3: 
                $valor = "Marzo";
                break;
            case 4: 
                $valor = "Abril";
                break;
            case 5: 
                $valor = "Mayo";
                break;
            case 6: 
                $valor = "Junio";
                break;
            case 7: 
                $valor = "Julio";
                break;
            case 8: 
                $valor = "Agosto";
                break;
            case 9: 
                $valor = "Septiembre";
                break;
            case 10: 
                $valor = "Octubre";
                break;
            case 11: 
                $valor = "Noviembre";
                break;
            case 12: 
                $valor = "Diciembre";
                break;
            
        }
        return $valor;
    }
}
