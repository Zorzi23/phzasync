<?php

namespace Http;

class ServerSecurityChecker {

    /**
     * 
     * @return bool
     */
    public static function isHttpsRequest() {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }

    /**
     * 
     * @return bool
     */
    public static function isValidSslCertificate() {
        return isset($_SERVER['SSL_CIPHER']);
    }

    /**
     * 
     * @return bool
     */
    public static function isRequestInternal() {
        return self::isHttpsRequest() && self::isValidSslCertificate();
    }

}