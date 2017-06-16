<?php

namespace ObjectiveWP\Framework\Contracts\Hooks;

interface HasTag
{
    /**
     * Get the name of the tag to hook onto
     *
     * @return string
     */
    public function tag() : string;
}