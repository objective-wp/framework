<?php

namespace ObjectiveWP\Framework\Tests\Unit\Application;

use ObjectiveWP\Framework\Contracts\Foundation\Application as ApplicationContract;
use ObjectiveWP\Framework\Foundation\Application as BaseApplication;
use ObjectiveWP\Framework\Foundation\Test\TestCase;
use ObjectiveWP\Framework\Contracts\Kernel;
use ObjectiveWP\Framework\Foundation\Application;


class ApplicationTest extends TestCase
{
    public function test_container()
    {
        /** @var Application $app */
        $app = new class('0.0.1',
            'example/',
            'http://example/',
            'example/index.php',
            [
                // add service providers here
            ],
            'example_application',
            'eapt',
            'text-domain') extends Application {

            /**
             * A list of the kernels to bootstrap
             * @return Kernel[]
             */
            protected function kernels()
            {
                return [

                ];
            }
        };
        $this->assertTrue($app === $app->getContainer()->get(ApplicationContract::class), "Application should be resolvable");
        $this->assertTrue($app === $app->getContainer()->get(BaseApplication::class), "Application should be resolvable");
    }
}