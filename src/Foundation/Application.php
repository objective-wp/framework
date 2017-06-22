<?php

namespace ObjectiveWP\Framework\Foundation;

use DI\Container;
use DI\ContainerBuilder;
use \ObjectiveWP\Framework\Contracts\Foundation\Application as ApplicationContract;
use ObjectiveWP\Framework\Contracts\Kernel;

abstract class Application implements ApplicationContract
{
    protected $version;

    protected $applicationPath;

    protected $container;

    /**
     * A list of the kernels to bootstrap
     * @return Kernel[]
     */
    protected abstract function kernels();

    /**
     * Application constructor.
     * @param string $version
     * @param string $applicationPath
     * @param array $definitions
     * @param ContainerBuilder $containerBuilder
     */
    public function __construct($version, $applicationPath, $definitions = [], $containerBuilder = null) {
        $this->version = $version;
        $this->applicationPath = $applicationPath;
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