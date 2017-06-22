<?php
$shortCodes = [ ];

function add_shortcode($tag, $func) {
    global $shortCodes;
    if(!isset($shortCodes[$tag]))
        $shortCodes[$tag] = [];
    $shortCodes[$tag] =  [
        'tag' => $tag,
        'function_to_add' => $func
    ];
}