<?php

namespace ObjectiveWP\Framework\Foundation\Test\Stubs;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Plugin\Activation\ActivationHook;
use ObjectiveWP\Framework\Plugin\Activation\ActivationKernel;

class ActivationKernelStub extends ActivationKernel {

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
}