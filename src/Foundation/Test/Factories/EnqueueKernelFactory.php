<?php

namespace ObjectiveWP\Framework\Foundation\Test\Factories;

use ObjectiveWP\Framework\Action\ActionHook;
use ObjectiveWP\Framework\Action\ActionKernel;
use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;
use ObjectiveWP\Framework\Enqueue\EnqueueKernel;

class EnqueueKernelFactory
{
    /**
     * @param Application $application
     * @param array $hooks
     * @return ActionKernel
     */
    public function makeKernel($application, $hooks =  []) {
        /** @var ActionKernel $kernel */
        $kernel = new class($application, $hooks) extends EnqueueKernel {

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
             * The enqueues to load
             *
             * @return EnqueueHook[]
             */
            public function enqueues()
            {
                return $this->injectedHooks;
            }
        };
        return $kernel;
    }
}