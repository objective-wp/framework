<?php

namespace ObjectiveWP\Framework\Tests\Unit\ShortCode;

use Mockery;

use ObjectiveWP\Framework\ShortCode\ShortCode;
use ObjectiveWP\Framework\Foundation\Test\TestCase;
use WP_Mock;

class ShortCodeKernelTest extends TestCase
{
    public function test_addShortCode() {
        $tag = "short_code_name";
        /** @var Mockery\Mock|ShortCode $hook */
        $hook = Mockery::mock(ShortCode::class);
        $hook->shouldReceive('tag')->once()->andReturn($tag);

        $this->mockContainer->shouldReceive('get')->withArgs([get_class($hook)])->once()->andReturn($hook);

        $kernel = $this->kernelFactory->makeShortCodeKernel([get_class($hook)]);

        WP_Mock::userFunction( 'add_shortcode', array(
            'args' => [$tag, [$hook, 'handle']],
            'times' => 1,
            'return' => 'true'
        ) );

        $kernel->bootstrap();
    }
}