<?php
/**
 * Oki Karso Aji
 * Date: 3/24/16
 * Time: 12:30 PM
 */

namespace Sts\PleafCore;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Sts\PleafCore\CoreExceptions;
use Exception;
use TestCase;
use DB;

class TransactionalTestCase extends TestCase
{

    public function transact($function){

		DB::transaction(function() use ($function) {

			echo "\n";
			echo "/**\n * TRANSACTIONAL TEST CASE\n * PLEAF CORE\n *\n *\n * TEST ".$this->getName()."()\n * ".date('l, j F Y h:i:s A')."\n **/";
			echo "\r\n\n";
			
			try {
				$function();
				DB::rollback();
			}
			catch(CoreException $ex) {
				echo "<====================== CORE EXCEPTION =====================>";
				echo "\r\n\n";

				$exception = $ex->getErrorList();
            	$errorKey = $ex->getErrorKey();

				if($errorKey==ERROR_DATA_VALIDATION) {
	                foreach ($exception->getMessages() as $key => $value) {
	                   foreach ($value as $message) {
	                        echo $key." : ".$message."\r\n";
	                   }
	                }
	            } else if ($errorKey==ERROR_BUSINESS_VALIDATION) {
	                foreach ($exception as $key => $value) {
	                    echo $key." : ".$value."\r\n";
	                }
	            }
				echo "\r\n\n";
				echo "<==================== END CORE EXCEPTION ===================>";
				echo "\r\n\n";
				DB::rollback();

				$throwException = (object)[
					"error_key" => $errorKey,
					"error_message" => $exception
				];

				throw new CoreException(ERROR_TEST_VALIDATION, [], $throwException);
			}

		});
		
	}

	public function assertFail($args="") {
		$this->fail($args);
	}

	public function assertException($ex, $expected) {

		$exception = $ex->getErrorList();
		$error = [];
		if ($exception->error_key == ERROR_DATA_VALIDATION) {
			foreach ($exception->error_message->getMessages() as $key => $value) {
	           foreach ($value as $message) {
	                
	                $error[$key] = $message;

	           }
        	}
		} else if ($exception->error_key==ERROR_BUSINESS_VALIDATION) {
			$error = $exception->error_message;
		}

		$this->assertEquals($error, $expected);
	}
}