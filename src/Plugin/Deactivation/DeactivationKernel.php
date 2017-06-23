<?php

namespace ObjectiveWP\Framework\Plugin\Deactivation;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Contracts\Kernel;

/**
 * Class DeactivationKernel
 * @package ObjectiveWP\Framework\Plugin\Deactivation
 */
abstract class DeactivationKernel implements Kernel
{

    protected $app;

    /**
     * DeactivationLoader constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * The deactivation hooks to load
     * @return DeactivationHook[]
     */
    public abstract function deactivationHooks(): array;

    /**
     * Bootstrap the kernel
     *
     * @return void
     */
    public function bootstrap()
    {
        foreach ($this->deactivationHooks() as $deactivation) {
            /** @var DeactivationHook $newDeactivation */
            $newDeactivation = $this->app->getContainer()->get($deactivation);
            register_deactivation_hook($this->app->getBootstrapFileLocation(),  [$newDeactivation, 'handle']);
        }
    }
}