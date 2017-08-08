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
        /** @var Mockery\Mock|ActionHook $hook */
        $hook = Mockery::mock(ActionHook::class);
        $hook->shouldReceive('tag')->once()->andReturn('init');
        $this->mockContainer->shouldReceive('get')->once()->andReturn($hook);

        $factory = new FilterKernelFactory();
        $kernel = $factory->makeKernel($this->mockApp, [
            'ApplicationTest'
        ]);
        /** @noinspection PhpParamsInspection */
        \WP_Mock::expectFilterAdded('init', [$hook, 'handle']);
        $kernel->bootstrap();
    }

}