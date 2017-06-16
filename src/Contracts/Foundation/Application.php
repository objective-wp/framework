<?php
namespace ObjectiveWP\Framework\Contracts\Foundation;

use DI\Container;
use ObjectiveWP\Framework\Contracts\Kernel;

interface Application extends Kernel
{
    /**
     * Gets the plugin Version
     * @return string
     */
    public function getVersion() : string;

    /**
     * Get the path of the application
     * @return string
     */
    public function getApplicationPath() : string;

    /**
     * Gets the plugin's DI Container
     * @return Container
     */
    public function getContainer();

}