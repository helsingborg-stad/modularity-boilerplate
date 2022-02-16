<?php

use ComponentLibrary\Init as ComponentLibraryInit;

if (!function_exists('modularity_{{BPREPLACESLUG}}_render_blade_view')) {
    function modularity_{{BPREPLACESLUG}}_render_blade_view($view, $data = [], $compress = true)
    {
        $init = new ComponentLibraryInit([
            {{BPREPLACECAPSCONSTANT}}_MODULE_VIEW_PATH
        ]);

        $bladeEngine = $init->getEngine();

        try {
            $markup = $bladeEngine->make(
                $view,
                array_merge(
                    $data,
                    array('errorMessage' => false)
                )
            )->render();
        } catch (\Throwable $e) {
            $markup .= '<pre style="border: 3px solid #f00; padding: 10px;">';
            $markup .= '<strong>' . $e->getMessage() . '</strong>';
            $markup .= '<hr style="background: #000; outline: none; border:none; display: block; height: 1px;"/>';
            $markup .= $e->getTraceAsString();
            $markup .= '</pre>';
        }

        if ($compress == true) {
            $replacements = array(
              ["~<!--(.*?)-->~s", ""],
              ["/\r|\n/", ""],
              ["!\s+!", " "]
            );

            foreach ($replacements as $replacement) {
                $markup = preg_replace($replacement[0], $replacement[1], $markup);
            }

            return $markup;
        }

        return $markup;
    }
}
