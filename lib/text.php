<?php
function remove_bracketed($string) {
    $string = preg_replace("/\([^)]+\)/", "", $string);
    $string = preg_replace("/\[([^\[\]]++|(?R))*+\]/", "", $string);
    return $string;
}

?>