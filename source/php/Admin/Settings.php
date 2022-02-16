<?php

namespace {{BPREPLACENAMESPACE}}\Admin;

/**
 * Class RekAI
 * @package ModularityRecommend
 */
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
                'page_title'  => _x("RekAI", "ACF", 'modularity-recommend'),
                'menu_title'  => __("RekAI", "RekAI", 'modularity-recommend'),
                'menu_slug'   => 'modularity-recommend-settings',
                'parent_slug' => 'options-general.php',
                'capability'  => 'manage_options'
            ));
        }
    }
}
