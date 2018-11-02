<?php
namespace ObjectiveWP\Framework\Enqueue;

use ObjectiveWP\Framework\Foundation\AppComponent;

/**
 * Class Enqueue
 *
 * @package ObjectiveWP\EnfoldChild\Enqueues
 */
abstract class EnqueueHook extends AppComponent
{
    use HandlesEnqueues;
}