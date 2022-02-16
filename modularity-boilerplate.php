<?php

/**
 * Plugin Name:       {{BPREPLACENAME}}
 * Plugin URI:        https://github.com/{{BPREPLACEGITHUB}}/modularity-{{BPREPLACESLUG}}
 * Description:       {{BPREPLACEDESCRIPTION}}
 * Version:           1.0.0
 * Author:            {{BPREPLACEAUTHOR}}
 * Author URI:        https://github.com/{{BPREPLACEGITHUB}}
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       mod-{{BPREPLACESLUG}}
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('{{BPREPLACECAPSCONSTANT}}_PATH', plugin_dir_path(__FILE__));
define('{{BPREPLACECAPSCONSTANT}}_URL', plugins_url('', __FILE__));
define('{{BPREPLACECAPSCONSTANT}}_TEMPLATE_PATH', {{BPREPLACECAPSCONSTANT}}_PATH . 'templates/');
define('{{BPREPLACECAPSCONSTANT}}_VIEW_PATH', {{BPREPLACECAPSCONSTANT}}_PATH . 'views/');
define('{{BPREPLACECAPSCONSTANT}}_MODULE_VIEW_PATH', plugin_dir_path(__FILE__) . 'source/php/Module/views');
define('{{BPREPLACECAPSCONSTANT}}_MODULE_PATH', {{BPREPLACECAPSCONSTANT}}_PATH . 'source/php/Module/');

load_plugin_textdomain('modularity-{{BPREPLACESLUG}}', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once {{BPREPLACECAPSCONSTANT}}_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once {{BPREPLACECAPSCONSTANT}}_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new {{BPREPLACENAMESPACE}}\Vendor\Psr4ClassLoader();
$loader->addPrefix('{{BPREPLACENAMESPACE}}', {{BPREPLACECAPSCONSTANT}}_PATH);
$loader->addPrefix('{{BPREPLACENAMESPACE}}', {{BPREPLACECAPSCONSTANT}}_PATH . 'source/php/');
$loader->register();

// Acf auto import and export
$acfExportManager = new \AcfExportManager\AcfExportManager();
$acfExportManager->setTextdomain('modularity-{{BPREPLACESLUG}}');
$acfExportManager->setExportFolder({{BPREPLACECAPSCONSTANT}}_PATH . 'source/php/AcfFields/');
$acfExportManager->autoExport(array(
    '{{BPREPLACESLUG}}-module' => 'group_61ea7a87e8mmm', //Update with acf id here, module view
    '{{BPREPLACESLUG}}-settings' => 'group_61ea7a87e8nnn' //Update with acf id here, settings view
));
$acfExportManager->import();

// Modularity 3.0 ready - ViewPath for Component library
add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-{{BPREPLACESLUG}}'] = {{BPREPLACECAPSCONSTANT}}_MODULE_VIEW_PATH;
    return $arr;
}, 10, 3);

// Start application
new {{BPREPLACENAMESPACE}}\App();
