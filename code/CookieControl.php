<?php

class CookieControl
{

    public static function getCookies($type) {
        $config = Config::inst()->get('CookieControl', $type);
        return $config;
    }

    public static function getCookieDomain() {
        $config = Config::inst()->get('CookieControl', 'CookieDomain');
        return $config;
    }

}
