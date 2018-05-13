<?php

class CookieControlExtension extends Extension
{

    public function onAfterInit(){

        Requirements::css("cookiecontrol/css/style.css");

        $langfile = i18n::get_lang_from_locale(i18n::get_locale()).".js";
        /*if (file_exists("mysite/lang/cookiecontrol/".$langfile)){
            Requirements::javascript("mysite/lang/cookiecontrol/".$langfile);
        }
        elseif (file_exists("cookiecontrol/lang/".$langfile)){
            Requirements::javascript("cookiecontrol/lang/".$langfile);
        }*/
        Requirements::javascript("cookiecontrol/javascript/script.js");

        /*$docroot = realpath($_SERVER['DOCUMENT_ROOT']);
        $langfile = i18n::get_lang_from_locale(i18n::get_locale()).".js";
        if (file_exists($docroot."/mysite/lang/cookiecontrol/".$langfile)){
            Requirements::javascript("mysite/lang/cookiecontrol/".$langfile);
        }
        elseif (file_exists($docroot."/cookiecontrol/lang/".$langfile)){
            Requirements::javascript("cookiecontrol/lang/".$langfile);
        }*/
        if ($this->LangFile()){
            Requirements::javascript($this->LangFile());
        }

    }

    public function LangFile(){

        $docroot = realpath($_SERVER['DOCUMENT_ROOT']);
        $langfile = i18n::get_lang_from_locale(i18n::get_locale()).".js";
        if (file_exists($docroot."/mysite/lang/cookiecontrol/".$langfile)){
            //Requirements::javascript("mysite/lang/cookiecontrol/".$langfile);
            return "mysite/lang/cookiecontrol/".$langfile;
        }
        elseif (file_exists($docroot."/cookiecontrol/lang/".$langfile)){
            //Requirements::javascript("cookiecontrol/lang/".$langfile);
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

            $script = "<script>";
            $script .= "gdprCookieNotice({";
            $script .= "locale: '".$locale."',";
            $script .= "timeout: $timeout,";
            $script .= "expiration: $expiration,";
            //$script .= "domain: '" . $_SERVER['HTTP_HOST'] . "',";
            $script .= "domain: '.hst1.nl',";
            $script .= "statement: 'https://google.com',";
            $script .= "performace: ['JSESSIONID'],";
            $script .= "analytics: ['_gat', 'ga', '_ga'],";
            $script .= "marketing: ['SSID']";
            $script .= "});";
            $script .= "</script>";

            return $script;

        }

        return false;

    }

    public function CLang(){

        //return $this->owner->ContentLocale();
        //return i18n::get_lang_from_locale(i18n::get_locale());

        return realpath($_SERVER['DOCUMENT_ROOT']);

    }

}
