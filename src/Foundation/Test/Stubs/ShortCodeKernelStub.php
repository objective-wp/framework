<?php

namespace ObjectiveWP\Framework\Foundation\Test\Stubs;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\ShortCode\ShortCode;
use ObjectiveWP\Framework\ShortCode\ShortCodeKernel;

class ShortCodeKernelStub extends ShortCodeKernel {

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
}