<?php

namespace ObjectiveWP\Framework\Enqueue;

interface HasGlobalEnqueues
{
    function globalEnqueues(EnqueueManager $enqueueManager);
}