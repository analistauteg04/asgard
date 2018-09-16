<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\components\CController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ForgotpassForm;
use app\models\UserPassreset;
use app\models\ChangepassForm;
use \yii\helpers\Url;
use app\models\Usuario;
use app\models\Utilities;
use app\models\Modulo;
use app\models\Grupo;
use app\models\Empresa;
use app\models\Dash;

class SiteController extends CController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'loginemp', 'logout'],
                'rules' => [
                        [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?', '@'], // usuarios invitados
                    ],
                        [
                        'allow' => true,
                        'actions' => ['loginemp'],
                        'roles' => ['?', '@'], // usuarios invitados
                    ],
                        [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'], // usuarios autenticados
                    ],
                        [
                        'allow' => true,
                        'actions' => ['activation'],
                        'roles' => ['?'], // usuarios invitados
                    ],
                        [
                        'allow' => true,
                        'actions' => ['forgotpass'],
                        'roles' => ['?'], // usuarios invitados
                    ],
                        [
                        'allow' => true,
                        'actions' => ['updatepass'],
                        'roles' => ['?'], // usuarios invitados
                    ],
                        [
                        'allow' => true,
                        'actions' => ['getimage'],
                        'roles' => ['?', '@'], // usuarios invitados
                    ],
                        [
                        'allow' => true,
                        'actions' => ['dash'],
                        'roles' => ['@'], // usuarios autenticados
                    ],
                        [
                        'allow' => true,
                        'actions' => ['resourcesfiles'],
                        'roles' => ['@'], // usuarios autenticados
                    ],
                        [
                        'allow' => true,
                        'actions' => ['portalestudiante'],
                        'roles' => ['@'], // usuarios autenticados
                    ],
                        [
                        'allow' => true,
                        'actions' => ['changeempresa'],
                        'roles' => ['@'], // usuarios autenticados
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        if (\Yii::$app->user->isGuest) {
            $link1 = Utilities::getLoginUrl();
            return $this->redirect(Url::base(true) . $link1);
        }

        return $this->render('index');
    }

    /**
     * actionResourcesfiles
     *
     * @author Diana Lopez
     * @access 
     * @param 
     */
    public function actionResourcesfiles() {
        $folderResources = 'resourcesfiles';
        $root = Yii::$app->basePath . Yii::$app->params["documentFolder"] . $folderResources;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $postDir = rawurldecode($root . (isset($data['dir']) ? $data['dir'] : null ));
            $checkbox = ( isset($data['multiSelect']) && $data['multiSelect'] == 'true' ) ? "<input type='checkbox' />" : null;
            $onlyFolders = ( isset($data['onlyFolders']) && $data['onlyFolders'] == 'true' ) ? true : false;
            $onlyFiles = ( isset($data['onlyFiles']) && $data['onlyFiles'] == 'true' ) ? true : false;

            if (file_exists($postDir)) {
                $files = scandir($postDir);
                $returnDir = substr($postDir, strlen($root));
                $htmlCode = "";
                natcasesort($files);
                if (count($files) > 2) { // The 2 accounts for . and ..
                    $htmlCode .= "<ul class='jqueryFileTree'>";
                    foreach ($files as $file) {
                        $htmlRel = htmlentities($returnDir . $file, ENT_QUOTES);
                        $htmlName = htmlentities($file);
                        $ext = preg_replace('/^.*\./', '', $file);
                        if (file_exists($postDir . $file) && $file != '.' && $file != '..') {
                            if (is_dir($postDir . $file) && (!$onlyFiles || $onlyFolders))
                                $htmlCode .= "<li class='directory collapsed'>{$checkbox}<a rel='" . $htmlRel . "/'>" . $htmlName . "</a></li>";
                            else if (!$onlyFolders || $onlyFiles)
                                $htmlCode .= "<li class='file ext_{$ext}'>{$checkbox}<a rel='" . $htmlRel . "'>" . $htmlName . "</a></li>";
                        }
                    }
                    $htmlCode .= "</ul>";
                    return $htmlCode;
                }
            }
            return;
        }else {
            $data = Yii::$app->request->get();
            if ($data["dfile"]) {
                $root = $root . str_replace("../", "", $data["dfile"]);
                if (file_exists($root)) {
                    $mimeType = Utilities::mimeContentType(basename($root));
                    Header("Content-type: $mimeType");
                    Header('Content-Disposition: attachment; filename="' . basename($root) . '"');
                    readfile($root);
                }
                return;
            }
        }
        $this->layout = '@themes/' . Yii::$app->getView()->theme->themeName . '/layouts/repositorio.php';
        return $this->render('resources', [
                    //'currentPath' => Url::base() . Yii::$app->params["documentFolder"] . '/resourcesfiles',
                    'rootfolder' => '/',
                    'script' => Url::base() . '/site/resourcesfiles',
        ]);
    }

    public function actionDash() {
        if (\Yii::$app->user->isGuest) {
            $link1 = Utilities::getLoginUrl();
            return $this->redirect(Url::base(true) . $link1);
        }
        $mod = new Modulo();
        $link = $mod->getFirstModuleLink();
        $url = Url::base(true) . "/" . $link["url"];
        $url_biblioteca = Yii::$app->params['url_biblioteca'];
        $url_educativa = Yii::$app->session->get("PB_educativa", "");//Yii::$app->params['url_educativa'];

        $modules = Dash::find()->all();
        $this->layout = '@themes/' . Yii::$app->getView()->theme->themeName . '/layouts/dash.php';
        return $this->render('dash', [
                    'modules' => $modules,
                    'url_video' => Url::base(true) . "/site/portalestudiante",
                    'url_asgard' => $url,
                    'url_educativa' => $url_educativa
        ]);
    }
    
    public function actionPortalestudiante(){
        if (\Yii::$app->user->isGuest) {
            $link1 = Utilities::getLoginUrl();
            return $this->redirect(Url::base(true) . $link1);
        }
        $this->layout = '@themes/' . Yii::$app->getView()->theme->themeName . '/layouts/dash.php';

        $modules_1 = [
                ['title' => 'Video 1',
                'sub_title' => 'Como ingresar al Campus Virtual UTEG',
                'detail' => 'https://player.vimeo.com/video/239000405',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 2',
                'sub_title' => 'Escritorio del Campus Virtual UTEG',
                'detail' => 'https://player.vimeo.com/video/238999051',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 3',
                'sub_title' => 'Como acceder a nuestra aula virtual',
                'detail' => 'https://player.vimeo.com/video/239000199',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 4',
                'sub_title' => 'Opciones del menú: "Introducción a la materia"',
                'detail' => 'https://player.vimeo.com/video/238998005',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 5',
                'sub_title' => 'Opciones del menú: "Material de estudio"',
                'detail' => 'https://player.vimeo.com/video/238997815',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 6',
                'sub_title' => 'Estructura de unidades de una materia',
                'detail' => 'https://player.vimeo.com/video/238999807',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 7',
                'sub_title' => 'Cronograma de actividades',
                'detail' => 'https://player.vimeo.com/video/239000087',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 8',
                'sub_title' => 'Acceder a bibliotecas y calificaciones',
                'detail' => 'https://player.vimeo.com/video/239022371',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 9',
                'sub_title' => 'Acceder a los foros',
                'detail' => 'https://player.vimeo.com/video/238998716',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 10',
                'sub_title' => 'Como acceder al Chat',
                'detail' => 'https://player.vimeo.com/video/238999673',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 11',
                'sub_title' => 'Como acceder a la clase en vivo',
                'detail' => 'https://player.vimeo.com/video/239000541',
                'link' => $url,
                'target' => ''],
                ['title' => 'Video 12',
                'sub_title' => 'Explicación para acceder al taller',
                'detail' => 'https://player.vimeo.com/video/213758590',
                'link' => $url,
                'target' => ''],
        ];


        /* Inicio - Para archivos descargables */
        $folderResources = 'recusos_portal'; //nombre de la carpeta para presentar Instructivos Generales 
        $root = Yii::$app->basePath . Yii::$app->params["documentFolder"] . $folderResources;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $postDir = rawurldecode($root . (isset($data['dir']) ? $data['dir'] : null ));
            $checkbox = ( isset($data['multiSelect']) && $data['multiSelect'] == 'true' ) ? "<input type='checkbox' />" : null;
            $onlyFolders = ( isset($data['onlyFolders']) && $data['onlyFolders'] == 'true' ) ? true : false;
            $onlyFiles = ( isset($data['onlyFiles']) && $data['onlyFiles'] == 'true' ) ? true : false;

            if (file_exists($postDir)) {
                $files = scandir($postDir);
                $returnDir = substr($postDir, strlen($root));
                $htmlCode = "";
                natcasesort($files);
                if (count($files) > 2) { // The 2 accounts for . and ..
                    $htmlCode .= "<ul class='jqueryFileTree'>";
                    foreach ($files as $file) {
                        $htmlRel = htmlentities($returnDir . $file, ENT_QUOTES);
                        $htmlName = htmlentities($file);
                        $ext = preg_replace('/^.*\./', '', $file);
                        if (file_exists($postDir . $file) && $file != '.' && $file != '..') {
                            if (is_dir($postDir . $file) && (!$onlyFiles || $onlyFolders))
                                $htmlCode .= "<li class='directory collapsed'>{$checkbox}<a rel='" . $htmlRel . "/'>" . $htmlName . "</a></li>";
                            else if (!$onlyFolders || $onlyFiles)
                                $htmlCode .= "<li class='file ext_{$ext}'>{$checkbox}<a rel='" . $htmlRel . "'>" . $htmlName . "</a></li>";
                        }
                    }
                    $htmlCode .= "</ul>";
                    return $htmlCode;
                }
            }
            return;
        }else {
            $data = Yii::$app->request->get();
            if ($data["dfile"]) {
                $root = $root . str_replace("../", "", $data["dfile"]);
                if (file_exists($root)) {
                    $mimeType = Utilities::mimeContentType(basename($root));
                    Header("Content-type: $mimeType");
                    Header('Content-Disposition: attachment; filename="' . basename($root) . '"');
                    readfile($root);
                }
                return;
            }
        }
        $this->layout = '@themes/' . Yii::$app->getView()->theme->themeName . '/layouts/repositorio.php';

        /* Inicio - Para archivos descargables */

        return $this->render('portalestudiante', [
                    'modules_1' => $modules_1,
                    'modules_3' => $modules_3,
                    'modules_4' => $modules_4,
                    'modules_5' => $modules_5,
                    'modules_6' => $modules_6,
                    'modules_7' => $modules_7,
                    //'currentPath' => Url::base() . Yii::$app->params["documentFolder"] . '/resourcesfiles',
                    'rootfolder' => '/',
                    'script' => Url::base() . '/site/portalestudiante',
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            $link1 = Utilities::getLoginUrl();
            return $this->redirect(Url::base(true) . $link1);
        }
        $model = new LoginForm();
        $empresa_alias = isset($_GET['emp'])?$_GET['emp']:NULL;
        
        if ($model->load(Yii::$app->request->post()) && $model->login($empresa_alias)) {
            // setting default url
            $mod = new Modulo();
            $link = $mod->getFirstModuleLink();
            $url = Url::base(true) . "/" . $link["url"];
             //$url = Url::base(true) . "/site/dash";


            return $this->goBack($url);
        } else {
            if ($model->getErrorSession())
                Yii::$app->session->setFlash('loginFormSubmitted');
            return $this->renderFile('@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/login.php', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Login action Multiple Empresa.
     *
     * @return string
     */
    public function actionLoginemp() {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(Url::base(true) . '/site/loginemp');
        }
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // setting default url
            $mod = new Modulo();
            $link = $mod->getFirstModuleLink();
            $url = Url::base(true) . "/" . $link["url"];
            return $this->goBack($url);
        } else {
            if ($model->getErrorSession())
                Yii::$app->session->setFlash('loginFormSubmitted');
            return $this->renderFile('@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/loginemp.php', [
                        'model' => $model,
            ]);
        }
    }

    public function actionChangeempresa(){
        $id = isset($_GET['id'])?$_GET['id']:0;
        if($id > 0){
            $model_empresa = Empresa::findIdentity($id);
            Yii::$app->session->set('PB_idempresa',$id);
            Yii::$app->session->set('PB_empresa',$model_empresa->emp_nombre_comercial);
        }
        //return $this->redirect(Yii::$app->request->referrer);
        $mod = new Modulo();
        $link = $mod->getFirstModuleLink();
        $url = Url::base(true) . "/" . $link["url"];
        return $this->goBack($url);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        $usuario = new Usuario();
        $link1 = Utilities::getLoginUrl();
        //$usuario->destroySession();
        Yii::$app->user->logout(true);
        return $this->redirect(Url::base(true) . $link1);
    }

    public function actionForgotpass() {
        if (!\Yii::$app->user->isGuest) {
            $link1 = Utilities::getLoginUrl();
            return $this->redirect(Url::base(true) . $link1);
        }
        $model = new ForgotpassForm();
        if ($model->load(Yii::$app->request->post()) && $model->verificarCuenta()) {
            // se limpia los campos
            $model->unsetAttributes();
            return $this->renderFile('@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/forgot.php', [
                        'model' => $model,
            ]);
        } else {
            if ($model->getErrorSession())
                Yii::$app->session->setFlash('forgotFormSubmitted');
            return $this->renderFile('@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/forgot.php', [
                        'model' => $model,
            ]);
        }
    }
    
    public function actionForgotpassemp() {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(Url::base(true) . 'site/loginemp');
        }
        $model = new ForgotpassForm();
        if ($model->load(Yii::$app->request->post()) && $model->verificarCuenta()) {
            // se limpia los campos
            $model->unsetAttributes();
            return $this->renderFile('@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/forgotemp.php', [
                        'model' => $model,
            ]);
        } else {
            if ($model->getErrorSession())
                Yii::$app->session->setFlash('forgotFormSubmitted');
            return $this->renderFile('@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/forgotemp.php', [
                        'model' => $model,
            ]);
        }
    }

    public function actionActivation() {
        $data = Yii::$app->request->get();
        if (isset($data["wg"])) {
            $link = Url::base(true) . "/site/activation?wg=" . $data["wg"];
            $usuario = Usuario::findOne(['usu_link_activo' => $link]);
            $status = false;
            if (isset($usuario)) {
                $status = $usuario->activarLinkCuenta($link);
            }
            if ($status) {
                Yii::$app->session->setFlash('success', Yii::t("login", "<h4>Success</h4>Account is enabled. Please change your current password."));
                $passReset = new UserPassreset();
                $link2 = $passReset->generarLinkCambioClave($usuario->usu_id);
                return $this->redirect($link2);
            } else {
                $model = new LoginForm();
                Yii::$app->session->setFlash('error', Yii::t("login", "<h4>Error</h4>Account is disabled. Please confirm the account with link activation in your email account or reset your password."));
                $link1 = Utilities::getLoginUrl();
                return $this->redirect(Url::base(true) . $link1);
            }
        }
    }

    public function actionUpdatepass() {
        if (!\Yii::$app->user->isGuest) {
            $link1 = Utilities::getLoginUrl();
            return $this->redirect(Url::base(true) . $link1);
        }
        $data = Yii::$app->request->get();
        if (isset($data["wg"])) {
            $userpass = new UserPassreset();
            $status = $userpass->verificarLinkCambioClave(Url::base(true) . "/site/updatepass?wg=" . $data["wg"]);
            if ($status) {
                $model = new ChangepassForm();
                if ($model->load(Yii::$app->request->post()) && $model->resetearClave(Url::base(true) . "/site/updatepass?wg=" . $data["wg"])) {
                    // se limpia los campos
                    $model->unsetAttributes();
                    return $this->renderFile('@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/changepass.php', [
                                'model' => $model,
                    ]);
                } else {
                    if ($model->getErrorSession())
                        Yii::$app->session->setFlash('updatepassFormSubmitted');
                    return $this->renderFile('@themes/' . \Yii::$app->getView()->theme->themeName . '/layouts/changepass.php', [
                                'model' => $model,
                    ]);
                }
            }else {
                Yii::$app->session->setFlash('error', Yii::t("login", "<h4>Error</h4>Account is disabled. Please confirm the account with link activation in your email account or reset your password."));
                return $this->redirect('login');
            }
        }
    }

    /**
     * Get image from route
     *
     * @author Eduardo Cueva
     * @access protected
     * @param string $route     Ruta de Imagen
     */
    public function actionGetimage($route) {
        $grupo = new Grupo();
        if (Yii::$app->session->get('PB_isuser')) {
            $data = $grupo->getMainGrupo(Yii::$app->session->get('PB_username'));
            $route = str_replace("../", "", $route);
            if (preg_match("/^\/uploads\//", $route)) {
                $url_image = Yii::$app->basePath . $route;
                $arrIm = explode(".", $url_image);
                $typeImage = $arrIm[count($arrIm) - 1];
                if (file_exists($url_image)) {
                    if (strtolower($typeImage) == "png") {
                        Header("Content-type: image/png");
                        $im = imagecreatefromPng($url_image);
                        ImagePng($im); // Mostramos la imagen
                        ImageDestroy($im); // Liberamos la memoria que ocupaba la imagen
                    } elseif (strtolower($typeImage) == "jpg" || strtolower($typeImage) == "jpeg") {
                        Header("Content-type: image/jpeg");
                        $im = imagecreatefromJpeg($url_image);
                        ImageJpeg($im); // Mostramos la imagen
                        ImageDestroy($im); // Liberamos la memoria que ocupaba la imagen
                    } elseif (strtolower($typeImage) == "pdf") {
                        Header("Content-type: application/pdf");
                        return file_get_contents($url_image);
                    }
                    exit();
                }
            }
        }
        /* Crear una imagen en blanco */
        Header("Content-type: image/png");
        $im = imagecreatetruecolor(90, 90);
        $fondo = imagecolorallocate($im, 255, 255, 255);
        $ct = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 150, 30, $fondo);
// Imprimir un mensaje de error
        imagestring($im, 1, 5, 5, Yii::t('jslang', 'Bad Request') . ": " . $route, $ct);
        ImagePng($im); // Mostramos la imagen
        ImageDestroy($im); // Liberamos la memoria que ocupaba la imagen
        exit();
    }

}
