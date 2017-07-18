<?php

namespace ObjectiveWP\Framework\Post;


use ObjectiveWP\Framework\Contracts\Foundation\Application;

abstract class PostType
{
    protected $prefix;

    public function __construct(Application $app)
    {
        $this->prefix = $app->getPostTypePrefix();
    }

    protected abstract function name() : string;

    public function getName() {
        return $this->prefix . $this->name();
    }

    public abstract function labels() : array;


    public abstract function arguments() : array;
}