<?php

namespace ObjectiveWP\Framework\Tests\Unit\ShortCode;

use ObjectiveWP\Framework\Foundation\Test\TestCase;
use ObjectiveWP\Framework\ShortCode\ShortCode;

class ShortCodeTest extends TestCase
{
    public function test_shortCode() {
        /** @var ShortCode $shortcode */
        $shortcode = new class extends ShortCode {

            public function tag(): string
            {
                return 'tag';
            }

            public function handle($attributes): string
            {
                return $attributes['optionOne'] . $attributes['optionTwo'];
            }
        };

        $this->assertEquals('tag', $shortcode->tag());
        $this->assertEquals('hello world',  $shortcode->handle([
            'optionOne' => 'hello ',
            'optionTwo' => 'world'
        ]));

    }
}