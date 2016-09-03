<?php

require(__DIR__ . '/vendor/autoload.php');
use \IndicoIo\IndicoIo as IndicoIo;
IndicoIo::$config['api_key'] = '47ba010731895352db83e7ce50a62d3d';

$s = array ();

# batch example
$s = IndicoIo::sentiment([
    "I love writing code!",
    "Alexander and the Terrible, Horrible, No Good, Very Bad Day"
]);

var_dump($s);
?>