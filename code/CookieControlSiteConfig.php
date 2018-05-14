<?php

class CookieControlSiteConfig extends DataExtension {

    private static $db = array(
        'CcEnable' => 'Boolean',
        'CcTimeOut' => 'Int',
        'CcExpiration' => 'Int',
        'CcImplicit' => 'Boolean',
        'CcPerformance' => 'Boolean',
        'CcAnalytics' => 'Boolean',
        'CcMarketing' => 'Boolean'
    );

    private static $has_one = array(
        'CcStatement' => 'SiteTree'
    );

    public function updateCMSFields(FieldList $fields)
    {

        $EnableField = CheckboxField::create('CcEnable', _t("CookieControlSiteConfig.ENABLE", "Enable CookieControl"));
        $CcTimeOutField = NumericField::create('CcTimeOut', _t("CookieControlSiteConfig.TIMEOUT", "Time out (milli seconds)"));
        $CcTimeOutField->setDescription(_t("CookieControlSiteConfig.TIMEOUT_DESCRIPTION", "(Time until the cookie bar appears in milli seconds. Default 500, if you leave it empty or set 0, it will be 500 milli seconds.)"));
        $CcExpirationField = NumericField::create('CcExpiration', _t("CookieControlSiteConfig.EXPIRATION", "Expiration (days)"));
        $CcExpirationField->setDescription(_t("CookieControlSiteConfig.REMEMBER_DESCRIPTION", "(Remember choice for X days. Default 30 days, if you leave it empty or set 0, it will be 30 days.)"));
        $CcImplicitField = CheckboxField::create('CcImplicit', _t("CookieControlSiteConfig.ACCEPT_ON_SCROLL", "Accept cookies on scroll"));

        $CookieTypeHeaderField = HeaderField::create('CookieTypeHeaderField', _t("CookieControlSiteConfig.COOKIETYPE_HEADER", "Use CookieControl for this types of cookies"));

        $CcPerformanceField = CheckboxField::create('CcPerformance', _t("CookieControlSiteConfig.PERFORMANCE_COOKIES", "Performance cookies"));
        $CcAnalyticsField = CheckboxField::create('CcAnalytics', _t("CookieControlSiteConfig.ANALYTICS_COOKIES", "Analytics cookies"));
        $CcMarketingField = CheckboxField::create('CcMarketing', _t("CookieControlSiteConfig.MARKETING_COOKIES", "Marketing cookies"));

        $CcStatementField = TreeDropdownField::create('CcStatementID', _t("CookieBarSiteConfig.COOKIE_STATEMENTPAGE", "Cookie statement page"), 'SiteTree');

        $fields->addFieldsToTab("Root."._t("CookieControlSiteConfig.COOKIECONTROL", "CookieControl"), array(
            $EnableField,
            $CcTimeOutField,
            $CcExpirationField,
            $CcImplicitField,
            $CcStatementField,
            $CookieTypeHeaderField,
            $CcPerformanceField,
            $CcAnalyticsField,
            $CcMarketingField
        ));


    }

}