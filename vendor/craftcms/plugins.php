<?php

$vendorDir = dirname(__DIR__);
$rootDir = dirname(dirname(__DIR__));

return array (
  'verbb/cp-nav' => 
  array (
    'class' => 'verbb\\cpnav\\CpNav',
    'basePath' => $vendorDir . '/verbb/cp-nav/src',
    'handle' => 'cp-nav',
    'aliases' => 
    array (
      '@verbb/cpnav' => $vendorDir . '/verbb/cp-nav/src',
    ),
    'name' => 'Control Panel Nav',
    'version' => '4.0.10',
    'description' => 'Manage the Craft Control Panel navigation.',
    'developer' => 'Verbb',
    'developerUrl' => 'https://verbb.io',
    'developerEmail' => 'support@verbb.io',
    'documentationUrl' => 'https://github.com/verbb/cp-nav',
    'changelogUrl' => 'https://raw.githubusercontent.com/verbb/cp-nav/craft-4/CHANGELOG.md',
  ),
  'adigital/cookie-consent-banner' => 
  array (
    'class' => 'adigital\\cookieconsentbanner\\CookieConsentBanner',
    'basePath' => $vendorDir . '/adigital/cookie-consent-banner/src',
    'handle' => 'cookie-consent-banner',
    'aliases' => 
    array (
      '@adigital/cookieconsentbanner' => $vendorDir . '/adigital/cookie-consent-banner/src',
    ),
    'name' => 'Cookie Consent Banner',
    'version' => '2.0.0',
    'description' => 'Add a configurable cookie consent banner to the website.',
    'developer' => 'Mark @ A Digital',
    'developerUrl' => 'https://adigital.agency',
    'documentationUrl' => 'https://github.com/a-digital/cookie-consent-banner/blob/master/README.md',
    'changelogUrl' => 'https://github.com/a-digital/cookie-consent-banner/blob/master/CHANGELOG.md',
    'hasCpSettings' => true,
    'hasCpSection' => false,
  ),
  'nystudio107/craft-cookies' => 
  array (
    'class' => 'nystudio107\\cookies\\Cookies',
    'basePath' => $vendorDir . '/nystudio107/craft-cookies/src',
    'handle' => 'cookies',
    'aliases' => 
    array (
      '@nystudio107/cookies' => $vendorDir . '/nystudio107/craft-cookies/src',
    ),
    'name' => 'Cookies',
    'version' => '4.0.0',
    'description' => 'A simple plugin for setting and getting cookies from within Craft CMS templates.',
    'developer' => 'nystudio107',
    'developerUrl' => 'https://nystudio107.com/',
    'documentationUrl' => 'https://nystudio107.com/docs/cookies/',
  ),
  'craftcms/redactor' => 
  array (
    'class' => 'craft\\redactor\\Plugin',
    'basePath' => $vendorDir . '/craftcms/redactor/src',
    'handle' => 'redactor',
    'aliases' => 
    array (
      '@craft/redactor' => $vendorDir . '/craftcms/redactor/src',
    ),
    'name' => 'Redactor',
    'version' => '3.0.4',
    'description' => 'Edit rich text content in Craft CMS using Redactor by Imperavi.',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://github.com/craftcms/redactor/blob/v2/README.md',
  ),
  'carlcs/craft-redactorcustomstyles' => 
  array (
    'class' => 'carlcs\\redactorcustomstyles\\Plugin',
    'basePath' => $vendorDir . '/carlcs/craft-redactorcustomstyles/src',
    'handle' => 'redactor-custom-styles',
    'aliases' => 
    array (
      '@carlcs/redactorcustomstyles' => $vendorDir . '/carlcs/craft-redactorcustomstyles/src',
    ),
    'name' => 'Redactor Custom Styles',
    'version' => '4.0.3',
    'description' => 'Redactor Custom Styles plugin for Craft CMS',
    'developer' => 'carlcs',
    'developerUrl' => 'https://github.com/carlcs',
    'documentationUrl' => 'https://github.com/carlcs/craft-redactorcustomstyles',
  ),
);
