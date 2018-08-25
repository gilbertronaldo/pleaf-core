<?php

Blade::directive('messages', function($expression) {


	$expression = str_replace(['(',')',' ', '"', "'"], '', $expression);

	// @messages("onField") -> hanya untuk pesan error
	if ($expression == 'onField') {
		return "<?php include __DIR__.'/../../../vendor/sts/pleaf-core/src/views/includes/field-messages.php'; ?>";
	}
	// @messages -> untuk pesan error atau sukses
	else {
		return "<?php include __DIR__.'/../../../vendor/sts/pleaf-core/src/views/includes/messages.php'; ?>";
	}
});

// this use if authorize can multipel task ex: @authorize('taskname1,taskname2,taskname3')
Blade::directive('authorize',function($parameter){

	$param = str_replace(['(',')',' ', '"', "'"], '', $parameter);
	$param = explode(',', $param);
	$userId = Session::get(_PLEAF_SESS_USERS)["user_id"];
	$currentRole = Session::get(_PLEAF_CURRENT_ROLE);

	if($userId == -1) {
		$data = true;
	} else {

		$result = array_intersect($param, $currentRole);
		$data = !empty($result);
		 
	}
	return "<?php if ('$data'): ?>";
});

Blade::directive('endauthorize',function(){
	return "<?php endif; ?>";
});
		
// this use if authorize only single task ex: @authorize('taskname1')
/*
Blade::directive('authorize',function($parameter){

    $param = str_replace(['(',')',' ', '"', "'"], '', $parameter);
    $userId = Session::get(_PLEAF_SESS_USERS)["user_id"];
    $currentRole = Session::get(_PLEAF_CURRENT_ROLE);

    $data = (($userId == -1))? true : in_array($param,$currentRole)? true : false;
    return "<?php if ('$data'): ?>";
});
*/
