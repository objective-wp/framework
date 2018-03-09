<?php
namespace ObjectiveWP\Framework\Enqueue;

use ObjectiveWP\Framework\Contracts\Hooks\CanHandle;

/**
 * Class Enqueue
 *
 * @package ObjectiveWP\EnfoldChild\Enqueues
 */
abstract class EnqueueHook extends EnqueueManager implements CanHandle
{
    /**
     * Enqueue scripts or styles.
     *
     * @param array ...$args The arguments passed
     * @return void
     */
   public abstract function handle(...$args);
}