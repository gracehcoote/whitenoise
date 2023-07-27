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
  'vaersaagod/matrixmate' => 
  array (
    'class' => 'vaersaagod\\matrixmate\\MatrixMate',
    'basePath' => $vendorDir . '/vaersaagod/matrixmate/src',
    'handle' => 'matrixmate',
    'aliases' => 
    array (
      '@vaersaagod/matrixmate' => $vendorDir . '/vaersaagod/matrixmate/src',
    ),
    'name' => 'MatrixMate',
    'version' => '2.1.3',
    'schemaVersion' => '1.0.0',
    'description' => 'Welding Matrix into shape, mate!',
    'developer' => 'Værsågod',
    'developerUrl' => 'https://vaersaagod.no',
    'documentationUrl' => 'https://github.com/vaersaagod/matrixmate/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/vaersaagod/matrixmate/master/CHANGELOG.md',
    'hasCpSettings' => false,
    'hasCpSection' => false,
  ),
  'verbb/smith' => 
  array (
    'class' => 'verbb\\smith\\Smith',
    'basePath' => $vendorDir . '/verbb/smith/src',
    'handle' => 'smith',
    'aliases' => 
    array (
      '@verbb/smith' => $vendorDir . '/verbb/smith/src',
    ),
    'name' => 'Smith',
    'version' => '2.0.0',
    'description' => 'Add copy, paste and clone functionality to Matrix blocks.',
    'developer' => 'Verbb',
    'developerUrl' => 'https://verbb.io',
    'developerEmail' => 'support@verbb.io',
    'documentationUrl' => 'https://github.com/verbb/smith',
    'changelogUrl' => 'https://raw.githubusercontent.com/verbb/smith/craft-4/CHANGELOG.md',
  ),
  'necoapps/craft-matrix-snap' => 
  array (
    'class' => 'necoapps\\matrixsnap\\MatrixSnap',
    'basePath' => $vendorDir . '/necoapps/craft-matrix-snap/src',
    'handle' => 'matrix-snap',
    'aliases' => 
    array (
      '@necoapps/matrixsnap' => $vendorDir . '/necoapps/craft-matrix-snap/src',
    ),
    'name' => 'Matrix Snap',
    'version' => '1.0.0',
    'description' => 'Collapses all Matrix blocks on entry load. Adds one-click block toggling.',
    'developer' => 'Necoapps',
    'developerUrl' => 'http://www.necoapps.com',
    'developerEmail' => 'help@necoapps.com',
    'documentationUrl' => 'https://github.com/necoapps/craft-matrix-snap/blob/main/README.md',
  ),
  'doublesecretagency/craft-cpcss' => 
  array (
    'class' => 'doublesecretagency\\cpcss\\CpCss',
    'basePath' => $vendorDir . '/doublesecretagency/craft-cpcss/src',
    'handle' => 'cp-css',
    'aliases' => 
    array (
      '@doublesecretagency/cpcss' => $vendorDir . '/doublesecretagency/craft-cpcss/src',
    ),
    'name' => 'Control Panel CSS',
    'version' => '2.6.0',
    'schemaVersion' => '2.0.0',
    'description' => 'Add custom CSS to your Control Panel.',
    'developer' => 'Double Secret Agency',
    'developerUrl' => 'https://www.doublesecretagency.com/plugins',
    'documentationUrl' => 'https://github.com/doublesecretagency/craft-cpcss/blob/v2/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/doublesecretagency/craft-cpcss/v2/CHANGELOG.md',
  ),
  'putyourlightson/craft-sprig' => 
  array (
    'class' => 'putyourlightson\\sprig\\plugin\\Sprig',
    'basePath' => $vendorDir . '/putyourlightson/craft-sprig/src',
    'handle' => 'sprig',
    'aliases' => 
    array (
      '@putyourlightson/sprig/plugin' => $vendorDir . '/putyourlightson/craft-sprig/src',
    ),
    'name' => 'Sprig',
    'version' => '2.6.2',
    'description' => 'A reactive Twig component framework for Craft.',
    'developer' => 'PutYourLightsOn',
    'developerUrl' => 'https://putyourlightson.com/',
    'documentationUrl' => 'https://putyourlightson.com/plugins/sprig',
    'changelogUrl' => 'https://raw.githubusercontent.com/putyourlightson/craft-sprig/v2/CHANGELOG.md',
  ),
  'solspace/craft-freeform' => 
  array (
    'class' => 'Solspace\\Freeform\\Freeform',
    'basePath' => $vendorDir . '/solspace/craft-freeform/packages/plugin/src',
    'handle' => 'freeform',
    'aliases' => 
    array (
      '@Solspace/Freeform' => $vendorDir . '/solspace/craft-freeform/packages/plugin/src',
      '@Solspace/Tests/Freeform' => $vendorDir . '/solspace/craft-freeform/packages/plugin/tests',
    ),
    'name' => 'Freeform',
    'version' => '4.1.6',
    'schemaVersion' => '4.2.6',
    'description' => 'Reliable form builder that\'s ready for wherever your project takes you.',
    'developer' => 'Solspace',
    'developerUrl' => 'https://docs.solspace.com/',
    'documentationUrl' => 'https://docs.solspace.com/craft/freeform/v4/',
    'changelogUrl' => 'https://raw.githubusercontent.com/solspace/craft-freeform/v4/CHANGELOG.md',
    'hasCpSection' => true,
  ),
);
