# SilverStripe Cookie Control #

GDPR EU cookie notice for SilverStripe.

### Requirements ###

SilverStripe 4
(for SilverStripe 3 use the "3" branche or the 1.* tags)

### Version ###

Using Semantic Versioning.

### Installation ###

Install via Composer:

composer require "hestec/silverstripe-cookiecontrol": "2.*"

### Configuration ###

Add this to your mysite.yml:
```
Hestec\CookieControl\CookieControl:
  PerformanceCookies: 'JSESSIONID'
  AnalyticsCookies: '_gid,_ga,_gat'
  MarketingCookies: 'SSID'
  CookieDomain: '.domain.com'
  ```

do a dev/build and flush.

### Usage ###

In your CMS Settings you will find a tab CookieControl where you can enable/disable the cookie notice bar and do some other settings like the link to you privacy policy page.

![connect](https://res.cloudinary.com/hestec/image/upload/v1530801213/silverstripe-cookiecontrol/settings.jpg)

### Issues ###

No known issues.

### Todo ###
