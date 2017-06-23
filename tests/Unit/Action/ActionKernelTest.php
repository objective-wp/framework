<?php

namespace ObjectiveWP\Framework\Tests\Unit\Action;


use DI\Container;
use ObjectiveWP\Framework\Action\ActionHook;
use ObjectiveWP\Framework\Action\ActionKernel;
use ObjectiveWP\Framework\Contracts\Kernel;
use ObjectiveWP\Framework\Foundation\Application;
use Mockery;
use ObjectiveWP\Framework\Foundation\Test\Factories\ActionKernelFactory;
use ObjectiveWP\Framework\Foundation\Test\Factories\EnqueueKernelFactory;
use ObjectiveWP\Framework\Foundation\Test\TestCase;

class ActionKernelTest extends TestCase
{
    public function test_addAction() {
        $container = Mockery::mock(Container::class);

        $app = Mockery::mock(Application::class);
        $app->shouldReceive('getContainer')->andReturn($container);

        $hook = Mockery::mock(ActionHook::class);
        $hook->shouldReceive('tag')->once()->andReturn('init');

        $container->shouldReceive('get')->once()->andReturn($hook);

        $factory = new ActionKernelFactory();
        $kernel = $factory->makeKernel($app, [
            'ApplicationTest'
        ]);

        $kernel->bootstrap();
        $this->assertActionHookWasAdded('init', [$hook, 'handle']);
    }

}



