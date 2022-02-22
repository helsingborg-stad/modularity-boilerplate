<?php
namespace {{BPREPLACENAMESPACE}};

use {{BPREPLACENAMESPACE}}\App;

use Brain\Monkey\Functions;
use Mockery;

class AppTest extends \PluginTestCase\PluginTestCase
{
    // Helper for mocking global function.
    public static $functions;

    // Helper for mocking global function.
    public function setUp(): void
    {
        self::$functions = $this->createPartialMock(
            AppTest::class,
            ['modularity_register_module']
        );
        parent::setUp();
    }

    public function testAddHooks()
    {
        new App();
    
        self::assertNotFalse(has_action('plugins_loaded', '{{BPREPLACENAMESPACE}}\App->registerModule()'));
        self::assertNotFalse(has_filter('Municipio/blade/view_paths', '{{BPREPLACENAMESPACE}}\App->addViewPaths()'));
    }

    public function testAddViewPaths()
    {
        $path = '/test';
        Functions\when('is_child_theme')->justReturn(false);
        $app = new App();
        $viewPaths = $app->addViewPaths([$path]);
        $this->assertSame(end($viewPaths), $path);
    }

    public function testAddViewPathsInChildTheme()
    {
        $path = '/test';
        Functions\when('is_child_theme')->justReturn(true);
        $app = new App();
        $viewPaths = $app->addViewPaths([$path]);
        $this->assertSame($viewPaths[0], $path);
    }

    public function testRegisterModule()
    {
        Functions\when('function_exists')->justReturn(true);

        self::$functions->expects($this->once())->method('modularity_register_module');
        $app = new App();
        $app->registerModule();
    }

    // Helper function for mocking global function(Must break coding standard).
    public function modularity_register_module()
    {
        return;
    }
}

// Helper function for mocking global function.
function modularity_register_module()
{
    return AppTest::$functions->modularity_register_module();
}
