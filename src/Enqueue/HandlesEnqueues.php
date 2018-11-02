<?php

namespace ObjectiveWP\Framework\Enqueue;

trait HandlesEnqueues
{
    public function handleEnqueues() {
        $enqueueManger = $this->app->getContainer()->get(EnqueueManager::class);
        if($this instanceof HasEnqueues)
            $this->enqueues($enqueueManger);
    }

    public function handleAdminEnqueues() {
        $enqueueManger = $this->app->getContainer()->get(EnqueueManager::class);
        if($this instanceof HasAdminEnqueues)
            $this->adminEnqueues($enqueueManger);
    }

    public function handleGlobalEnqueues() {
        $enqueueManger = $this->app->getContainer()->get(EnqueueManager::class);
        if($this instanceof HasGlobalEnqueues)
            $this->globalEnqueues($enqueueManger);
    }
}