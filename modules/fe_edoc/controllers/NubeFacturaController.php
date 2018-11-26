<?php

namespace app\modules\fe_edoc\controllers;

use Yii;
use app\modules\fe_edoc\models\NubeFactura;
use app\modules\fe_edoc\models\VSDirectorio;
use app\modules\fe_edoc\models\VSacceso;

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
        if (Yii::$app->request->isAjax) {
            //$contBuscar = isset($_POST['CONT_BUSCAR']) ? CJavaScript::jsonDecode($_POST['CONT_BUSCAR']) : array();
            //echo CJSON::encode($modelo->mostrarDocumentos($contBuscar));
            $arrayData = array();
            $contBuscar = isset($_POST['CONT_BUSCAR']) ? CJavaScript::jsonDecode($_POST['CONT_BUSCAR']) : array();
            $contBuscar[0]['PAGE'] = isset($_GET['page']) ? $_GET['page'] : 0;
            $arrayData = $modelo->mostrarDocumentos($contBuscar);
            $this->renderPartial('_indexGrid', array(
                'model' => $arrayData,
                    ), false, true);
            return;
        }
        $this->titleWindows = Yii::t('DOCUMENTOS', 'Bills');
        $this->render('index', array(
            //'dataProvider' => $dataProvider,
            'model' => $modelo->mostrarDocumentos($contBuscar),
            'tipoDoc' => $tipDoc->recuperarTipoDocumentos(),
            'tipoApr' => $aproba->tipoAprobacion(),
        ));
    }

    public function actionGenerarPdf($ids) {
        try {
            $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
            $rep=new REPORTES;
            $modelo = new NubeFactura(); //Ejmpleo code 3
            $cabFact = $modelo->mostrarCabFactura($ids);
            $detFact = $modelo->mostrarDetFacturaImp($ids);
            $impFact = $modelo->mostrarFacturaImp($ids);
            $pagFact = $modelo->mostrarFormaPago($ids);
            $adiFact = $modelo->mostrarFacturaDataAdicional($ids);
            $venFact= VSDocumentos::buscarDatoVendedor($cabFact['USU_ID']);//DATOS DEL VENDEDOR QUE AUTORIZO
            $mPDF1=$rep->crearBaseReport();
            $Titulo=Yii::$app->getSession()->get('RazonSocial', FALSE) . " - " . $cabFact['NombreDocumento'];
            $nameFile=$cabFact['NombreDocumento'] . '-' . $cabFact['NumDocumento'];
            $Contenido=$this->renderPartial('facturaPDF', array(
                        'cabFact' => $cabFact,
                        'detFact' => $detFact,
                        'impFact' => $impFact,
                        'pagFact' => $pagFact,
                        'adiFact' => $adiFact,
                        'venFact' => $venFact,
                                ), true);
             $mPDF1->SetTitle($Titulo);
             $mPDF1->WriteHTML($Contenido); //hacemos un render partial a una vista preparada, en este caso es la vista docPDF
             $mPDF1->Output($nameFile, 'I');
            //exit;
        } catch (Exception $e) {
            $this->errorControl($e);
        }
    }

    public function actionBuscarPersonas() {
        if (Yii::$app->request->isAjax) {
            $valor = isset($_POST['valor']) ? $_POST['valor'] : "";
            $op = isset($_POST['op']) ? $_POST['op'] : "";
            $arrayData = array();
            $data = new NubeFactura();
            $arrayData = $data->retornarPersona($valor, $op);
            header('Content-type: application/json');
            echo CJavaScript::jsonEncode($arrayData);
        }
    }

    public function actionBuscaDataIndex() {
        if (Yii::$app->request->isAjax) {
            $arrayData = array();
            $obj = new NubeFactura();
            $contBuscar = isset($_POST['CONT_BUSCAR']) ? CJavaScript::jsonDecode($_POST['CONT_BUSCAR']) : array();
            $arrayData = $obj->mostrarDocumentos($contBuscar);
            $this->renderPartial('_indexGrid', array(
                'model' => $arrayData,
                    ), false, true);
            return;
        }
    }

    public function actionGenerarXml($ids) {
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
        $modelo = new NubeFactura();
        $firmaDig = new VSFirmaDigital();
        $firma = $firmaDig->recuperarXAdES_BES();
        $cabFact = $modelo->mostrarCabFactura($ids, '01');
        $detFact = $modelo->mostrarDetFacturaImp($ids);
        $impFact = $modelo->mostrarFacturaImp($ids);
        $adiFact = $modelo->mostrarFacturaDataAdicional($ids); //
        $this->renderPartial('facturaXML', array(
            'cabFact' => $cabFact,
            'detFact' => $detFact,
            'impFact' => $impFact,
            'adiFact' => $adiFact,
            'firma' => $firma,
        ));
    }
    
    public function actionXmlAutorizado($ids) {
        $ids = isset($_GET['ids']) ? base64_decode($_GET['ids']) : NULL;
        $modelo = new NubeFactura();
        $nomDocfile= array();
        $nomDocfile=$modelo->mostrarRutaXMLAutorizado($ids);
        $this->renderPartial('facturaAutXML', array(
            'nomDocfile' => $nomDocfile,
        ));
    }

    public function actionEnviarDocumento() {
        if (Yii::$app->request->isAjax) {
            $ids = isset($_POST['ids']) ? base64_decode($_POST['ids']) : NULL;
            $res = new NubeFactura;
            $arroout=$res->enviarDocumentos($ids);
            header('Content-type: application/json');
            echo CJavaScript::jsonEncode($arroout);
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
            echo CJavaScript::jsonEncode($arroout);
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
                $htmlMail = $this->renderPartial('mensaje', array(
                'CabPed' => $CabPed,
                'DatVen' => $DatVen,
                    ), true);
                $Subject = "Ha Recibido un(a) Orden de Anulación!!!";
                $dataMail->enviarMailInforma($htmlMail,$CabPed,$DatVen,$Subject,1);//Notificacion a Usuarios
            }
            header('Content-type: application/json');
            echo CJavaScript::jsonEncode($arroout);
            return;
        }
    }
    
    public function actionEnviarCorreo() {
        if (Yii::$app->request->isAjax) {
            $ids = isset($_POST['ids']) ? base64_decode($_POST['ids']) : NULL;
            $arroout=VSDocumentos::reenviarDodSri($ids, 'FA',2);//Anula Documentos Autorizados del Websea
            header('Content-type: application/json');
            echo CJavaScript::jsonEncode($arroout);
            return;
        }
    }
    
    public function actionUpdatemail($id) {
        $model = new USUARIO;
        $model = $model->getMailUserDoc($id,'FA');
        $this->render('updatemail', array(
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
            echo CJavaScript::jsonEncode($arrayData);
            return;
        }
    }

}
