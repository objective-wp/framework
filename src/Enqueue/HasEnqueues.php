<?php

namespace ObjectiveWP\Framework\Enqueue;

interface HasEnqueues
{
    function enqueues(EnqueueManager $enqueueManager);
}