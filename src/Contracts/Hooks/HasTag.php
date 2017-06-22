<?php

namespace ObjectiveWP\Framework\Contracts\Hooks;

interface HasTag
{
    /**
     * Get the tag
     *
     * @return string
     */
    public function tag() : string;
}