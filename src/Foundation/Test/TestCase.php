<?php

namespace ObjectiveWP\Framework\Foundation\Test;

use DI\Container;
use Mockery;
use ObjectiveWP\Framework\Contracts\Foundation\Application;
use PHPUnit_Framework_TestCase;
use WP_Mock;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var Application|Mockery\Mock
     */
    protected $mockApp;

    /**
     * @var Container|Mockery\Mock
     */
    protected $mockContainer;

    protected function setUp()
    {
        parent::setUp();
        $this->mockContainer = Mockery::mock(Container::class);
        $this->mockApp = Mockery::mock(Application::class);
        $this->mockApp->shouldReceive('getContainer')->andReturn($this->mockContainer)->zeroOrMoreTimes();
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }

}