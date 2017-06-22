<?php

namespace ObjectiveWP\Framework\Tests\ShortCode;

use DI\Container;
use Mockery;

use ObjectiveWP\Framework\Foundation\Test\Factories\ShortCodeKernelFactory;
use ObjectiveWP\Framework\ShortCode\ShortCode;
use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Foundation\Test\TestCase;


class TestShortCodeKernel extends TestCase
{
    public function test_addShortCode() {
        $container = Mockery::mock(Container::class);

        $app = Mockery::mock(Application::class);
        $app->shouldReceive('getContainer')->andReturn($container);

        $hook = Mockery::mock(ShortCode::class);
        $hook->shouldReceive('tag')->once()->andReturn('short_code_name');

        $container->shouldReceive('get')->once()->andReturn($hook);

        $factory = new ShortCodeKernelFactory();
        $kernel = $factory->makeKernel($app, [
            'TestApplication'
        ]);

        $kernel->bootstrap();
    }
}