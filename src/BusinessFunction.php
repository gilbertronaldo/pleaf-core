<?php 

namespace Sts\PleafCore;

/**
 * @author Ali Irawan 
 */
interface BusinessFunction {
	
	public function getDescription();
	public function execute( $dto );
	
}