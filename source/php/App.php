<?php

namespace ModularityRecommend;

use ModularityRecommend\Helper\CacheBust;

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

        //Add global rek ai script
        add_action('wp_enqueue_scripts', array($this, 'registerRekAIScript'));

        //Add warning
        add_action('admin_head', array($this, 'addUndefinedWarning'));

        //Head
        add_action('wp_head', array($this, 'printMetaTag'));

        //Remove rek ai field, if not enabled
        add_filter("acf/prepare_field/name=rekai_number_of_recommendation", array($this, 'hideRekAIField'));
    }

    public function hideRekAIField($field) {
        if (get_field('rekai_enable', 'options') == false) {
            return false;
        }
        return $field;
    }

    /**
     * Console log undefined warning
     * @return void
     */
    public function addUndefinedWarning() {
        if (get_field('rekai_enable', 'options') && empty(get_field('rekai_script_url', 'option'))) {
            echo '
                <script>
                    console.log("RekAI script url is not defined. Please fill it out in the settings tab or disable rekai recommendations.");
                </script>
            ';
        }
    }

    /**
     * Public meta tag. Enables indexing.
     */
    public function printMetaTag()
    {
        echo '<meta name="rek_viewclick" />' . "\n";
    }

    /**
     * Enqueue script
     */
    public function registerRekAIScript()
    {
        $scriptUrl = get_field('rekai_script_url', 'option');

        if ($scriptUrl) {
            wp_register_script(
                'modularity-recommend-stats',
                $scriptUrl,
                null,
                '1.0.0'
            );
            wp_enqueue_script('modularity-recommend-stats');
        }
    }

    /**
     * Register the module
     * @return void
     */
    public function registerModule()
    {
        if (function_exists('modularity_register_module')) {
            modularity_register_module(
                MODULARITYRECOMMEND_MODULE_PATH,
                'Recommend'
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
            array_splice($array, 2, 0, array(MODULARITYRECOMMEND_VIEW_PATH));
        } else {
            // Add view path first in the list if child theme is not active.
            array_unshift($array, MODULARITYRECOMMEND_VIEW_PATH);
        }

        return $array;
    }
}
