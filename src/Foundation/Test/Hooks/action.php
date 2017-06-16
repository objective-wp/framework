<?php

$actions = [

];

function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
    array_push($actions, [
        'tag' => $tag,
        'function_to_add' => $function_to_add,
        'priority' => $priority,
        'accepted_args' => $accepted_args
    ]);
}
