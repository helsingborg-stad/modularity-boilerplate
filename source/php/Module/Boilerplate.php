<?php

namespace {{BPREPLACENAMESPACE}}\Module;

use {{BPREPLACENAMESPACE}}\Helper\CacheBust;

/**
 * Class {{BPREPLACESLUGCAMELCASE}}
 * @package {{BPREPLACESLUGCAMELCASE}}\Module
 */
class {{BPREPLACESLUGCAMELCASE}} extends \Modularity\Module
{
    public $slug = '{{BPREPLACESLUG}}';
    public $supports = array();

    public function init()
    {
        $this->nameSingular = __("{{BPREPLACESLUGCAMELCASE}}", 'modularity-{{BPREPLACESLUG}}');
        $this->namePlural = __("{{BPREPLACESLUGCAMELCASE}}", 'modularity-{{BPREPLACESLUG}}');
        $this->description = __("{{BPREPLACEDESCRIPTION}}", 'modularity-{{BPREPLACESLUG}}');
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
            'info' => __(
                "Hey! This is your new {{BPREPLACENAME}} module. Let's get going.",
                'modularity-{{BPREPLACESLUG}}'
            )
        );

        return $data;
    }

    /**
     * Blade Template
     * @return string
     */
    public function template(): string
    {
        return "{{BPREPLACESLUG}}.blade.php";
    }

    /**
     * Style - Register & adding css
     * @return void
     */
    public function style()
    {
        //Register custom css
        wp_register_style(
            'modularity-{{BPREPLACESLUG}}',
            {{BPREPLACECAPSCONSTANT}}_URL . '/dist/' . CacheBust::name('css/modularity-{{BPREPLACESLUG}}.css'),
            null,
            '1.0.0'
        );

        //Enqueue
        wp_enqueue_style('modularity-{{BPREPLACESLUG}}');
    }

    /**
     * Script - Register & adding scripts
     * @return void
     */
    public function script()
    {
        //Register custom css
        wp_register_script(
            'modularity-{{BPREPLACESLUG}}',
            {{BPREPLACECAPSCONSTANT}}_URL . '/dist/' . CacheBust::name('js/modularity-{{BPREPLACESLUG}}.js'),
            null,
            '1.0.0'
        );

        //Enqueue
        wp_enqueue_script('modularity-{{BPREPLACESLUG}}');
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
