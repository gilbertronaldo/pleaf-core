<?php

namespace Sts\PleafCore;

/**
* DateUtil class
* 
* @author Ali Irawan
*/
class DateUtil {

	/**
	* Return current date time using format YYYYMMDDHHmmss 
	*/
	public static function dateTimeNow() {
		return date("YmdHis", time());
	}
	
	/**
	* Return current date using format YYYYMMDD
	*/
	public static function dateNow() {
		return date("Ymd", time());
	}
	
	public static function date2_display($date){
	
		return date('d-M-Y',strtotime($date));
	
	}
	
	public static function date2time($datestring, $format = "d/m/Y"){
		$array = date_parse_from_format($format, $datestring);
		return mktime(0,0,0,$array['month'], $array['day'], $array['year']);
	}
	
	/**
	* Parse date to date string
	*
	* @param unknown $datestring date string to be parsed
	* @param string $format format specified, see date() function manual
	*
	* @return will return date in string format YYYYMMDD
	*/
	public static function date2string($datestring, $format = "d/m/Y"){
		return date("Ymd", DateUtil::date2time($datestring, $format));
	}
}