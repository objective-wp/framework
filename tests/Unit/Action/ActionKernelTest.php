<?php

namespace ObjectiveWP\Framework\Tests\Unit\Action;

use ObjectiveWP\Framework\Action\ActionHook;
use Mockery;
use ObjectiveWP\Framework\Foundation\Test\TestCase;
use WP_Mock;

class ActionKernelTest extends TestCase
{
    public function test_addAction() {
        /** @var ActionHook|Mockery\Mock $hook */
        $hook = Mockery::mock(ActionHook::class);
        $hook->shouldReceive('tag')->once()->andReturn('init');

        $this->mockContainer->shouldReceive('get')->once()->andReturn($hook);

        $kernel = $this->kernelFactory->makeActionKernel(['ApplicationTest']);

        WP_Mock::expectActionAdded('init',[$hook, 'handle']);
        $kernel->bootstrap();
    }

}



