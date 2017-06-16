<?php
namespace ObjectiveWP\Framework\Contracts\Hooks;

interface CanHandle
{
    /**
     * Handle the data given
     *
     * @param array ...$args The arguments passed
     *
     * @return mixed|void
     */
    public function handle(...$args);
}