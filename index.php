<?php

require(__DIR__ . '/vendor/autoload.php');
use \IndicoIo\IndicoIo as IndicoIo;
IndicoIo::$config['api_key'] = '404dfbb6e80ebc11c8f57a0404463c10';

$s = array();
# batch example
$s = IndicoIo::emotion([
    "I love writing code!",
    "Alexander and the Terrible, Horrible, No Good, Very Bad Day"
]);

var_dump($s);
?>