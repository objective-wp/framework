<?php

namespace ObjectiveWP\Framework\Plugin\Activation;

interface ActivationHook
{
    /**
     * Handle the activation
     * @return void
     */
    public function handle();
}