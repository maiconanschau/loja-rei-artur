<?php
class CTXRequest {
    public static function getParam($name,$default = null) {
        return isset($_GET[$name]) ? $_GET[$name] : (isset($_POST[$name]) ? $_POST[$name] : $default);
    }

    public static function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
}