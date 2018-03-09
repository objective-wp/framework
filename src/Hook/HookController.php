<?php

namespace ObjectiveWP\Framework\Hook;

use ObjectiveWP\Framework\Enqueue\EnqueueManager;
use ReflectionException;
use ReflectionMethod;

abstract class HookController
{

    /**
     * Add all hooks here
     * @param EnqueueManager $enqueueManager
     * @return mixed
     */
    public abstract function bootstrap(EnqueueManager $enqueueManager);

    /**
     *  Hook a function or method to a specific filter action.
     * @param string $tag The name of the filter to hook the $function_to_add callback to.
     * @param callable $method
     * @param int $priority
     * @throws ReflectionException
     */
    protected function addFilter($tag, $method, $priority = 10) {
        add_filter($tag, [$this, $method], $priority, $this->getNumberOfArgs($method));
    }

    /**
     * Hooks a function on to a specific action.
     * @param string $tag
     * @param string $method
     * @param int $priority
     * @throws ReflectionException
     */
    protected function addAction(string $tag, string $method, $priority = 10) {
        add_action($tag, [$this, $method], $priority, $this->getNumberOfArgs($method));
    }
    
    

    /**
     * Gets the amount of args defined on a function
     * @param string $method The name of the method to hook.
     * @return int
     * @throws ReflectionException
     */
    private function getNumberOfArgs(string $method) {
        $ref = new ReflectionMethod(get_class($this), $method);
        return $ref->getNumberOfParameters();
    }
    
    



}