<?php

namespace ObjectiveWP\Framework\Tests\Unit\Enqueue;

use ObjectiveWP\Framework\Enqueue\AdminEnqueueHook;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;
use Mockery;
use ObjectiveWP\Framework\Foundation\Test\TestCase;
use WP_Mock;

class EnqueueKernelTest extends TestCase
{
    public function test_bootstrap() {
        /** @var Mockery\Mock|EnqueueHook $hook */
        $hook = Mockery::mock(EnqueueHook::class);
        $this->mockContainer->shouldReceive('get')->once()->andReturn($hook);

        $kernel = $this->kernelFactory->makeEnqueueKernel(['ApplicationTest']);
        WP_Mock::expectActionAdded('wp_enqueue_scripts',[$hook, 'handle']);
        $kernel->bootstrap();
    }

    public function test_addEnqueue_admin() {
        /** @var Mockery\Mock|AdminEnqueueHook $hook */
        $hook = Mockery::mock(AdminEnqueueHook::class);
        $this->mockContainer->shouldReceive('get')->once()->andReturn($hook);

        $kernel = $this->kernelFactory->makeEnqueueKernel( ['ApplicationTest']);

        WP_Mock::expectActionAdded('admin_enqueue_scripts',[$hook, 'handle']);
        $kernel->addEnqueue(get_class($hook));
    }

}



