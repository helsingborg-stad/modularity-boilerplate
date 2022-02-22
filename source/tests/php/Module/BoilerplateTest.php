<?php
namespace {{BPREPLACENAMESPACE}}\Module;

use {{BPREPLACENAMESPACE}}\Module\{{BPREPLACESLUGCAMELCASE}};

use Brain\Monkey\Functions;
use Mockery;

class {{BPREPLACESLUGCAMELCASE}}Test extends \PluginTestCase\PluginTestCase
{
    public function testInitShouldSetModularityInfo()
    {
        // Mock parent class that is loaded outside of plugin.
        Mockery::mock('\Modularity\Module');
        ${{BPREPLACESLUG}} = new {{BPREPLACESLUGCAMELCASE}}();
        ${{BPREPLACESLUG}}->init();

        $this->assertSame(
            ${{BPREPLACESLUG}}->nameSingular,
            __("{{BPREPLACESLUGCAMELCASE}}", 'modularity-{{BPREPLACESLUG}}')
        );
        $this->assertSame(
            ${{BPREPLACESLUG}}->namePlural,
            __("{{BPREPLACESLUGCAMELCASE}}", 'modularity-{{BPREPLACESLUG}}')
        );
        $this->assertSame(
            ${{BPREPLACESLUG}}->description,
            __("{{BPREPLACEDESCRIPTION}}", 'modularity-{{BPREPLACESLUG}}')
        );
    }

    public function testData()
    {
        $testData = [
            'testconfig' => 'testconfig',
            'lang' => (object) [
                'info' => __(
                    "Hey! This is your new {{BPREPLACENAME}} module. Let's get going.",
                    'modularity-{{BPREPLACESLUG}}'
                )
            ]
        ];

        // Mock parent class that is loaded outside of plugin.
        Mockery::mock('\Modularity\Module');
        $formatObject = Mockery::mock('overload:\Modularity\Helper\FormatObject');
        $formatObject->shouldReceive('camelCase')->once()->andReturn($testData);



        Functions\when('get_fields')->justReturn(false);

        ${{BPREPLACESLUG}} = new {{BPREPLACESLUGCAMELCASE}}();
        ${{BPREPLACESLUG}}->ID = 1;

        

        $data = ${{BPREPLACESLUG}}->data();

        $this->assertSame($data['testconfig'], 'testconfig');
        $this->assertSame((array) $data['lang'], (array) $testData['lang']);
    }

    public function testTemplate()
    {
        // Mock parent class that is loaded outside of plugin.
        Mockery::mock('\Modularity\Module');
        ${{BPREPLACESLUG}} = new {{BPREPLACESLUGCAMELCASE}}();
        $this->assertSame(${{BPREPLACESLUG}}->template(), '{{BPREPLACESLUG}}.blade.php');
    }

    public function testStyle()
    {
        Functions\expect('wp_register_style')->once();
        Functions\expect('wp_enqueue_style')->once()->with('modularity-{{BPREPLACESLUG}}');

        // Mock parent class that is loaded outside of plugin.
        Mockery::mock('\Modularity\Module');
        ${{BPREPLACESLUG}} = new {{BPREPLACESLUGCAMELCASE}}();
        ${{BPREPLACESLUG}}->init();
        ${{BPREPLACESLUG}}->style();
    }

    public function testScript()
    {
        Functions\expect('wp_register_script')->once();
        Functions\expect('wp_enqueue_script')->once()->with('modularity-{{BPREPLACESLUG}}');

        // Mock parent class that is loaded outside of plugin.
        Mockery::mock('\Modularity\Module');

        ${{BPREPLACESLUG}} = new {{BPREPLACESLUGCAMELCASE}}();
        ${{BPREPLACESLUG}}->init();
        ${{BPREPLACESLUG}}->script();
    }
}
