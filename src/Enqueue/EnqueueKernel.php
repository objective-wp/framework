<?php
namespace ObjectiveWP\Framework\Enqueue;

use ObjectiveWP\EnfoldChild\Enqueue\Enqueue;
use ObjectiveWP\EnfoldChild\Framework\Enqueue\Hooks\JsApplication;
use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Contracts\Hooks\HasArguments;
use ObjectiveWP\Framework\Contracts\Hooks\HasPriority;
use ObjectiveWP\Framework\Contracts\Kernel;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;

/**
 * Class EnqueueLoader
 * Loads script and style enqueues
 *
 * @package ObjectiveWP\EnfoldChild\Loaders
 */
abstract class EnqueueKernel implements Kernel
{

    protected $app;

    /**
     * EnqueueKernel constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * The enqueues to load
     *
     * @return EnqueueHook[]
     */
    public abstract function enqueues();


    /**
     * Loads an array of Enqueue classes
     *
     * @return void
     */
    public function bootstrap()
    {
        foreach ($this->enqueues() as $enqueue) {
            /** @var EnqueueHook $newEnqueue */
            $newEnqueue = $this->app->getContainer()->get($enqueue);

            $priority = 10;
            if($newEnqueue instanceof HasPriority)
                $priority = $newEnqueue->priority();
            $acceptedArgs = 1;
            if($newEnqueue instanceof HasArguments)
                $acceptedArgs = $newEnqueue->acceptedArgs();

            if(is_a($newEnqueue, AdminEnqueueHook::class))
                add_action('admin_enqueue_scripts',  [$newEnqueue, 'handle'], $priority, $acceptedArgs);
            else
                add_action('wp_enqueue_scripts',  [$newEnqueue, 'handle'], $priority, $acceptedArgs);
        }
    }
}