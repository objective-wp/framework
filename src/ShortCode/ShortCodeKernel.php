<?php
namespace ObjectiveWP\Framework\ShortCode;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Contracts\Kernel;

/**
 * Class ShortCodesLoader
 *
 * @package ObjectiveWP\EnfoldChild\Loaders
 */
abstract class ShortCodeKernel implements Kernel
{

    protected $app;

    /**
     * ShortCodesKernel constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Short codes to load
     *
     * @return ShortCode[]
     */
    public abstract function shortCodes();


    /**
     * Bootstrap the kernel
     *
     * @return void
     */
    public function bootstrap()
    {
        foreach ($this->shortCodes() as $shortCodeClass) {
            /** @var ShortCode $shortCode */
            $shortCode = $this->app->getContainer()->get($shortCodeClass);
            add_shortcode($shortCode->tag(), [$shortCode, 'handle']);
        }
    }

}