<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
  Created on : 23/04/2018
  Author     : Diana Lopez
 */

namespace app\widgets\PbSearchBox;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

class PbSearchBox extends Widget {

    private static $widget_name = "PbSearchBox";
    public $boxId = "";
    public $boxLabel = "";
    public $boxValue = "";
    public $type = ""; //Type of searchBox like "searchBox" or "searchBoxList".	
    public $placeHolder = ""; //Placeholder in searchBox.
    public $classBox = ""; //Css to apply
    public $controller = ""; //Name of controller/action: Example: Persona/getPersona
    public $callbackListSource = "";
    public $callbackListSourceParams = array();
    public $callbackListSelected = "";
    public $callbackListSelectedParams = array("ui.item.id");
    public $htmlOptions = array();

    public function init() {
        parent::init();
        $this->registerTranslations();
    }

    public function run() {
        //$this->registerClientScript();
        echo $this->render('index', [
            "data" => $this->printSearchBox(),
            "label" => $this->placeHolder,
        ]);
        //return Html::encode($this->message);
    }

    public function printSearchBox() {
        $parSource = $this->getParamSource($this->callbackListSourceParams, "source");
        $parSelected = $this->getParamSource($this->callbackListSelectedParams, "selected");
        $htmlOptions = [
            'id' => $this->boxId,
            'placeholder' => $this->placeHolder,
            'class' => "form-control " . $this->classBox,
        ];
        $actions = [
                //"Onkeyup" => $this->callbackListSource . "(" . $parSource . ")",
        ];
        switch ($this->type) {
            case "searchBox":
                return Html::textInput($this->boxId, $this->boxValue, array_merge($htmlOptions, $actions)) .
                        Html::tag('span', Html::buttonInput($this->placeHolder, ['id' => $this->boxId . "_btn", 'class' => $this->classBox . ' btn btn-primary btn-flat', "Onclick" => $this->callbackListSource . "(" . $parSource . ")"]), ["class" => "input-group-btn"]);
                break;
            case "searchBoxList":
                return AutoComplete::widget([
                            'name' => $this->boxId,
                            'id' => $this->boxId,
                            'clientOptions' => [
                                'source' => "js: function(request, response){
                                          " . $this->callbackListSource . "(request, response " . $parSource . ");
                                 }",
                                'source' => \Yii::$container->get('JsExpression', ['function(request, response) {
                            response( $.ui.autocomplete.filter( window.dataAsArray, extractLast( request.term ) ) );
                        }']),
                                'select' => \Yii::$container->get('JsExpression', ['function(event, ui) {
                            var terms = split( this.value );
                            terms.pop();
                            terms.push( ui.item.value );
                            terms.push( "" );
                            this.value = terms.join( ", " );
                            return false;
                        }']),
                                'focus' => \Yii::$container->get('JsExpression', ['function() {
                            return false;
                        }']),
                            ],
                            'options' => $htmlOptions,
                ]);
                break;
        }
    }

    /**
     * Registers required scripts
     */
    public function registerClientScript() {
        $script = '';
        $view = $this->getView();
        $view->registerJs($script, View::POS_HEAD, $id);
    }

    public function getParamSource($params, $type) {
        $str_params = "";
        if (count($params) > 0) {
            if ($type == "source") {
                for ($i = 0; $i < count($params); $i++) {
                    if ($i > 0) {
                        $str_params .= ", ";
                    }
                    $str_params .= $params[$i];
                }
            } else {
                $str_params .= $params[0];
            }
        }
        return $str_params;
    }

    public function registerTranslations() {
        $fileMap = $this->getMessageFileMap();
        $i18n = Yii::$app->i18n;
        $i18n->translations['widgets/' . self::$widget_name . '/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            //'sourceLanguage' => 'en-US',
            'basePath' => '@app/widgets/' . self::$widget_name . '/messages',
            'fileMap' => $fileMap,
        ];
    }

    private function getMessageFileMap() {
        // read directory message
        $arrLangFiles = array();
        $dir_messages = __DIR__ . DIRECTORY_SEPARATOR . "messages";
        $fileMap = array();
        $listDirs = scandir($dir_messages);
        foreach ($listDirs as $dir) {
            if ($dir != "." && $dir != "..") {
                $langDir = scandir($dir_messages . DIRECTORY_SEPARATOR . $dir);
                foreach ($langDir as $langFile) {
                    if (preg_match("/\.php$/", trim($langFile))) {
                        if (!in_array($langFile, $arrLangFiles)) {
                            $arrLangFiles[] = $langFile;
                            $file = str_replace(".php", "", $langFile);
                            $key = "widgets/" . self::$widget_name . "/" . $file;
                            $fileMap[$key] = $langFile;
                        }
                    }
                }
            }
        }
        return $fileMap;
    }

    public static function t($category, $message, $params = [], $language = null) {
        return Yii::t('widgets/' . self::$widget_name . '/' . $category, $message, $params, $language);
    }

}
