<?php

namespace ObjectiveWP\Framework\Tests\Unit\Enqueue;


use DI\Container;
use ObjectiveWP\Framework\Action\ActionHook;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;
use ObjectiveWP\Framework\Foundation\Application;
use Mockery;
use ObjectiveWP\Framework\Foundation\Test\Factories\ActionKernelFactory;
use ObjectiveWP\Framework\Foundation\Test\TestCase;

class EnqueueKernelTest extends TestCase
{
    public function test_addEnqueue() {
        $container = Mockery::mock(Container::class);

        $app = Mockery::mock(Application::class);
        $app->shouldReceive('getContainer')->andReturn($container);

        $hook = Mockery::mock(EnqueueHook::class);
        $hook->shouldReceive('tag')->once()->andReturn('init');

        $container->shouldReceive('get')->once()->andReturn($hook);

        $factory = new ActionKernelFactory();
        $kernel = $factory->makeKernel($app, [
            'ApplicationTest'
        ]);

        $kernel->bootstrap();

    }

}



