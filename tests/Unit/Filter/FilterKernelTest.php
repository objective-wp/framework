<?php

namespace ObjectiveWP\Framework\Tests\Unit\Filter;

use DI\Container;
use Mockery;
use ObjectiveWP\Framework\Action\ActionHook;
use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Foundation\Test\Factories\FilterKernelFactory;
use ObjectiveWP\Framework\Foundation\Test\TestCase;

class FilterKernelTest extends TestCase
{
    public function test_addFilter() {
        $container = Mockery::mock(Container::class);

        $app = Mockery::mock(Application::class);
        $app->shouldReceive('getContainer')->andReturn($container);

        $hook = Mockery::mock(ActionHook::class);
        $hook->shouldReceive('tag')->once()->andReturn('init');

        $container->shouldReceive('get')->once()->andReturn($hook);

        $factory = new FilterKernelFactory();
        $kernel = $factory->makeKernel($app, [
            'ApplicationTest'
        ]);

        $kernel->bootstrap();
        $this->assertFilterHookWasAdded('init', [$hook, 'handle']);
    }

}