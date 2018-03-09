<?php

namespace ObjectiveWP\Framework\Hook;

use ObjectiveWP\Framework\Contracts\Kernel;

abstract class HookControllerKernel implements Kernel
{

    /**
     * The filters to load
     *
     * @return HookController[]
     */
    public abstract function hookControllers();

    /**
     * Bootstrap the kernel
     *
     * @return void
     */
    public function bootstrap()
    {
//        $method = new ReflectionMethod('foo', 'bar');
    }
}