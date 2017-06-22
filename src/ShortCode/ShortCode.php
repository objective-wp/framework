<?php
namespace ObjectiveWP\Framework\ShortCode;

use ObjectiveWP\Framework\Contracts\Hooks\HasTag;
use ObjectiveWP\Framework\Contracts\Hooks\CanHandle;


/**
 * Interface ShortCode
 *
 * @package ObjectiveWP\EnfoldChild\ShortCode
 */
abstract class ShortCode implements HasTag, CanHandle
{
    /**
     * Get the tag of the short code
     *
     * @return string
     */
    public abstract function tag() : string;


    /**
     * Call the ShortCode.
     * @param array $attributes
     * @return string
     */
    public function doHandle($attributes) {
        return call_user_func_array([$this, 'handle'],$attributes);
    }

    /**
     * Used for adding the short code function in.
     *
     * @param array $attributes
     * @return string
     */
    public abstract function handle(...$attributes) : string;
}