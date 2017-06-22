<?php

namespace ObjectiveWP\Framework\Foundation\Test\Factories;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\ShortCode\ShortCode;
use ObjectiveWP\Framework\ShortCode\ShortCodeKernel;

class ShortCodeKernelFactory
{
    /**
     * @param Application $application
     * @param array $hooks
     * @return ShortCodeKernel
     */
    public function makeKernel($application, $hooks =  []) {
        /** @var ShortCodeKernel $kernel */
        $kernel = new class($application, $hooks) extends ShortCodeKernel {

            protected $injectedHooks;

            /**
             * ActionLoader constructor.
             * @param Application $app
             * @param array $hooks
             */
            public function __construct(Application $app, $hooks = [])
            {
                $this->injectedHooks = $hooks;
                parent::__construct($app);
            }



            /**
             * Short codes to load
             *
             * @return ShortCode[]
             */
            public function shortCodes()
            {
                return $this->injectedHooks;
            }
        };
        return $kernel;
    }
}