<?php

namespace {{BPREPLACENAMESPACE}}\Admin;

class Settings
{
    public function __construct() {
        add_action('acf/init', array($this, 'registerSettings'));
    }

    /**
     * Register settings
     * @return void
     */
    public function registerSettings()
    {
        if (function_exists('acf_add_options_sub_page')) {
            acf_add_options_sub_page(array(
                'page_title'  => __("{{BPREPLACENAME}}", 'modularity-{{BPREPLACESLUG}}'),
                'menu_title'  => __("{{BPREPLACENAME}} Settings", 'modularity-{{BPREPLACESLUG}}'),
                'menu_slug'   => 'modularity-{{BPREPLACESLUG}}-settings',
                'parent_slug' => 'options-general.php',
                'capability'  => 'manage_options'
            ));
        }
    }
}
