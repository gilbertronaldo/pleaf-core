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
         
        ${{ $varOutputIndex }}  = {{ $model }}::{!! $condition !!}first();
        
        if (count(${{ $varOutputIndex }}) == 0) {
            $errorList = [
               "data_{{ $varOutput }}" => "{{ $modelForMessage }} does not exists with {{ $bfType }} ".{!! $param !!}
            ];
            $this->errorBusinessValidation($errorList);
        }

        return [];
    }

    protected function rules() {

        return [];

    }

}