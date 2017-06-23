<?php

namespace ObjectiveWP\Framework\Plugin\Activation;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Contracts\Kernel;

/**
 * Class ActivationKernel
 * @package ObjectiveWP\Framework\Plugin\Activation
 */
abstract class ActivationKernel implements Kernel
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * The activation hooks to load
     * @return ActivationHook[]
     */
    public abstract function activationHooks() : array;

    /**
     * Bootstrap the kernel
     *
     * @return void
     */
    public function bootstrap() {
        foreach ($this->activationHooks() as $activation) {
            /** @var ActivationHook $newActivation */
            $newActivation = $this->app->getContainer()->get($activation);
            register_activation_hook($this->app->getBootstrapFileLocation(),  [$newActivation, 'handle']);
        }
    }
}