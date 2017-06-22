<?php

namespace ObjectiveWP\Framework\Tests\Unit\Action;

use ObjectiveWP\Framework\Action\ActionHook;
use ObjectiveWP\Framework\Contracts\Hooks\HasArguments;
use ObjectiveWP\Framework\Contracts\Hooks\HasPriority;
use ObjectiveWP\Framework\Foundation\Test\TestCase;

class ActionTest extends TestCase
{
    /**
     *
     */
    public function test_Action() {
        /** @var ActionHook $action */
        $action = new class implements ActionHook, HasPriority, HasArguments {

            /**
             * Handle the data given
             *
             * @param array ...$args The arguments passed
             *
             * @return mixed
             */
            public function handle(...$args)
            {
                return $args[0] . $args[1];
            }

            /**
             * Get the tag
             *
             * @return string
             */
            public function tag(): string
            {
                return 'init';
            }

            /**
             * The amount of arguments that will be accepted when the hook is called
             * @return int
             */
            public function acceptedArgs(): int
            {
                return 2;
            }

            /**
             * The priority of the hook. Default 10.
             *  0 is the highest priority.
             * @return int
             */
            public function priority(): int
            {
                return 20;
            }
        };

        $this->assertEquals('init', $action->tag());
        $this->assertTrue(is_a($action, HasPriority::class));
        $this->assertEquals(20, $action->priority());
        $this->assertTrue(is_a($action, HasArguments::class));
        $this->assertEquals(2, $action->acceptedArgs());
        $this->assertEquals('hello world', $action->handle('hello ', 'world'));
    }
}