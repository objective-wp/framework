<?php
namespace ObjectiveWP\Framework\Contracts\Foundation;

use DI\Container;
use ObjectiveWP\Framework\Contracts\Kernel;

interface Application extends Kernel
{

    /**
     * Gets the application's absolute uri.
     * @return string
     */
    public function getApplicationUri() : string;

    /**
     * Get a fully qualified uri for the given file
     * @param string $relativePath The relative path
     * @return string The fully qualified uri
     */
    public function getFileUri(string $relativePath) : string;

    /**
     * Get a fully qualified path for the given file
     * @param string $relativePath The relative path
     * @return string The fully qualified path
     */
    public function getFilePath(string $relativePath) : string;

    /**
     * Get the application's Text Domain
     * @return string The Text Domain
     */
    public function getTextDomain() : string;

    /**
     * Gets the js namespace.
     * @return string
     */
    public function getJsNamespace() : string;

    /**
     * Get the prefix for all registered post types in this application
     * @return string
     */
    public function getPostTypePrefix() : string;


    /**
     * Prefix the given post type
     * @param $postType
     * @return string The prefixed post type
     */
    public function prefixPostType(string $postType) : string;

    /**
     * Get the application's prefix
     * @return string The prefix
     */
    public function getPrefix() : string;

    /**
     * Gets the file location of the main entry point for this application
     * @return string
     */
    public function getBootstrapFileLocation() : string;

    /**
     * prefix the given value with the application's prefix
     * @param string $value The value to prefix
     * @return string The prefixed value
     */
    public function prefix($value) : string;

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
    public function getContainer() : Container;

}