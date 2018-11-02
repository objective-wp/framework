<?php

namespace ObjectiveWP\Framework\Hook;


use ObjectiveWP\Framework\Enqueue\HandlesEnqueues;
use ObjectiveWP\Framework\Foundation\AppComponent;

abstract class HookController extends AppComponent
{
    use HandlesEnqueues;
}