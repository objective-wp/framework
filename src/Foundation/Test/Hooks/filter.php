<?php

$filters = [

];

function add_filter( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
    array_push($filters, [
        'tag' => $tag,
        'function_to_add' => $function_to_add,
        'priority' => $priority,
        'accepted_args' => $accepted_args
    ]);
}