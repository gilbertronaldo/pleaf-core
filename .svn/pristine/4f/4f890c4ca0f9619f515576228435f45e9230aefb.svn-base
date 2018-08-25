<?php

/**
 * Congky, 28 Maret 2016
 * Field Messages di pakai untuk menggenerate message error 
 * ke dalam bentuk jquery ( menggantikan @messages("onField") )
 * kemudian jquery akan menyisipkan pesan error di bawah masing2 field yang error
 *
 * REF : /packages/sts/pleaf-core/src/blade-extending.php
 *
 **/
$result= '';

if (Session::has('messages')) {

	$messages = Session::get("messages");
	$errorStatus = 	$messages->status;

	if ($errorStatus == _RESPONSE_FAIL) {

		$message = '';
	    foreach($messages->errors as $error) {

	    	$message = $message.'$("#'.$error->key.'").addClass("error").after(\'<i class="error-warning">'.$error->message.'</i>\');$("label[for=\''.$error->key.'\'").addClass("error");';

	    }

	    $result = '<script>$(document).ready(function(){'.$message.'});</script>';
	}
}

echo $result;