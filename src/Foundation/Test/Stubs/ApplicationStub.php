<?php

namespace ObjectiveWP\Framework\Foundation\Test\Stubs;

use ObjectiveWP\Framework\Contracts\Kernel;
use ObjectiveWP\Framework\Foundation\Application;

class ApplicationStub extends Application {

    protected $injectedKernels;

    public function __construct($version, $applicationPath, $definitions = [], $kernels) {
        parent::__construct($version, $applicationPath, $definitions = []);
        $this->injectedKernels = $kernels;
    }

    /**
     * A list of the kernels to bootstrap
     * @return Kernel[]
     */
    protected function kernels()
    {
        return $this->injectedKernels;
    }
}