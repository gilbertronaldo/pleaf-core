<?php

namespace Sts\PleafCore;

use Sts\PleafCore\BusinessFunction;
use Validator;

/**
 * Congky, 29/03/2016
 * Default Business Function
 * 
 **/

abstract class DefaultBusinessFunction implements BusinessFunction {
	abstract protected function process( $dto );

	public function execute($dto){

		$validator = Validator::make($dto, $this->rules());

		if ($validator->fails()) {
			throw new CoreException(ERROR_DATA_VALIDATION, [], $validator->errors());
		}

		return $this->process($dto);
		
	}

	protected function rules() {
		return [];
	}

	protected function errorBusinessValidation($errorList=[]) {
		throw new CoreException(ERROR_BUSINESS_VALIDATION, [], $errorList);
	}
}