<?php

class CookieControlExtension extends Extension
{

    public function onAfterInit(){

        Requirements::css("cookiecontrol/css/style.css");
        //Requirements::javascript("cookiecontrol/javascript/script.min.js");

        //Requirements::javascript("cookiecontrol/javascript/js.cookie.js");
        //Requirements::javascript("cookiecontrol/javascript/script.js");
        //Requirements::javascript("cookiecontrol/javascript/templates.js");
        //Requirements::javascript("cookiecontrol/lang/en.js");

        Requirements::combine_files(
            'cookiecontrol.js',
            [
                'cookiecontrol/javascript/js.cookie.js',
                'cookiecontrol/javascript/script.js',
                'cookiecontrol/javascript/templates.js',
                'cookiecontrol/lang/en.js'
            ]
        );

        if ($this->LangFile()){
            Requirements::javascript($this->LangFile());
        }

        // cookies are removed by javascript, this is just a test for doing it by php
        //Cookie::force_expiry('_ga', '', '.hst1.nl');

    }

    public function LangFile(){

        $docroot = realpath($_SERVER['DOCUMENT_ROOT']);
        $langfile = i18n::get_lang_from_locale(i18n::get_locale()).".js";
        if (file_exists($docroot."/mysite/lang/cookiecontrol/".$langfile)){
            return "mysite/lang/cookiecontrol/".$langfile;
        }
        elseif (file_exists($docroot."/cookiecontrol/lang/".$langfile)){
            return "cookiecontrol/lang/".$langfile;
        }
        return false;

    }

    public function CookieControl(){

        $siteConfig = SiteConfig::current_site_config();
        if ($siteConfig->CcEnable) {

            $expiration = 30;
            if ($siteConfig->CcExpiration <> $expiration && $siteConfig->CcExpiration > 0) {
                $expiration = $siteConfig->CcExpiration;
            }

            $timeout = 500;
            if ($siteConfig->CcTimeOut <> $timeout && $siteConfig->CcTimeOut > 0) {
                $timeout = $siteConfig->CcTimeOut;
            }
            $locale = "en";
            if ($this->LangFile()){
                $locale = i18n::get_lang_from_locale(i18n::get_locale());
            }
            $implicit = "false";
            if ($siteConfig->CcImplicit == true) {
                $implicit = "true";
            }

            $script = "<script>";
            $script .= "gdprCookieNotice({";
            $script .= "locale: '".$locale."',";
            $script .= "timeout: $timeout,";
            $script .= "expiration: $expiration,";
            //$script .= "domain: '" . $_SERVER['HTTP_HOST'] . "',";
            $script .= "domain: '".CookieControl::getCookieDomain()."',";
            //$script .= "implicit: $implicit,";
            $script .= "statement: '".$siteConfig->CcStatement()->AbsoluteLink()."',";
            if ($siteConfig->CcPerformance == true){
                $script .= "performance: [".CookieControl::getCookies('PerformanceCookies')."],";
            }
            if ($siteConfig->CcAnalytics == true) {
                $script .= "analytics: [" . CookieControl::getCookies('AnalyticsCookies') . "],";
            }
            if ($siteConfig->CcMarketing == true) {
                $script .= "marketing: [" . CookieControl::getCookies('MarketingCookies') . "]";
            }
            $script .= "});";
            $script .= "</script>";

            return $script;

        }

        return false;

    }

}
