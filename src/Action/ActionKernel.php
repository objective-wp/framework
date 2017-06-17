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
        foreach ($this->actions() as $action) {
            /** @var ActionHook $newAction */
            $newAction = $this->app->getContainer()->get($action);

            $priority = 10;
            if($newAction instanceof HasPriority)
                $priority = $newAction->priority();
            $acceptedArgs = 1;
            if($newAction instanceof HasArguments)
                $acceptedArgs = $newAction->acceptedArgs();

            add_action($newAction->tag(),  [$newAction, 'handle'], $priority, $acceptedArgs);
        }
    }
}