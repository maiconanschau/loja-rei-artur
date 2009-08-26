<?php
class CTXFeedback {
    protected static $feedbackSession = null;
    
    protected static function startSession() {
        CTXSession::open();
    }
    
    protected static function init() {
        self::startSession();
    
        $_SESSION = array_merge_recursive($_SESSION,array(
            'CTXFeedback'=>array(
                'error'=>array(),
                'alert'=>array(),
                'success'=>array()
            )
        ));
        self::$feedbackSession = &$_SESSION['CTXFeedback'];
    }

    protected static function addMessage(&$holder,$message) {
        $holder[] = $message;
    }

    public static function addError($message) {
        self::init();
        self::addMessage(self::$feedbackSession['error'],$message);
    }

    public static function addAlert($message) {
        self::init();
        self::addMessage(self::$feedbackSession['alert'],$message);
    }

    public static function addSuccess($message) {
        self::init();
        self::addMessage(self::$feedbackSession['success'],$message);
    }

    protected static function hasMessages(&$holder) {
        return count($holder) ? true : false;
    }

    public static function hasError() {
        self::init();
        return self::hasMessages(self::$feedbackSession['error']);
    }

    public static function hasAlert() {
        self::init();
        return self::hasMessages(self::$feedbackSession['alert']);
    }

    public static function hasSuccess() {
        self::init();
        return self::hasMessages(self::$feedbackSession['success']);
    }

    protected static function clearMessages(&$holder) {
        $holder = array();
    }

    public static function clearError() {
        self::init();
        self::clearMessages(self::$feedbackSession['error']);
    }

    public static function clearAlert() {
        self::init();
        self::clearMessages(self::$feedbackSession['alert']);
    }

    public static function clearSuccess() {
        self::init();
        self::clearMessages(self::$feedbackSession['success']);
    }

    public static function clearAll() {
        self::init();
        self::clearMessages(self::$feedbackSession['error']);
        self::clearMessages(self::$feedbackSession['alert']);
        self::clearMessages(self::$feedbackSession['success']);
    }

    protected static function getMessage(&$holder) {
        $messages = implode("<br/>",$holder);
        self::clearMessages($holder);
        return $messages;
    }

    public static function getError() {
        return self::getMessage(self::$feedbackSession['error']);
    }

    public static function getAlert() {
        return self::getMessage(self::$feedbackSession['alert']);
    }

    public static function getSuccess() {
        return self::getMessage(self::$feedbackSession['success']);
    }

    public static function displayAll() {
        $template  = "<div class='%s'>";
        $template .= "%s";
        $template .= "</div>";

        $out = "";
        if (self::hasSuccess()) $out .= sprintf($template,'sucesso',self::getSuccess());
        if (self::hasAlert()) $out .= sprintf($template,'alerta',self::getAlert());
        if (self::hasError()) $out .= sprintf($template,'erro',self::getError());
        return $out;
    }
}