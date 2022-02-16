<?php

namespace {{BPREPLACENAMESPACE}};

use {{BPREPLACENAMESPACE}}\Helper\CacheBust;

class App
{
    public function __construct()
    {

        //Init subset
        new Admin\Settings();

        //Register module
        add_action('plugins_loaded', array($this, 'registerModule'));

        // Add view paths
        add_filter('Municipio/blade/view_paths', array($this, 'addViewPaths'), 1, 1);
    }

    /**
     * Register the module
     * @return void
     */
    public function registerModule()
    {
        if (function_exists('modularity_register_module')) {
            modularity_register_module(
                {{BPREPLACECAPSCONSTANT}}_MODULE_PATH,
                '{{BPREPLACESLUGCAMELCASE}}'
            );
        }
    }

    /**
     * Add searchable blade template paths
     * @param array  $array Template paths
     * @return array        Modified template paths
     */
    public function addViewPaths($array)
    {
        // If child theme is active, insert plugin view path after child views path.
        if (is_child_theme()) {
            array_splice($array, 2, 0, array({{BPREPLACECAPSCONSTANT}}_VIEW_PATH));
        } else {
            // Add view path first in the list if child theme is not active.
            array_unshift($array, {{BPREPLACECAPSCONSTANT}}_VIEW_PATH);
        }

        return $array;
    }
}
