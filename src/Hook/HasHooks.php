<?php

namespace ObjectiveWP\Framework\Hook;

interface HasHooks
{
    function hooks(HookManager $hookManager);
}