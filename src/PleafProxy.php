<?php
/**
 * Created by PhpStorm.
 * @author: Widana Nur Azis <widananurazis@gmail.com>
 * Date: 18/04/16
 * Time: 11:52
 */

namespace Sts\PleafCore;
use Sts\PleafCore;

class PleafProxy {

    public function pleaf_proxy($payload){

        return [
            "header" => [
                "sessionId" => md5(time()),
                "userLoginId" => SessionUtil::getUserLoginId(),
                "roleLoginId" => SessionUtil::getRoleLoginId(),
                "tenantLoginId" => SessionUtil::getTenantId(),
                "tenantKey" => SessionUtil::getTenantKey(),
                "secureKey" => md5(time()),
                "datetime"  => DateUtil::dateTimeNow(),
                "taskName" => "taskName",
                "serviceName"   => "serviceName",
                "http_remoteAddr" => _REMOTE_ADDR,
                "http_remoteHost"  => _REMOTE_HOST,
                "http_userAgent"    => _USER_AGENT,
                "http_remoteUser" => _REMOTE_USER
            ],
            "payload" => $payload
        ];

    }

}