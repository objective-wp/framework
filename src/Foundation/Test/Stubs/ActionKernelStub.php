<?php

namespace ObjectiveWP\Framework\Foundation\Test\Stubs;


use ObjectiveWP\Framework\Action\ActionHook;
use ObjectiveWP\Framework\Action\ActionKernel;
use ObjectiveWP\Framework\Contracts\Foundation\Application;

class ActionKernelStub extends ActionKernel {

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
     * The actions to load
     *
     * @return ActionHook[]
     */
    protected function actions(): array
    {
        return $this->injectedHooks;
    }
};
