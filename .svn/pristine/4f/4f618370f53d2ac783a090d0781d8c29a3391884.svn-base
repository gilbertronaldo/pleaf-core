<?php
/**
 * @author Congky, 2016-03-29
 * custom-validation-rules.php di gunakan untuk mendaftarkan / membuat rules 
 * yang bisa di gunakan untuk validasi inputan
 *
 **/

/**
 * rule date_format
 * contoh penggunaan rule : ["date" => "date_format"]
 * true : 20160304
 * false : 2016-03-04
 * 
 **/
Validator::extend('date_format', function($attribute, $value, $parameters, $validator) {

	$result = false; 

	if(isset($value) && strlen($value) == 8 && DateTime::createFromFormat('Ymd', $value)) {

		$y = substr( $value, 0, 4 );
        $m = substr( $value, 4, 2 );
        $d = substr( $value, 6, 2 );

        if (checkdate( $m, $d, $y )) {
        	$result = true; 
        } else {
        	$result = false; 
        }

	} else {
		$result = false; 
	}

	return $result;

});


/**
 * rule datetime_format
 * contoh penggunaan rule : ["datetime" => "datetime_format"]
 * true : 20160304102107
 * false : 2016-03-04 10:21:07
 * 
 **/
Validator::extend('datetime_format', function($attribute, $value, $parameters, $validator) {

	$result = false; 

	$format = 'YmdHis';
    $datetime_format = DateTime::createFromFormat($format, $value);

    if(isset($value) && strlen($value) == 14 && $datetime_format && $datetime_format->format($format) == $value) {

    	$result = true; 

    } else {
    	$result = false; 
    }

    return $result;

});

/**
 * rule val_tenant
 * contoh penggunaan rule : ["tenant_id" => "val_tenant"]
 * true : 10
 * false : -1
 * 
 **/
Validator::extend('val_tenant', function($attribute, $value, $parameters, $validator) {

    return (is_int((int)$value) && $value >= 1);

});