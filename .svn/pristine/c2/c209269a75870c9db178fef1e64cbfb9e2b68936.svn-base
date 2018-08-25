namespace {{ $namespace }};

use Sts\PleafCore\BusinessFunction;
use DB;
use Log;

/**
 * 
 * @in
 *
 * @out
 */
class {{ $name }} implements BusinessFunction {

    public function getDescription(){
    	return "change here";
    }

    public function execute($dto){
    	 
    	 $list  = DB::select("SQL goes here");
    	 
         return [
    	 	"tenant_list" => $list
    	 ];
    }
}