<?php
class CTXDate {
    public static function toDate($data) {
		return preg_replace("/^([0-9]{4}).([0-9]{2}).([0-9]{2})/","$3/$2/$1",$data);
	}
	
	public static function toSql($data) {
		return preg_replace("/^([0-9]{2}).([0-9]{2}).([0-9]{4})/","$3-$2-$1",$data);
	}
}