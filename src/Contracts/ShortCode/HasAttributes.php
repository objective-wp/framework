<?php

namespace ObjectiveWP\Framework\Contracts\ShortCode;

interface HasAttributes
{
    /**
     * Get the attribute defaults.
     * Array Schema
     * [
     *  'attribute' => 'Default Value'
     * ]
     * @return array
     */
    public function attributes();
}