<?php
namespace ObjectiveWP\Framework\Enqueue;

use ObjectiveWP\EnfoldChild\Enqueue\Enqueue;
use ObjectiveWP\EnfoldChild\Framework\Enqueue\Hooks\JsApplication;
use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Contracts\Hooks\HasArguments;
use ObjectiveWP\Framework\Contracts\Hooks\HasPriority;
use ObjectiveWP\Framework\Contracts\Kernel;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;
use ObjectiveWP\Framework\Foundation\AppComponent;

/**
 * Class EnqueueLoader
 * Loads script and style enqueues
 *
 * @package ObjectiveWP\EnfoldChild\Loaders
 */
abstract class EnqueueKernel extends AppComponent implements Kernel
{
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
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function bootstrap()
    {
        foreach ($this->enqueues() as $enqueueClass)
            $this->addEnqueue($this->app->getContainer()->get($enqueueClass));
    }

    public function addEnqueue($controller) {
        $priority = 10;
        if($controller instanceof HasPriority)
            $priority = $controller->priority();

        if($controller instanceof HasEnqueues)
            add_action('wp_enqueue_scripts',  [$controller, 'handleEnqueues'], $priority, 0);

        if($controller instanceof HasGlobalEnqueues) {
            add_action('wp_enqueue_scripts',  [$controller, 'handleGlobalEnqueues'], $priority, 0);
            add_action('admin_enqueue_scripts',  [$controller, 'handleGlobalEnqueues'], $priority, 0);
        }

        if($controller instanceof HasAdminEnqueues)
            add_action('admin_enqueue_scripts',  [$controller, 'handleAdminEnqueues'], $priority, 0);
    }


    /**
     * @param $enqueueClass
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function removeEnqueueClass($enqueueClass) {
        /** @var EnqueueHook $newEnqueue */
        $newEnqueue = $this->app->getContainer()->get($enqueueClass);
        $this->removeEnqueue($newEnqueue);
    }

    public function removeEnqueue($controller) {
        $priority = 10;
        if($controller instanceof HasPriority)
            $priority = $controller->priority();

        if($controller instanceof HasEnqueues)
            remove_action('wp_enqueue_scripts',  [$controller, 'handleEnqueues'], $priority);

        if($controller instanceof HasGlobalEnqueues) {
            remove_action('wp_enqueue_scripts',  [$controller, 'handleGlobalEnqueues'], $priority);
            remove_action('admin_enqueue_scripts',  [$controller, 'handleGlobalEnqueues'], $priority);
        }

        if($controller instanceof HasAdminEnqueues)
            remove_action('admin_enqueue_scripts',  [$controller, 'handleAdminEnqueues'], $priority);
    }
}