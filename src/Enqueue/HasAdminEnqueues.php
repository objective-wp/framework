<?php

namespace ObjectiveWP\Framework\Enqueue;

interface HasAdminEnqueues
{
    function adminEnqueues(EnqueueManager $enqueueManager);
}