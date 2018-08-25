namespace {{ $namespace }};

use Sts\PleafCore\BusinessFunction;
use Sts\PleafCore\DefaultBusinessFunction;
use DB;
use Log;

/**
 * @author {{ $author }}, {{ $date }}
 * @in
 *
 * @out
 */
class {{ $name }} extends DefaultBusinessFunction implements BusinessFunction {

    public function getDescription(){
        return "write description here";
    }

    public function process($dto){

        {!! $paramKeyValue !!}

        $result = [];
         
        ${{ $varOutputIndex }}  = {{ $model }}::{!! $condition !!}first();
        
        $isExists = false;
        if (!is_null(${{ $varOutputIndex }})) {
            $isExists = true;
            $result = ["{{ $varOutput }}_list" => ${{ $varOutputIndex }}];
        }

        $result = ["exists"=>$isExists];

        return $result;
    }

    protected function rules() {

        return [];

    }

}