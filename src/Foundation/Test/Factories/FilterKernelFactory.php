<?php

namespace ObjectiveWP\Framework\Foundation\Test\Factories;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Filter\FilterHook;
use ObjectiveWP\Framework\Filter\FilterKernel;

class FilterKernelFactory
{
    /**
     * @param Application $application
     * @param array $hooks
     * @return FilterKernel
     */
    public function makeKernel($application, $hooks =  []) {
        /** @var FilterKernel $kernel */
        $kernel = new class($application, $hooks) extends FilterKernel {

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
             * The filters to load
             *
             * @return FilterHook[]
             */
            public function filters()
            {
                return $this->injectedHooks;
            }
        };
        return $kernel;
    }
}