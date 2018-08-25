<?php

/**
 * Congky, 30/03/2016
 * file ini di gunakan untuk menambahkan validation message,
 * 
 **/

Validator::replacer('val_tenant', function($message, $attribute, $rule, $parameters) {

	$message = "The ".str_replace('_', ' ', snake_case($attribute))." is not a valid tenant.";	

	// Jika aplikasi anda multi bahasa
    if (App::isLocale('id')) {
    	// tambahkan pesan anda disini, tampung ke variable $message
    }

    return $message;

});

Validator::replacer('date_format', function($message, $attribute, $rule, $parameters) {

    $message = "The ".str_replace('_', ' ', snake_case($attribute))." is not a valid date.";
    
    // Jika aplikasi anda multi bahasa
    if (App::isLocale('id')) {
    	// tambahkan pesan anda disini, tampung ke variable $message
    }

    return $message;

});

Validator::replacer('datetime_format', function($message, $attribute, $rule, $parameters) {

    $message = "The ".str_replace('_', ' ', snake_case($attribute))." is not a valid datetime.";
    
    // Jika aplikasi anda multi bahasa
    if (App::isLocale('id')) {
    	// tambahkan pesan anda disini, tampung ke variable $message
    }

    return $message;

});