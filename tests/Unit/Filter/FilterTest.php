<?php

namespace ObjectiveWP\Framework\Tests\Unit\Filter;

use ObjectiveWP\Framework\Contracts\Hooks\HasArguments;
use ObjectiveWP\Framework\Contracts\Hooks\HasPriority;
use ObjectiveWP\Framework\Filter\FilterHook;
use ObjectiveWP\Framework\Foundation\Test\TestCase;

class FilterTest extends TestCase
{
    public function test_filter() {
        /** @var FilterHook $filter */
        $filter = new class implements FilterHook, HasPriority, HasArguments {

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

        $this->assertEquals('init', $filter->tag());
        $this->assertTrue(is_a($filter, HasPriority::class));
        $this->assertEquals(20, $filter->priority());
        $this->assertTrue(is_a($filter, HasArguments::class));
        $this->assertEquals(2, $filter->acceptedArgs());
        $this->assertEquals('hello world', $filter->handle('hello ', 'world'));
    }
}