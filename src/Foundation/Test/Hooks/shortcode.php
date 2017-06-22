<?php
$shortCodes = [

];

function add_shortcode($tag, $func) {
    global $shortCodes;
    array_push($shortCodes, [
        'tag' => $tag,
        'function_to_add' => $func
    ]);
}