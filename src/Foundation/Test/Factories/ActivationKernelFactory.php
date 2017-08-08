<?php

namespace ObjectiveWP\Framework\Foundation\Test\Factories;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Plugin\Activation\ActivationHook;
use ObjectiveWP\Framework\Plugin\Activation\ActivationKernel;

class ActivationKernelFactory
{
    /**
     * @param Application $application
     * @param array $hooks
     * @return ActivationKernel
     */
    public function makeKernel($application, $hooks =  []) {
        /** @var ActivationKernel $kernel */
        $kernel = new class($application, $hooks) extends ActivationKernel {

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
             * The activation hooks to load
             * @return ActivationHook[]
             */
            public function activationHooks(): array
            {
                return $this->injectedHooks;
            }
        };

        return $kernel;
    }
}