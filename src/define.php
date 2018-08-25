<?php

IF (!defined("_PLEAF_COMMANDS")) define("_PLEAF_COMMANDS", ".pleaf-commands");

// Response constants
IF (!defined("_RESPONSE_OK")) define("_RESPONSE_OK","OK");
IF (!defined("_RESPONSE_FAIL")) define("_RESPONSE_FAIL","FAIL");

// General Constants
IF (!defined("_YES")) define("_YES","Y");
IF (!defined("_NO")) define("_NO","N");
IF (!defined("_NULL_LONG")) define("_NULL_LONG",-99);
IF (!defined("_REF_DOC_TYPE_ID")) define("_REF_DOC_TYPE_ID",811);
IF (!defined("_PATH")) define("_PATH","img/attachment/");
IF (!defined("_EMPTY_VALUE")) define("_EMPTY_VALUE","");
IF (!defined("_SPACE_VALUE")) define("_SPACE_VALUE"," ");

// SESSION KEYS
IF (!defined("_PLEAF_SESS_USERS")) define("_PLEAF_SESS_USERS","sessUser");
IF (!defined("_PLEAF_ALLOWED_TASK")) define("_PLEAF_ALLOWED_TASK","allowedTask");
IF (!defined("_PLEAF_CURRENT_ROLE")) define("_PLEAF_CURRENT_ROLE","currentRole");
IF (!defined("_PLEAF_SET_CURRENT_ROLE")) define("_PLEAF_SET_CURRENT_ROLE","setCurrentRole");
IF (!defined("_PLEAF_SESS_ERRORS")) define("_PLEAF_SESS_ERRORS","_PLEAF_SESS_ERRORS");

// VALIDATION
IF (!defined("ERROR_DATA_VALIDATION")) define("ERROR_DATA_VALIDATION","Error Data Validation");

IF (!defined("ERROR_BUSINESS_VALIDATION")) define("ERROR_BUSINESS_VALIDATION","Error Business Validation");

IF (!defined("ERROR_TEST_VALIDATION")) define("ERROR_TEST_VALIDATION","Error Test Validation");

IF (!defined("_CORE_EXCEPTION")) define("_CORE_EXCEPTION","Sts\PleafCore\CoreException");
IF (!defined("_DELETE_DATA")) define("_DELETE_DATA","DELETE_DATA");
IF (!defined("_EDIT_DATA")) define("_EDIT_DATA","EDIT_DATA");
IF (!defined("_ADD_DATA")) define("_ADD_DATA","ADD_DATA");
IF (!defined("_LOAD_DATA")) define("_LOAD_DATA","LOAD_DATA");

//COOKIE KEYS
IF (!defined("_PLEAF_COOKIE_USERS")) define("_PLEAF_COOKIE_USERS","user_cookie");

//HOST
IF (!defined("_SERVER_URL")) define("_SERVER_URL","http://192.168.0.129:8000");


// HEADER
IF (!defined("_REMOTE_ADDR")) define("_REMOTE_ADDR", (getenv("REMOTE_ADDR"))? getenv("REMOTE_ADDR")
    :isset($_SERVER["REMOTE_ADDR"])? $_SERVER["REMOTE_ADDR"] : NULL);
IF (!defined("_REMOTE_HOST")) define("_REMOTE_HOST",(isset($_SERVER["REMOTE_ADDR"])? $_SERVER["REMOTE_ADDR"] : NULL));
IF (!defined("_USER_AGENT")) define("_USER_AGENT",(getenv("HTTP_USER_AGENT")? getenv("HTTP_USER_AGENT") :
        isset($_SERVER["HTTP_USER_AGENT"])? $_SERVER["HTTP_USER_AGENT"] : NULL));
IF (!defined("_REMOTE_USER")) define("_REMOTE_USER",NULL);