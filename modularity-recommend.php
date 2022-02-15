<?php

/**
 * Plugin Name:       Modularity Recommend
 * Plugin URI:        https://github.com/helsingborg-stad/modularity-recommend
 * Description:       Display Recommended links, static or AI generated links from RekAI.
 * Version:           1.0.0
 * Author:            Sebastian Thulin
 * Author URI:        https://github.com/sebastianthulin
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       mod-recommend
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('MODULARITYRECOMMEND_PATH', plugin_dir_path(__FILE__));
define('MODULARITYRECOMMEND_URL', plugins_url('', __FILE__));
define('MODULARITYRECOMMEND_TEMPLATE_PATH', MODULARITYRECOMMEND_PATH . 'templates/');
define('MODULARITYRECOMMEND_VIEW_PATH', MODULARITYRECOMMEND_PATH . 'views/');
define('MODULARITYRECOMMEND_MODULE_VIEW_PATH', plugin_dir_path(__FILE__) . 'source/php/Module/views');
define('MODULARITYRECOMMEND_MODULE_PATH', MODULARITYRECOMMEND_PATH . 'source/php/Module/');

load_plugin_textdomain('modularity-recommend', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once MODULARITYRECOMMEND_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once MODULARITYRECOMMEND_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new ModularityRecommend\Vendor\Psr4ClassLoader();
$loader->addPrefix('ModularityRecommend', MODULARITYRECOMMEND_PATH);
$loader->addPrefix('ModularityRecommend', MODULARITYRECOMMEND_PATH . 'source/php/');
$loader->register();

// Acf auto import and export
$acfExportManager = new \AcfExportManager\AcfExportManager();
$acfExportManager->setTextdomain('modularity-recommend');
$acfExportManager->setExportFolder(MODULARITYRECOMMEND_PATH . 'source/php/AcfFields/');
$acfExportManager->autoExport(array(
    'recommended' => 'group_61ea7a87e8e9f',
    'settings' => 'group_61eaa5feb2601',
));
$acfExportManager->import();

// Modularity 3.0 ready - ViewPath for Component library
add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-recommend'] = MODULARITYRECOMMEND_MODULE_VIEW_PATH;
    return $arr;
}, 10, 3);

// Start application
new ModularityRecommend\App();
