<?php
namespace ObjectiveWP\Framework\Contracts\Foundation;

use DI\Container;
use ObjectiveWP\Framework\Contracts\Kernel;

interface Application extends Kernel
{

    /**
     * Get the application's Text Domain
     * @return string The Text Domain
     */
    public function getTextDomain();

    /**
     * Gets the js namespace.
     * @return string
     */
    public function getJsNamespace();

    /**
     * Get the prefix for all registered post types in this application
     * @return string
     */
    public function getPostTypePrefix();


    /**
     * Prefix the given post type
     * @param $postType
     * @return string The prefixed post type
     */
    public function prefixPostType($postType);

    /**
     * Get the application's prefix
     * @return string The prefix
     */
    public function getPrefix();
    /**
     * Gets the file location of the main entry point for this application
     * @return string
     */
    public function getBootstrapFileLocation();

    /**
     * prefix the given value with the application's prefix
     * @param string $value The value to prefix
     * @return string The prefixed value
     */
    public function prefix($value);

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