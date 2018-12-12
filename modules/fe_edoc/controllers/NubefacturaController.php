<?php

namespace app\modules\fe_edoc\controllers;

use Yii;
use app\modules\fe_edoc\models\NubeFactura;
use app\modules\fe_edoc\models\VSDirectorio;
use app\modules\fe_edoc\models\VSDocumentos;
use app\modules\fe_edoc\models\VSFirmaDigital;
use app\modules\fe_edoc\models\VSexception;
use app\modules\fe_edoc\models\VSacceso;
use app\modules\fe_edoc\models\mailSystem;
use app\modules\fe_edoc\models\REPORTES;
use app\modules\fe_edoc\models\USUARIO;
use app\models\ExportFile;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

class NubefacturaController extends \app\components\CController {

    
//    public function accessRules() {
//        return array(
//            array('allow', // permite a todos los usuarios ejecutar las acciones
//                'actions' => array('index', 'view'),
//                'users' => array('*'),
//            ),
//            array('allow', // permite a los usuarios logueados ejecutar las acciones 
//                'actions' => array('create', 'update', 'GenerarPdf', 'BuscaDataIndex', 'BuscarPersonas', 'GenerarXml', 'EnviarDocumento',
//                    'EnviarCorreccion','EnviarAnular','EnviarCorreo','Updatemail','Savemail','XmlAutorizado'),
//                'users' => array('@'),
//            ),
//            array('allow', // permite que únicamente el usuario admin ejecute las , 
//                'actions' => array('admin', 'delete'),
//                'users' => array('admin'),
//            ),
//            array('deny', // niega cualquier otra acción para cualquier usuario
//                'users' => array('*'),
//            ),
//        );
//    }

    public function actionIndex() {
        $modelo = new NubeFactura();
        $tipDoc= new VSDirectorio();
        $aproba= new VSacceso();
        $contBuscar = array();
        $data = Yii::$app->request->get();
        if ($data['PBgetFilter']) {
            //$contBuscar = isset($_POST['CONT_BUSCAR']) ? json_encode($_POST['CONT_BUSCAR']) : array();
            //echo CJSON::encode($modelo->mostrarDocumentos($contBuscar));
            $arrayData = array();
            $contBuscar = isset($data['CONT_BUSCAR']) ? json_decode($data['CONT_BUSCAR'],true) : array();
            //$contBuscar[0]['PAGE'] = isset($data['page']) ? $data['page'] : 0;
            $arrayData = $modelo->mostrarDocumentos($contBuscar);
            return $this->render('_indexGrid', array(
                'model' => $arrayData,
                    ));
        }
        if (Yii::$app->request->isAjax) {
            $valor = isset($_POST['valor']) ? $_POST['valor'] : "";
            $op = isset($_POST['op']) ? $_POST['op'] : "";
            $arrayData = array();
            $data = new NubeFactura();
            $arrayData = $data->retornarPersona($valor, $op);
            header('Content-type: application/json');
            echo json_encode($arrayData);
            return;
        }
        //$this->view->title = Yii::t('DOCUMENTOS', 'Bills');
        return $this->render('index', array(
            //'dataProvider' => $dataProvider,
            'model' => $modelo->mostrarDocumentos($contBuscar),
            'tipoDoc' => $tipDoc->recuperarTipoDocumentos(),
            'tipoApr' => $aproba->tipoAprobacion(),
        ));
    }

    public function actionGenerarpdf($ids) {
        try {
            $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
            $rep= $report = new ExportFile();
            //$this->view->title = "Invoices";
            $modelo = new NubeFactura(); //Ejmpleo code 3
            $cabFact = $modelo->mostrarCabFactura($ids);
            $detFact = $modelo->mostrarDetFacturaImp($ids);
            $impFact = $modelo->mostrarFacturaImp($ids);
            $pagFact = $modelo->mostrarFormaPago($ids);
            $adiFact = $modelo->mostrarFacturaDataAdicional($ids);
            $venFact= VSDocumentos::buscarDatoVendedor($cabFact['USU_ID']);//DATOS DEL VENDEDOR QUE AUTORIZO

            $rep->orientation = "P"; // tipo de orientacion L => Horizontal, P => Vertical    
            $rep->createReportPdf(
                $this->render('facturaPDF', [
                    'cabFact' => $cabFact,
                    'detFact' => $detFact,
                    'impFact' => $impFact,
                    'pagFact' => $pagFact,
                    'adiFact' => $adiFact,
                    'venFact' => $venFact,
                ])
            );
            $rep->mpdf->Output('Reporte_' . date("Ymdhis") . ".pdf", ExportFile::OUTPUT_TO_DOWNLOAD); 
            //exit;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionBuscaDataIndex() {
        if (Yii::$app->request->isAjax) {
            $arrayData = array();
            $obj = new NubeFactura();
            $contBuscar = isset($_POST['CONT_BUSCAR']) ? json_encode($_POST['CONT_BUSCAR']) : array();
            $arrayData = $obj->mostrarDocumentos($contBuscar);
            return $this->render('_indexGrid', array(
                'model' => $arrayData,));
        }
    }

    public function actionGenerarxml($ids) {
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
        $modelo = new NubeFactura();
        $firmaDig = new VSFirmaDigital();
        $firma = $firmaDig->recuperarXAdES_BES();
        $cabFact = $modelo->mostrarCabFactura($ids, '01');
        $detFact = $modelo->mostrarDetFacturaImp($ids);
        $impFact = $modelo->mostrarFacturaImp($ids);
        $adiFact = $modelo->mostrarFacturaDataAdicional($ids); //
        return $this->render('facturaXML', array(
            'cabFact' => $cabFact,
            'detFact' => $detFact,
            'impFact' => $impFact,
            'adiFact' => $adiFact,
            'firma' => $firma,
        ));
    }
    
    public function actionXmlautorizado($ids) {
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
        $modelo = new NubeFactura();
        $nomDocfile= array();
        $nomDocfile=$modelo->mostrarRutaXMLAutorizado($ids);
        if ($nomDocfile["EstadoDocumento"] == "AUTORIZADO") { // Si retorna un Valor en el Array
            $nombreDocumento = $nomDocfile["NombreDocumento"];
            //echo "file created";exit;
            header('Content-type: text/xml');   // i am getting error on this line
            //Cannot modify header information - headers already sent by (output started at D:\xampp\htdocs\yii\framework\web\CController.php:793)
            header('Content-Disposition: Attachment; filename="' . $nombreDocumento . '"');
            // File to download
            readfile($nomDocfile["DirectorioDocumento"] . $nombreDocumento);        // i am not able to download the same file
        } else {
            echo "Documento No autorizado";
        }
    }

    public function actionEnviarDocumento() {
        if (Yii::$app->request->isAjax) {
            $ids = isset($_POST['ids']) ? base64_decode($_POST['ids']) : NULL;
            $res = new NubeFactura;
            $arroout=$res->enviarDocumentos($ids);
            header('Content-type: application/json');
            echo json_encode($arroout);
            return;
        }
    }
    
    public function actionEnviarCorreccion() {
        if (Yii::$app->request->isAjax) {
            $modelo = new NubeRetencion(); //Ejmpleo code 3
            $errAuto= new VSexception();
            $ids = isset($_POST['ids']) ? base64_decode($_POST['ids']) : NULL;
            $result=VSDocumentos::anularDodSri($ids,'FA',5);//Anula Documentos Retenciones del Sistema
            $arroout=$errAuto->messageSystem('NO_OK',null, 1, null, null);
            if($result['status'] == 'OK'){//Si es Verdadero actualizo datos de base intermedia
                $result=VSDocumentos::corregirDocSEA($ids,'FA');
                if($result['status'] == 'OK'){
                    $arroout=  $errAuto->messageSystem('OK', null,12,null, null);
                }
            }
            header('Content-type: application/json');
            echo json_encode($arroout);
            return;
        }
    }
    
    public function actionEnviarAnular() {
        if (Yii::$app->request->isAjax) {
            $dataMail = new mailSystem;
            $ids = isset($_POST['ids']) ? base64_decode($_POST['ids']) : NULL;
            $arroout=VSDocumentos::anularDodSri($ids, 'FA',8);//Anula Documentos Autorizados del Websea
            if($arroout['status'] == 'OK'){//Si es Verdadero actualizo datos de base intermedia
                $CabPed=VSDocumentos::enviarInfoDodSri($ids,'FA');
                $DatVen=VSDocumentos::buscarDatoVendedor($CabPed["UsuId"]);//Datos del Vendedor que AUTORIZO
                $htmlMail = $this->render('mensaje', array(
                'CabPed' => $CabPed,
                'DatVen' => $DatVen,
                    ));
                $Subject = "Ha Recibido un(a) Orden de Anulación!!!";
                $dataMail->enviarMailInforma($htmlMail,$CabPed,$DatVen,$Subject,1);//Notificacion a Usuarios
            }
            header('Content-type: application/json');
            echo json_encode($arroout);
            return;
        }
    }
    
    public function actionEnviarCorreo() {
        if (Yii::$app->request->isAjax) {
            $ids = isset($_POST['ids']) ? base64_decode($_POST['ids']) : NULL;
            $arroout=VSDocumentos::reenviarDodSri($ids, 'FA',2);//Anula Documentos Autorizados del Websea
            header('Content-type: application/json');
            echo json_encode($arroout);
            return;
        }
    }
    
    public function actionUpdatemail($id) {
        $model = new USUARIO;
        $model = $model->getMailUserDoc($id,'FA');
        return $this->render('updatemail', array(
            'model' => $model,
        ));
    }
    public function actionSavemail() {
        $model = new USUARIO;
        if (Yii::$app->request->isAjax) {
            $ids = isset($_POST['ID']) ? $_POST['ID'] : 0;
            $correo = isset($_POST['DATA']) ? trim($_POST['DATA']) : '';
            $arrayData = $model->cambiarMailDoc($ids,$correo);
            header('Content-type: application/json');
            echo json_encode($arrayData);
            return;
        }
    }

}
