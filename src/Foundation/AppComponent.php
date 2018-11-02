<?php

namespace ObjectiveWP\Framework\Foundation;

use ObjectiveWP\Framework\Contracts\Foundation\Application as BaseApplication;

class AppComponent
{
    /** @var BaseApplication  */
    protected $app;

    public function __construct(BaseApplication $app)
    {
        $this->app = $app;
    }

}