<?php

namespace app\components;

use Yii;

/**
 * Description of CController
 *
 * @author eduardocueva
 */
class CController extends \yii\web\Controller {

    public function init() {
        return parent::init();
    }

    /**
     * Function ajaxResponse
     * @author  Eduardo Cueva <ecueva@penblu.com>
     * @param      
     * @return  
     */
    public function runAction($id, $params = []) {
        $session = Yii::$app->session;
        $isUser = $session->get('PB_isuser', FALSE);
        $route = $this->getRoute() . "/login";
        $usu = new \app\models\Usuario;
        $usu->regenerateSession();
        if ($isUser == FALSE && $route != "site/login") {
            $this->redirect(Yii::$app->urlManager->createUrl(["site/login"]));
        }
        return parent::runAction($id, $params);
    }

}
