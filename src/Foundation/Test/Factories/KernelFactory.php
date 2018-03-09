<?php

namespace ObjectiveWP\Framework\Foundation\Test\Factories;

use ObjectiveWP\Framework\Action\ActionKernel;
use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Enqueue\EnqueueKernel;
use ObjectiveWP\Framework\Filter\FilterKernel;
use ObjectiveWP\Framework\Foundation\Test\Stubs\ActionKernelStub;
use ObjectiveWP\Framework\Foundation\Test\Stubs\ActivationKernelStub;
use ObjectiveWP\Framework\Foundation\Test\Stubs\DeactivationKernelStub;
use ObjectiveWP\Framework\Foundation\Test\Stubs\EnqueueKernelStub;
use ObjectiveWP\Framework\Foundation\Test\Stubs\FilterKernelStub;
use ObjectiveWP\Framework\Foundation\Test\Stubs\ShortCodeKernelStub;
use ObjectiveWP\Framework\Plugin\Activation\ActivationKernel;
use ObjectiveWP\Framework\Plugin\Deactivation\DeactivationKernel;
use ObjectiveWP\Framework\ShortCode\ShortCodeKernel;

class KernelFactory
{
    /** @var Application  */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param array $hooks
     * @return ActionKernel
     */
    public function makeActionKernel($hooks =  []): ActionKernel {
        return new ActionKernelStub($this->app, $hooks);
    }

    /**
     * @param array $hooks
     * @return ActivationKernel
     */
    public function makeActivationKernel($hooks =  []): ActivationKernel {
        return new ActivationKernelStub($this->app, $hooks) ;
    }

    /**
     * @param array $hooks
     * @return DeactivationKernel
     */
    public function makeDeactivationKernel($hooks =  []): DeactivationKernel {
        return new DeactivationKernelStub($this->app, $hooks) ;
    }

    /**
     * @param array $hooks
     * @return EnqueueKernel
     */
    public function makeEnqueueKernel($hooks =  []): EnqueueKernel {
        return new EnqueueKernelStub($this->app, $hooks);
    }

    /**
     * @param array $hooks
     * @return FilterKernel
     */
    public function makeFilterKernel($hooks = []): FilterKernel {
        return new FilterKernelStub($this->app, $hooks);
    }

    /**
     * @param array $hooks
     * @return ShortCodeKernel
     */
    public function makeShortCodeKernel($hooks =  []): ShortCodeKernel {
        return new ShortCodeKernelStub($this->app, $hooks);
    }
}