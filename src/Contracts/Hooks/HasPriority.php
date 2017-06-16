<?php

namespace ObjectiveWP\Framework\Contracts\Hooks;

interface HasPriority
{
    /**
     * The priority of the hook. Default 10.
     *  0 is the highest priority.
     * @return int
     */
    public function priority(): int;
}