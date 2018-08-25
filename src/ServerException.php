<?php
/**
 * Created by PhpStorm.
 * User: sts
 * Date: 3/25/16
 * Time: 10:31 AM
 */

namespace Sts\PleafCore;


class ServerException extends Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}