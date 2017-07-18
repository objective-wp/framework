<?php
namespace ObjectiveWP\Framework\Action;

use ObjectiveWP\Framework\Action\ActionHook;
use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Contracts\Hooks\HasArguments;
use ObjectiveWP\Framework\Contracts\Hooks\HasPriority;
use ObjectiveWP\Framework\Contracts\Kernel;


/**
 * Class ActionLoader
 * Loads ActionHook
 *
 * @package ObjectiveWP\EnfoldChild\Loaders
 */
abstract class ActionKernel implements Kernel
{

    protected $app;

    /**
     * ActionLoader constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * The actions to load
     *
     * @return ActionHook[]
     */
    protected abstract function actions() : array;

    /**
     * Loads an array of ActionHook classes
     */
    public function bootstrap()
    {
        foreach ($this->actions() as $action)
            $this->addAction($action);
    }


    /**
     * Add an action to a hook
     * @param $actionClass
     */
    public function addAction($actionClass) {
        /** @var ActionHook $newAction */
        $newAction = $this->app->getContainer()->get($actionClass);

        $priority = 10;
        if($newAction instanceof HasPriority)
            $priority = $newAction->priority();
        $acceptedArgs = 1;
        if($newAction instanceof HasArguments)
            $acceptedArgs = $newAction->acceptedArgs();

        add_action($newAction->tag(),  [$newAction, 'handle'], $priority, $acceptedArgs);
    }

    public function removeAction($actionClass) {
        /** @var ActionHook $currentAction */
        $currentAction = $this->app->getContainer()->get($actionClass);
        $priority = 10;
        if($currentAction instanceof HasPriority)
            $priority = $currentAction->priority();
        remove_action( $currentAction->tag(), [$currentAction, 'handle'], $priority );
    }
}