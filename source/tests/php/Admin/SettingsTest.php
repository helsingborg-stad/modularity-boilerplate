<?php

namespace {{BPREPLACENAMESPACE}}\Admin;

use {{BPREPLACENAMESPACE}}\Admin\Settings;

use Brain\Monkey\Functions;
use Mockery;

class SettingsTest extends \PluginTestCase\PluginTestCase
{
    public function testAddHooks()
    {
        new Settings();

        self::assertNotFalse(has_action('acf/init', '{{BPREPLACENAMESPACE}}\Admin\Settings->registerSettings()'));
    }

    public function testRegisterSettings()
    {
        Functions\expect('acf_add_options_sub_page')->once()->with(
            array(
                'page_title'  => __("{{BPREPLACENAME}}", 'modularity-{{BPREPLACESLUG}}'),
                'menu_title'  => __("{{BPREPLACENAME}} Settings", 'modularity-{{BPREPLACESLUG}}'),
                'menu_slug'   => 'modularity-{{BPREPLACESLUG}}-settings',
                'parent_slug' => 'options-general.php',
                'capability'  => 'manage_options'
            )
        );

        $settings = new Settings();

        $settings->registerSettings();
    }
}
