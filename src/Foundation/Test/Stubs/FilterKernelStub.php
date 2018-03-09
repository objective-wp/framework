<?php

namespace ObjectiveWP\Framework\Foundation\Test\Stubs;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Filter\FilterHook;
use ObjectiveWP\Framework\Filter\FilterKernel;

class FilterKernelStub extends FilterKernel {

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
}