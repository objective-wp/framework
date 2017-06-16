<?php
namespace ObjectiveWP\Framework\Loaders;

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

    protected $plugin;

    /**
     * EnqueueKernel constructor.
     * @param Application $plugin
     */
    public function __construct(Application $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * The enqueues to load
     *
     * @var EnqueueHook[]
     */
    public abstract function hooks();


    /**
     * Loads an array of Enqueue classes
     *
     * @return void
     */
    public function bootstrap()
    {
        foreach ($this->hooks() as $enqueue) {
            /** @var EnqueueHook $newEnqueue */
            $newEnqueue = new $enqueue;

            $priority = 10;
            if($newEnqueue instanceof HasPriority)
                $priority = $newEnqueue->priority();
            $acceptedArgs = 1;
            if($newEnqueue instanceof HasArguments)
                $acceptedArgs = $newEnqueue->acceptedArgs();

            add_action('wp_enqueue_scripts',  [$newEnqueue, 'enqueue'], $priority, $acceptedArgs);
        }
    }
}