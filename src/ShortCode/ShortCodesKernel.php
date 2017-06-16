<?php
namespace ObjectiveWP\EnfoldChild\Loaders;

use ObjectiveWP\EnfoldChild\ShortCodes\ShortCode;
use ObjectiveWP\Framework\Contracts\Foundation\Application;

/**
 * Class ShortCodesLoader
 *
 * @package ObjectiveWP\EnfoldChild\Loaders
 */
abstract class ShortCodesKernel implements Loader
{

    protected $plugin;

    /**
     * ShortCodesKernel constructor.
     * @param Application $plugin
     */
    public function __construct(Application $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Short codes to load
     *
     * @return ShortCode[]
     */
    public abstract function shortCodes();

    /**
     * Loads an array of short code classes
     */
    public function load()
    {
        foreach ($this->shortCodes() as $shortCodeClass) {
            /** @var ShortCode $shortCode */
            $shortCode = $this->plugin->getContainer()->get($shortCodeClass);
            add_shortcode($shortCode->name(), [$shortCode, 'handle']);
        }
    }
}