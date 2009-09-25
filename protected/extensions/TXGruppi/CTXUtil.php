<?php
class CTXUtil {
    public static function compareArrays($base,$new) {
        $add = array();
        $del = array();

        if (!is_array($base) || !is_array($new)) return array(array(),array());

        foreach ($base as $v) if (!in_array($v,$new)) $del[] = $v;
        foreach ($new as $v) if (!in_array($v,$base)) $add[] = $v;

        return array($add,$del);
    }

    public static function clearString($string) {
        $f = array(
            "'[áàãâä]'",
            "'[éèêë]'",
            "'[íìîï]'",
            "'[óòõôö]'",
            "'[úùûü]'",
            "'[ç]'",
            "'[ñ]'",
            "'[^a-zA-Z0-9]'",
        );
        $r = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'c',
            'n',
            '',
        );

        $string = strtolower($string);
        $string = preg_replace($f, $r, $string);

        return $string;
    }

    public static function formatMoney($value) {
        $value = number_format($value, 2,",",".");
        return "R$ $value";
    }
}