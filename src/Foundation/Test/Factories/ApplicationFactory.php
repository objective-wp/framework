<?php

namespace ObjectiveWP\Framework\Foundation\Test\Factories;

use ObjectiveWP\Framework\Contracts\Kernel;
use ObjectiveWP\Framework\Foundation\Application;
use ObjectiveWP\Framework\Foundation\Test\Stubs\ApplicationStub;

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
        return new ApplicationStub($version, $baseUrl, $definitions, $kernels) ;
    }
}