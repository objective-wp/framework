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
use WP_Mock;

class ActionKernelTest extends TestCase
{
    public function test_addAction() {
        /** @var ActionHook|Mockery\Mock $hook */
        $hook = Mockery::mock(ActionHook::class);
        $hook->shouldReceive('tag')->once()->andReturn('init');

        $this->mockContainer->shouldReceive('get')->once()->andReturn($hook);

        $factory = new ActionKernelFactory();
        $kernel = $factory->makeKernel($this->mockApp, [
            'ApplicationTest'
        ]);

        WP_Mock::expectActionAdded('init',[$hook, 'handle']);
        $kernel->bootstrap();
    }

}



