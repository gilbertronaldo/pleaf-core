<?php

/**
 * Congky, 28 Maret 2016
 * Messages di pakai untuk menggenerate message error / message success
 * kemudian akan di tampilkan saat memanggil @messages
 *
 * REF : /packages/sts/pleaf-core/src/blade-extending.php
 *
 **/

$result= '';

if (Session::has('messages')) {

	$messages = Session::get("messages");
	$errorStatus = 	$messages->status;

	if ($errorStatus == _RESPONSE_OK) {

		$message = $messages->message;

	    $result = '	<div class="alert alert-success">
               			<ul>
                    		<li>'.$message.'</li>
                		</ul>
            		</div>';
	} 
	
	else if ($errorStatus == _RESPONSE_FAIL) {

		$message = '';
	    foreach($messages->errors as $error) {

	    	$message = $message.'<li>'.$error->message.'</li>';

	    }

	    $result = '	<div class="alert alert-danger">
               			<ul>
                    		'.$message.'
                		</ul>
            		</div>';
	}
}

echo $result;