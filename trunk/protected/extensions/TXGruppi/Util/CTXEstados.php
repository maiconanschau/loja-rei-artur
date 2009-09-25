<?php
class CTXEstados {
    const EST_AC = "AC";
    const EST_AL = "AL";
    const EST_AP = "AP";
    const EST_AM = "AM";
    const EST_BA = "BA";
    const EST_CE = "CE";
    const EST_DF = "DF";
    const EST_ES = "ES";
    const EST_GO = "GO";
    const EST_MA = "MA";
    const EST_MT = "MT";
    const EST_MS = "MS";
    const EST_MG = "MG";
    const EST_PA = "PA";
    const EST_PB = "PB";
    const EST_PR = "PR";
    const EST_PE = "PE";
    const EST_PI = "PI";
    const EST_RJ = "RJ";
    const EST_RN = "RN";
    const EST_RS = "RS";
    const EST_RO = "RO";
    const EST_RR = "RR";
    const EST_SC = "SC";
    const EST_SP = "SP";
    const EST_SE = "SE";
    const EST_TO = "TO";

    public static function getOptions() {
        return array(
        self::EST_AC=>"Acre",
        self::EST_AL=>"Alagoas",
        self::EST_AP=>"Amapá",
        self::EST_AM=>"Amazonas",
        self::EST_BA=>"Bahia",
        self::EST_CE=>"Ceará",
        self::EST_DF=>"Distrito Federal",
        self::EST_ES=>"Espírito Santo",
        self::EST_GO=>"Goiás",
        self::EST_MA=>"Maranhão",
        self::EST_MT=>"Mato Grosso",
        self::EST_MS=>"Mato Grosso do Sul",
        self::EST_MG=>"Minas Gerais",
        self::EST_PA=>"Pará",
        self::EST_PB=>"Paraíba",
        self::EST_PR=>"Paraná",
        self::EST_PE=>"Pernambuco",
        self::EST_PI=>"Piauí",
        self::EST_RJ=>"Rio de Janeiro",
        self::EST_RN=>"Rio Grande do Norte",
        self::EST_RS=>"Rio Grande do Sul",
        self::EST_RO=>"Rondônia",
        self::EST_RR=>"Roraima",
        self::EST_SC=>"Santa Catarina",
        self::EST_SP=>"São Paulo",
        self::EST_SE=>"Sergipe",
        self::EST_TO=>"Tocantins",
        );
    }

    public static function getTexto($value) {
        $options = self::getOptions();
        return isset($options[$value]) ? $options[$value] : "desconhecido ({$value})";
    }
}