<?php

namespace {{BPREPLACENAMESPACE}}\Module;

use ModularityRecommend\Helper\CacheBust;

/**
 * Class Recommend
 * @package Recommend\Module
 */
class Recommend extends \Modularity\Module
{
    public $slug = 'recommend';
    public $supports = array();

    public function init()
    {
        $this->nameSingular = __("Recommend", 'modularity-recommend');
        $this->namePlural = __("Recommend", 'modularity-recommend');
        $this->description = __("Recommend view for links.", 'modularity-recommend');
    }

    /**
     * Data array
     * @return array $data
     */
    public function data(): array
    {
        $data = array();

        //Append field config
        $data = array_merge($data, (array) \Modularity\Helper\FormatObject::camelCase(
            get_fields($this->ID)
        ));

        //Translations
        $data['lang'] = (object) array(
            'noData' => __(
                "No static links provided to recommendation module. AI suggestion is off.",
                'modularity-recommend'
            )
        );

        //Get permalink, reformat to object
        if (!empty($data['recommendLinkList'])) {
            $data['recommendLinkList'] = array_map(function ($item) {
                if (is_integer($item['recommendTarget'])) {
                    $item['recommendTarget'] = get_permalink($item['recommendTarget']);
                }
                return (object) $item;
            }, $data['recommendLinkList']);
        }

        //Enable RekAI
        $data['enableRekAI'] = get_field('rekai_enable', 'options');

        //Add uid
        $data['recommendUid'] = "prediction-mount-" . md5(rand());

        return $data;
    }

    /**
     * Blade Template
     * @return string
     */
    public function template(): string
    {
        return "recommend.blade.php";
    }

    /**
     * Style - Register & adding css
     * @return void
     */
    public function style()
    {
        //Register custom css
        wp_register_style(
            'modularity-recommend',
            MODULARITYRECOMMEND_URL . '/dist/' . CacheBust::name('css/modularity-recommend.css'),
            null,
            '1.0.0'
        );

        //Enqueue
        wp_enqueue_style('modularity-recommend');
    }

    /**
     * Available "magic" methods for modules:
     * init()            What to do on initialization
     * data()            Use to send data to view (return array)
     * style()           Enqueue style only when module is used on page
     * script            Enqueue script only when module is used on page
     * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
     * template()        Return the view template (blade) the module should use when displayed
     */
}
