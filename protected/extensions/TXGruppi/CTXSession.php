<?php
class CTXSession {
    protected static $session;

    protected static function createSession() {
        if (!isset(self::$session)) {
            self::$session = new CHttpSession();
        }
    }

    public static function open() {
        self::createSession();
        self::$session->open();
    }

    public static function getSession() {
        self::createSession();
        return self::$session;
    }
}