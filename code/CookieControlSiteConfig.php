<?php

class CookieControlSiteConfig extends DataExtension {

    private static $db = array(
        'CcEnable' => 'Boolean',
        'CcTimeOut' => 'Int',
        'CcExpiration' => 'Int',
        'CcImplicit' => 'Boolean'
    );

    private static $has_one = array(
        'CcStatement' => 'SiteTree'
    );

    public function updateCMSFields(FieldList $fields)
    {

        /*$ForceLangSource = array(
            'ca' => _t("CookieBarSiteConfig.CATALAN", "Catalan"),
            'cz' => _t("CookieBarSiteConfig.CZECH", "Czech"),
            'da' => _t("CookieBarSiteConfig.DANISCH", "Danisch"),
            'nl' => _t("CookieBarSiteConfig.DUTCH", "Dutch"),
            'en' => _t("CookieBarSiteConfig.ENGLISH", "English"),
            'fr' => _t("CookieBarSiteConfig.FRENCH", "French"),
            'de' => _t("CookieBarSiteConfig.GERMAN", "German"),
            'hu' => _t("CookieBarSiteConfig.HUNGARIAN", "Hungarian"),
            'it' => _t("CookieBarSiteConfig.ITALIAN", "Italian"),
            'es' => _t("CookieBarSiteConfig.SPANISH", "Spanish"),
            'pl' => _t("CookieBarSiteConfig.POLISH", "Polish"),
            'po' => _t("CookieBarSiteConfig.PORTUGUESE", "Portuguese"),
            'ro' => _t("CookieBarSiteConfig.ROMANIAN", "Romanian"),
            'ru' => _t("CookieBarSiteConfig.RUSSIAN", "Russian"),
            'sk' => _t("CookieBarSiteConfig.SLOVAK", "Slovak"),
            'sl' => _t("CookieBarSiteConfig.SLOVENIAN", "Slovenian"),
            'se' => _t("CookieBarSiteConfig.SWEDISH", "Swedish")
        );

        $ThemeSource = array(
            'altblack' => _t("CookieBarSiteConfig.ALTERNATIVE_BLACK", "Alternative black"),
            'flying' => _t("CookieBarSiteConfig.FLYINGBAR", "FlyingBAR"),
            'grey' => _t("CookieBarSiteConfig.PLAIN_GREY", "Plain grey"),
            'white' => _t("CookieBarSiteConfig.THICK_WHITE", "Thick white")
        );*/

        //$SiteTreeSource = SiteTree::class;

        $EnableField = CheckboxField::create('CcEnable', _t("CookieControlSiteConfig.ENABLE", "Enable CookieControl"));
        $CcExpirationField = NumericField::create('CcExpiration', _t("CookieControlSiteConfig.REMEMBER", "Remember choice for X days"));
        $CcExpirationField->setDescription(_t("CookieControlSiteConfig.REMEMBER_DESCRIPTION", "(default 30 days, if you leave it empty or set 0, it will be 30 days)"));
        //$PrivacyPageField = TreeDropdownField::create('CbPrivacyPageID', _t("CookieBarSiteConfig.PRIVACYPAGE", "PrivacyPage"), $SiteTreeSource);

        $fields->addFieldsToTab("Root."._t("CookieControlSiteConfig.COOKIECONTROL", "CookieControl"), array(
            $EnableField,
            $CcExpirationField
        ));


    }

    public function CbOptions(){

        $array = array();

        if ($this->owner->CbTracking){
            $array['tracking'] = 1;
        }
        if ($this->owner->CbThirdParty){
            $array['thirdparty'] = 1;
        }
        if ($this->owner->CbAlways){
            $array['always'] = 1;
        }
        if ($this->owner->CbNoGeoIp){
            $array['noGeoIp'] = 1;
        }
        if ($this->owner->CbScrolling){
            $array['scrolling'] = 1;
        }
        if ($this->owner->CbRefreshPage){
            $array['refreshPage'] = 1;
        }
        if ($this->owner->CbTop){
            $array['top'] = 1;
        }
        if ($this->owner->CbShowNoConsent){
            $array['showNoConsent'] = 1;
        }
        if ($this->owner->CbHideDetailsBtn){
            $array['hideDetailsBtn'] = 1;
        }
        if ($this->owner->CbBlocking){
            $array['blocking'] = 1;
        }
        if ($this->owner->CbRemember <> 30 && $this->owner->CbRemember > 0){
            $array['remember'] = $this->owner->CbRemember;
        }
        if ($this->owner->CbTheme){
            $array['theme'] = $this->owner->CbTheme;
        }
        if ($this->owner->CbForceLang){
            $array['forceLang'] = $this->owner->CbForceLang;
        }
        if ($this->owner->CbPrivacyPageID){
            $array['privacyPage'] = $this->owner->CbPrivacyPage()->AbsoluteLink();
        }

        return $array;

    }

}