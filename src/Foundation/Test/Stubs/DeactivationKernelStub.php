<?php

namespace ObjectiveWP\Framework\Foundation\Test\Stubs;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Plugin\Deactivation\DeactivationKernel;

class DeactivationKernelStub extends DeactivationKernel {

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
}