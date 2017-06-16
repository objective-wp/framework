<?php
namespace ObjectiveWP\EnfoldChild\ShortCodes;
/**
 * Interface ShortCode
 *
 * @package ObjectiveWP\EnfoldChild\ShortCode
 */
interface ShortCode
{
    /**
     * Get the name of the short code
     *
     * @return string
     */
    public function name() : string;

    /**
     * Used for adding the short code function in.
     *
     * @return string
     */
    public function handle() : string;
}