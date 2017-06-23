<?php

namespace ObjectiveWP\Framework\Post\Meta\MetaBox;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Contracts\Kernel;

abstract class MetaBoxKernel implements Kernel
{

    protected $app;

    /**
     * MetaBoxLoader constructor.
     * @param Application $plugin
     */
    public function __construct(Application $plugin)
    {
        $this->app = $plugin;
    }

    /**
     * The MetaBoxes to load
     * @return MetaBox[]
     */
    public abstract function metaBoxes() : array;

    /**
     * Bootstrap the kernel
     *
     * @return void
     */
    public function bootstrap()
    {
        foreach ($this->metaBoxes() as $metaBox) {
            /** @var MetaBox $newMetaBox */
            $newMetaBox = $this->app->getContainer()->get($metaBox);
            $newMetaBox->register();
        }
    }
}