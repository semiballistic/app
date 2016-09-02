<?php
require(__DIR__ . '/vendor/autoload.php');
use \IndicoIo\IndicoIo as IndicoIo;
IndicoIo::$config['api_key'] = '404dfbb6e80ebc11c8f57a0404463c10';

$s = array();

$s = IndicoIo::emotion([
    "I did it. I got into Grad School. Not just any program, but a GREAT program. :-)",
    "Like seriously my life is bleak, I have been unemployed for almost a year."
]);

var_dump($s);
?>