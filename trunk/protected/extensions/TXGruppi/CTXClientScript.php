<?php
class CTXClientScript {
    protected static $id = 0;

    public static function registerCssFile($name,$media = 'screen') {
        $url = Yii::app()->baseUrl;
        $url = "$url/css/$name.css";
        Yii::app()->clientScript->registerCssFile($url,$media);
    }

    public static function registerScriptFile($name,$position = 0) {
        $url = Yii::app()->baseUrl;
        $url = "$url/js/$name.js";
        Yii::app()->clientScript->registerScriptFile($url,$position);
    }

    public static function registerScript($script,$position = 4) {
        Yii::app()->clientScript->registerScript(self::$id++,$script,$position);
    }
}