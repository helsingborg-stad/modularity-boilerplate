<?php

// Get around direct access blockers.
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/../../../');
}

define('{{BPREPLACECAPSCONSTANT}}_PATH', __DIR__ . '/../../../');
define('{{BPREPLACECAPSCONSTANT}}_URL', 'https://example.com/wp-content/plugins/' . 'modularity-{{BPREPLACESLUG}}');
define('{{BPREPLACECAPSCONSTANT}}_TEMPLATE_PATH', {{BPREPLACECAPSCONSTANT}}_PATH . 'templates/');
define('{{BPREPLACECAPSCONSTANT}}_VIEW_PATH', {{BPREPLACECAPSCONSTANT}}_PATH . 'views/');
define('{{BPREPLACECAPSCONSTANT}}_MODULE_VIEW_PATH', {{BPREPLACECAPSCONSTANT}}_PATH . 'source/php/Module/views');
define('{{BPREPLACECAPSCONSTANT}}_MODULE_PATH', {{BPREPLACECAPSCONSTANT}}_PATH . 'source/php/Module/');

// Register the autoloader
$loader = require __DIR__ . '/../../../vendor/autoload.php';
$loader->addPsr4('{{BPREPLACENAMESPACE}}\\Test\\', __DIR__ . '/../php/');

require_once __DIR__ . '/PluginTestCase.php';
