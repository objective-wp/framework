<?php

namespace ObjectiveWP\Framework\Foundation;

use DI\Container;
use DI\ContainerBuilder;
use \ObjectiveWP\Framework\Contracts\Foundation\Application as ApplicationContract;
use ObjectiveWP\Framework\Contracts\Kernel;

abstract class Application implements ApplicationContract
{
    /**
     * @var string the plugin's current version
     */
    protected $version;

    protected $applicationPath;

    protected $container;

    protected $textDomain;

    /**
     * @var string $prefix The prefix
     */
    protected $_prefix;

    /**
     * The js namespace
     * @var string
     */
    protected $jsNamespace;

    /**
     * The main entry point's file location
     * @var string
     */
    protected $bootStrapFileLocation;

    protected $postTypePrefix;
    /**
     * Application constructor.
     * @param string $version
     * @param string $applicationPath
     * @param string $baseUri
     * @param string $bootStrapFileLocation
     * @param array $definitions
     * @param string $prefix
     * @param string $postTypePrefix
     * @param string $textDomain
     * @param ContainerBuilder $containerBuilder
     */
    public function __construct($version, $applicationPath, $baseUri, $bootStrapFileLocation, $definitions = [], $prefix = '', $postTypePrefix = '', $textDomain = 'text_domain', $containerBuilder = null) {
        $this->version = $version;
        $this->applicationPath = $applicationPath;
        $this->_prefix = $prefix;
        $this->textDomain = $textDomain;
        $this->postTypePrefix = $postTypePrefix;
        $this->bootStrapFileLocation = $bootStrapFileLocation;
        $this->jsNamespace = $this->calculateJsNamespace($applicationPath);
        if($containerBuilder == null)
            $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions([
            ApplicationContract::class => $this,
            Application::class => \DI\get(ApplicationContract::class)
        ]);
        if(!empty($definitions))
            $containerBuilder->addDefinitions($definitions);
        $this->container = $containerBuilder->build();
    }

    /**
     * A list of the kernels to bootstrap
     * @return Kernel[]
     */
    protected abstract function kernels();

    /**
     * Get the application's Text Domain
     * @return string The Text Domain
     */
    public function getTextDomain() {
        return $this->textDomain;
    }

    /**
     * Gets the js namespace.
     * @return string
     */
    public function getJsNamespace() {
        return $this->jsNamespace;
    }

    /**
     * Get the prefix for all registered post types in this application
     * @return string
     */
    public function getPostTypePrefix() {
        return $this->postTypePrefix;
    }


    /**
     * Prefix the given post type
     * @param $postType
     * @return string The prefixed post type
     */
    public function prefixPostType($postType) {
        return $this->postTypePrefix . '_' . $postType;
    }

    /**
     * Get the application's prefix
     * @return string The prefix
     */
    public function getPrefix() {
        return $this->_prefix;
    }

    /**
     * Gets the file location of the main entry point for this application
     * @return string
     */
    public function getBootstrapFileLocation() {
        return $this->bootStrapFileLocation;
    }

    /**
     * prefix the given value with the application's prefix
     * @param string $value The value to prefix
     * @return string The prefixed value
     */
    public function prefix($value) {
        return $this->_prefix . '_' .  $value;
    }

    /**
     * Gets the plugin Version
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Get the path of the application
     * @return string
     */
    public function getApplicationPath(): string
    {
        return $this->applicationPath;
    }

    /**
     * Gets the plugin's DI Container
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Calculates the js namespace so it can be referenced
     * @param string $directory The directory location
     * @return string The JS Namespace
     */
    protected function calculateJsNamespace($directory) {
        $parts = preg_split('/[\\\\\/]/', $directory);
        $name = $parts[sizeof($parts) - 2];
        $nameParts = explode('-', $name);
        $nameParts[0] = strtoupper($nameParts[0]);
        for($i = 1; $i < sizeof($nameParts); $i++)
            $nameParts[$i] =  ucfirst($nameParts[$i]);
        return implode('', $nameParts);
    }


    /**
     * Bootstrap the kernel
     *
     * @return void
     */
    public function bootstrap()
    {
        foreach ($this->kernels() as $kernelClass) {
            /** @var Kernel $kernel */
            $kernel = $this->container->get($kernelClass);
            $kernel->bootstrap();
        }
    }

}