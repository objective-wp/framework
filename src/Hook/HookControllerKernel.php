<?php

namespace ObjectiveWP\Framework\Hook;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Contracts\Kernel;
use ObjectiveWP\Framework\Enqueue\EnqueueKernel;

abstract class HookControllerKernel implements Kernel
{
    /** @var Application  */
    protected $app;
    /** @var EnqueueKernel  */
    protected $enqueueKernel;

    /**
     * FilterKernel constructor.
     * @param Application $app
     * @param EnqueueKernel $enqueueKernel
     */
    public function __construct(Application $app, EnqueueKernel $enqueueKernel)
    {
        $this->app = $app;
        $this->enqueueKernel = $enqueueKernel;
    }

    /**
     * The filters to load
     *
     * @return HookController[]
     */
    public abstract function controllers();

    /**
     * Bootstrap the kernel
     *
     * @return void
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function bootstrap()
    {
        foreach ($this->controllers() as $controller) {
            $this->bootstrapController($this->app->getContainer()->get($controller));
        }
    }

    protected function bootstrapController(HookController $controller) {
        if($controller instanceof HasHooks) {
            $hooksManager = new HookManager($controller);
            $controller->hooks($hooksManager);
        }
        $this->enqueueKernel->addEnqueue($controller);
    }

}