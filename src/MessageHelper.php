<?php
/**
 * Congky
 * Date: 3/28/16
 * Time: 09:04 PM
 *
 * Message Helper di gunakan untuk menyimpan error ke dalam session
 * dari sini kemudian error akan di olah lagi di packages/sts/pleaf-core/src/views/includes/field-messages.php atau packages/sts/pleaf-core/src/views/includes/messages.php
 *
 **/

namespace Sts\PleafCore;

use Session;

class MessageHelper {

    public static function displayError ($ex){

        if (get_class($ex) == _CORE_EXCEPTION) {

            $exception = $ex->getErrorList();
            $errorKey = $ex->getErrorKey();
            $error = [];

            if($errorKey==ERROR_DATA_VALIDATION) {
                foreach ($exception->getMessages() as $key => $value) {
                   foreach ($value as $message) {
                        $error_push = (object)[
                            "key" => $key,
                            "message" => $message
                        ];
                        array_push($error, $error_push);
                   }
                }
            } else if ($errorKey==ERROR_BUSINESS_VALIDATION) {
                foreach ($exception as $key => $value) {
                    $error_push = (object)[
                        "key" => $key,
                        "message" => $value
                    ];
                    array_push($error, $error_push);
                }
            }

            Session::flash('messages', (object)[
                            'status' => _RESPONSE_FAIL,
                            'errors' => $error
                        ]);
        }

    }

    public static function displaySuccess ($args){

        $message = '';

        if ($args == _DELETE_DATA) {
            $message = 'Data successfully deleted';
        } 
        else if ($args == _EDIT_DATA) {
            $message = 'Data successfully edited';
        }
        else if ($args == _ADD_DATA) {
            $message = 'Data successfully added';
        }
        else if ($args == _LOAD_DATA) {
            $message = 'Data successfully loaded';
        }

        if (!empty($message)) {
            Session::flash('messages', (object)[
                            'status' => _RESPONSE_OK,
                            'message' => $message
                        ]);
        }
    }
}