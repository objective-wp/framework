<?php

namespace ObjectiveWP\Framework\Tests\Unit\Enqueue;


use DI\Container;
use ObjectiveWP\Framework\Enqueue\AdminEnqueueHook;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;
use ObjectiveWP\Framework\Foundation\Application;
use Mockery;
use ObjectiveWP\Framework\Foundation\Test\Factories\EnqueueKernelFactory;
use ObjectiveWP\Framework\Foundation\Test\TestCase;
use WP_Mock;

class EnqueueKernelTest extends TestCase
{
    public function test_bootstrap() {
        /** @var Mockery\Mock|EnqueueHook $hook */
        $hook = Mockery::mock(EnqueueHook::class);
        $this->mockContainer->shouldReceive('get')->once()->andReturn($hook);

        $factory = new EnqueueKernelFactory();
        $kernel = $factory->makeKernel($this->mockApp, [
            'ApplicationTest'
        ]);
        WP_Mock::expectActionAdded('wp_enqueue_scripts',[$hook, 'handle']);
        $kernel->bootstrap();
    }

    public function test_addEnqueue_admin() {
        /** @var Mockery\Mock|AdminEnqueueHook $hook */
        $hook = Mockery::mock(AdminEnqueueHook::class);
        $this->mockContainer->shouldReceive('get')->once()->andReturn($hook);

        $factory = new EnqueueKernelFactory();
        $kernel = $factory->makeKernel($this->mockApp, [
            'ApplicationTest'
        ]);

        WP_Mock::expectActionAdded('admin_enqueue_scripts',[$hook, 'handle']);
        $kernel->addEnqueue(get_class($hook));
    }

}



