<?php

namespace ObjectiveWP\Framework\Foundation\Test\Factories;

use ObjectiveWP\Framework\Contracts\Kernel;
use ObjectiveWP\Framework\Foundation\Application;

class ApplicationFactory
{
    /**
     * @param $version
     * @param $baseUrl
     * @param array $definitions
     * @param array $kernels
     * @return Application
     */
    public function makeApplication($version, $baseUrl, $definitions = [], $kernels = []) {
        /** @var Application $app */
        $app =  new class($version, $baseUrl, $definitions, $kernels) extends Application {

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
        };
        return $app;
    }
}