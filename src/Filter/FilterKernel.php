<?php
namespace ObjectiveWP\Framework\Filter;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Contracts\Hooks\HasArguments;
use ObjectiveWP\Framework\Contracts\Hooks\HasPriority;
use ObjectiveWP\Framework\Contracts\Kernel;
use ObjectiveWP\Framework\Filter\FilterHook;

/**
 * Class FilterLoader Loads filters
 *
 * @package ObjectiveWP\EnfoldChild\Loaders
 */
abstract class FilterKernel implements Kernel
{

    protected $plugin;

    /**
     * FilterKernel constructor.
     * @param Application $plugin
     */
    public function __construct(Application $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * The filters to load
     *
     * @return FilterHook[]
     */
    public abstract function filters();

    /**
     * Bootstrap the kernel
     *
     * @return void
     */
    public function bootstrap()
    {
        foreach ($this->filters() as $filterClass) {
            /** @var FilterHook $hook */
            $hook = $this->plugin->getContainer()->get($filterClass);

            $priority = 10;
            if($hook instanceof HasPriority)
                $priority = $hook->priority();
            $acceptedArgs = 1;
            if($hook instanceof HasArguments)
                $acceptedArgs = $hook->acceptedArgs();

            add_filter($hook->tag(), [$hook, 'handle'], $priority, $acceptedArgs);
        }
    }
}