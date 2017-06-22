<?php

namespace ObjectiveWP\Framework\Foundation\Test;

use Mockery;
use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * Assert that the action hook has been registered
     * @param string $tag
     * @param array|string $function_to_add
     * @param int $priority
     * @param int $acceptedArgs
     */
    public function assertActionHookWasAdded($tag, $function_to_add, $priority = 10, $acceptedArgs = 1 ) {
        $this->assertHookWasAdded('actions', 'action', $tag, $function_to_add, $priority, $acceptedArgs);
    }

    /**
     * Assert that the filter hook has been registered
     * @param string $tag
     * @param array|string $function_to_add
     * @param int $priority
     * @param int $acceptedArgs
     */
    public function assertFilterHookWasAdded($tag, $function_to_add, $priority = 10, $acceptedArgs = 1 ) {
        $this->assertHookWasAdded('filters', 'filter', $tag, $function_to_add, $priority, $acceptedArgs );
    }

    /**
     * Assert that the shortcode hook has been registered
     * @param string $tag
     * @param array|string $func
     */
    public function assertShortCodeHookWasAdded($tag, $func) {
        global $shortCodes;
        $this->assertTrue(isset($shortCodes[$tag]), "ShortCode hook tag should exist");
        $shortCode = $shortCodes[$tag];
        $this->assertTrue(isset($shortCode), "ShortCode hook should be found");
        $this->assertEquals($func, $shortCode['function_to_add'], "ShortCode handle should be correct");
    }

    /**
     * Assert that the hook has been registered
     * @param $hookArray
     * @param string $label
     * @param string $tag
     * @param array|string $function_to_add
     * @param int $priority
     * @param int $acceptedArgs
     */
    private function assertHookWasAdded($hookArray, $label = "",  $tag, $function_to_add, $priority = 10, $acceptedArgs = 1 ) {
        $hooks = $GLOBALS[$hookArray];
        if(!empty($label))
            $label = $label . " " ;
        $this->assertTrue(isset($hooks[$tag]), $label . "hook tag should exist");
        $hooks = $hooks[$tag];
        $found = false;
        foreach ($hooks as $hook) {
            if($hook['function_to_add'] == $function_to_add) {
                $found = true;
                $this->assertEquals($priority ,$hook['priority'], "The priority should be correct");
                $this->assertEquals($acceptedArgs ,$hook['accepted_args'], "The number of accepted args should be correct");
            }
        }
        $this->assertTrue($found, $label . "hook should be found");
    }
}