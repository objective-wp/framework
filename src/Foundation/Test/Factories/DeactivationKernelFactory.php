<?php

namespace ObjectiveWP\Framework\Foundation\Test\Factories;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Plugin\Activation\ActivationHook;
use ObjectiveWP\Framework\Plugin\Activation\ActivationKernel;
use ObjectiveWP\Framework\Plugin\Deactivation\DeactivationHook;
use ObjectiveWP\Framework\Plugin\Deactivation\DeactivationKernel;

class DeactivationKernelFactory
{
    /**
     * @param Application $application
     * @param array $hooks
     * @return DeactivationKernel
     */
    public function makeKernel($application, $hooks =  []) {
        /** @var DeactivationKernel $kernel */
        $kernel = new class($application, $hooks) extends DeactivationKernel {

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
             * The deactivation hooks to load
             * @return DeactivationHook[]
             */
            public function deactivationHooks(): array
            {
                return $this->injectedHooks;
            }
        };

        return $kernel;
    }
}