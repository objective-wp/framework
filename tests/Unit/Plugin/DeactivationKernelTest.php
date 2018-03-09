<?php

namespace ObjectiveWP\Framework\Tests\Unit\Plugin;

use ObjectiveWP\Framework\Foundation\Test\TestCase;
use ObjectiveWP\Framework\Plugin\Activation\ActivationHook;
use WP_Mock;

class DeactivationKernelTest extends TestCase
{
    public function test_bootstrap() {
        $hook = \Mockery::mock(ActivationHook::class);
        $this->mockApp->shouldReceive('getBootstrapFileLocation')->andReturn('file-location');
        $this->mockContainer->shouldReceive('get')->withArgs([get_class($hook)])->once()->andReturn($hook);
        $kernel = $this->kernelFactory->makeDeactivationKernel([ get_class($hook) ]);

        WP_Mock::userFunction( 'register_deactivation_hook', [
            'args' => ['file-location', [$hook, 'handle']],
            'times' => 1,
            'return' => 'true'
        ]);

        $kernel->bootstrap();
    }
}