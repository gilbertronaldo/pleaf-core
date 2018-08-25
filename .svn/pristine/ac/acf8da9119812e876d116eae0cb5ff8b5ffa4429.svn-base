namespace {{ $namespace }};

use Sts\PleafCore as PleafCore;
use Sts\PleafCore\BusinessTransaction;
use Sts\PleafCore\DefaultBusinessTransaction;
use Log;

/**
* @author
* @in
*
* @out
*/

class {{ $name }} extends DefaultBusinessTransaction implements BusinessTransaction {

    public function getDescription(){
    	return "changes here";
    }

    public function prepare ($dto, $originalDto){
        // Add Validation Business

    }
    
	public function process ($dto, $originalDto){
		
        // Put your code here		

	}

    protected function rules(){
        //  Add Validation Data
        return [
                "code" => "required|val_tenant"
            ];

    }
}