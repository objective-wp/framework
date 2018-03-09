<?php

namespace ObjectiveWP\Framework\Foundation\Test\Stubs;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;
use ObjectiveWP\Framework\Enqueue\EnqueueKernel;

class EnqueueKernelStub extends EnqueueKernel {

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
}