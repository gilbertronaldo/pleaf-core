<?php
/**
 * Created by PhpStorm.
 * User: Ali Irawan
 * Modify by1: Oki Karso Aji
 * Modify by2: Widana Nur Azis
 * Date: 3/24/16
 * Modify Date: 4/18/16
 * Time: 12:30 PM
 */

namespace Sts\PleafCore;

class Response
{
    // LAST MODIFY @Response::ok()
    public static function ok($json){
        if(is_array($json)){
            $json["status"] = _RESPONSE_OK;

            return [
                "result" => $json
            ];
        }
    }

    // LAST MODIFY @Response::fail()
    public static function fail ($json){
        if(is_array($json)){

            $result['args'] = [];
            $result['errorKey'] = "";
            $result['errors'] = $json;

        } elseif (get_class($json) == _CORE_EXCEPTION) {

            if($json->getErrorKey() == ERROR_DATA_VALIDATION){

                $result["status"] = _RESPONSE_FAIL;
                $result["errorKey"] = $json->getErrorKey();
                $result["args"] = $json->getArgs();
                $result["errorList"] = $json->getErrorList();

            } elseif($json->getErrorKey() == ERROR_BUSINESS_VALIDATION) {

                $result["status"] = _RESPONSE_FAIL;
                $result["errorKey"] = $json->getErrorKey();
                $result["args"] = $json->getArgs();
                $result["errorList"] = $json->getErrorList();

            }
        }
        return [
            "result" => $result
        ];
    }

//        public static function ok ($json){
//        if(is_array($json)){
//            $json["status"] = _RESPONSE_OK;
//            return $json;
//        }
//    }

//    public static function fail ($json){
//        if(is_array($json)){
//
//            $result['args'] = [];
//            $result['errorKey'] = "";
//            $result['errors'] = $json;
//
//        } elseif (get_class($json) == _CORE_EXCEPTION) {
//
//            $result['args'] = $json->getArgs();
//            $result['errorKey'] = $json->getErrorKey();
//
//            $exception = $json->getErrorList();
//            $error =[];
//
//            foreach ($exception->getMessages() as $key => $value) {
//                foreach ($value as $message) {
//                    $error_push = (object)[
//                        "key" => $key,
//                        "message" => $message
//                    ];
//                    array_push($error, $error_push);
//                }
//            }
//
//            $result['errors'] = $error;
//
//        }
//
//        return $result;
//
//    }
}