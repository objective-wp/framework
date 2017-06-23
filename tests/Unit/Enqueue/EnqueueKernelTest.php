<?php

namespace ObjectiveWP\Framework\Tests\Unit\Enqueue;


use DI\Container;
use ObjectiveWP\Framework\Enqueue\AdminEnqueueHook;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;
use ObjectiveWP\Framework\Foundation\Application;
use Mockery;
use ObjectiveWP\Framework\Foundation\Test\Factories\EnqueueKernelFactory;
use ObjectiveWP\Framework\Foundation\Test\TestCase;

class EnqueueKernelTest extends TestCase
{
    public function test_addEnqueue() {
        $container = Mockery::mock(Container::class);

        $app = Mockery::mock(Application::class);
        $app->shouldReceive('getContainer')->andReturn($container);

        $hook = Mockery::mock(EnqueueHook::class);

        $container->shouldReceive('get')->once()->andReturn($hook);

        $factory = new EnqueueKernelFactory();
        $kernel = $factory->makeKernel($app, [
            'ApplicationTest'
        ]);

        $kernel->bootstrap();
        $this->assertActionHookWasAdded('wp_enqueue_scripts', [$hook, 'handle']);
    }

    public function test_addAdminEnqueue() {
        $container = Mockery::mock(Container::class);

        $app = Mockery::mock(Application::class);
        $app->shouldReceive('getContainer')->andReturn($container);

        $hook = Mockery::mock(AdminEnqueueHook::class);

        $container->shouldReceive('get')->once()->andReturn($hook);

        $factory = new EnqueueKernelFactory();
        $kernel = $factory->makeKernel($app, [
            'ApplicationTest'
        ]);

        $kernel->bootstrap();
        $this->assertActionHookWasAdded('admin_enqueue_scripts', [$hook, 'handle']);
    }

}



