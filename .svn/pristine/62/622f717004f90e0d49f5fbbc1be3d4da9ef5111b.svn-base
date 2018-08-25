<?php

namespace Sts\PleafCore;
use Exception;

class CoreException extends Exception {

	private $errorKey;
	private $args;
	private $errorList;

	public function __construct($errorKey, $args = array() , $errorList = array()){
		$this->errorKey = $errorKey;
		$this->args = $args;
		$this->errorList = $errorList;
	}

	public function getErrorKey(){
		return $this->errorKey;
	}

	public function getArgs(){
		return $this->args;
	}

	public function getErrorList(){
		return $this->errorList;
	}
}