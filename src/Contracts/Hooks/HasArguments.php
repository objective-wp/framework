<?php

namespace ObjectiveWP\Framework\Contracts\Hooks;

interface HasArguments
{
    /**
     * The amount of arguments that will be accepted when the hook is called
     * @return int
     */
    public function acceptedArgs() : int;
}