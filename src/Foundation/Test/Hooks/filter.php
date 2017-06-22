<?php

$filters = [

];

function add_filter( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
    global $filters;
    if(!isset($filters[$tag]))
        $filters[$tag] = [];
    array_push($filters[$tag], [
        'tag' => $tag,
        'function_to_add' => $function_to_add,
        'priority' => $priority,
        'accepted_args' => $accepted_args
    ]);
}
