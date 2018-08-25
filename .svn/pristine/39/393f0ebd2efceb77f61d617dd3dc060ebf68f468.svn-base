<?php
/**
 * Created by PhpStorm.
 * User: sts
 * Date: 3/22/16
 * Time: 4:32 PM
 */

namespace Sts\PleafCore;
use Session;

class SessionUtil
{
    public static function getTenantId(){
        if(Session::has(_PLEAF_SESS_USERS)){
            return Session::get(_PLEAF_SESS_USERS)["tenant_id"];
        }
        return -1;
    }

    public static function getTenantKey(){
        if(Session::has(_PLEAF_SESS_USERS)){
            return Session::get(_PLEAF_SESS_USERS)["tenant_key"];
        }
        return -1;
    }

    public static function getUsername(){
        if(Session::has(_PLEAF_SESS_USERS)){
            return Session::get(_PLEAF_SESS_USERS)["username"];
        }
        return -99;
    }

    public static function getUserLoginId(){
        if(Session::has(_PLEAF_SESS_USERS)){
            return Session::get(_PLEAF_SESS_USERS)["user_id"];
        }
        return -99;
    }

    public static function getRoleLoginId(){
        if(Session::has(_PLEAF_SESS_USERS)){
            return Session::get(_PLEAF_SESS_USERS)["role_default_id"];
        }
        return -99;
    }
}