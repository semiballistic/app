<?php

require(__DIR__ . '/vendor/autoload.php');
use \IndicoIo\IndicoIo as IndicoIo;

IndicoIo::sentiment(
    ['indico is so easy to use!', 'Still really easy, yiss'],
    $api_key="47ba010731895352db83e7ce50a62d3d"
);

// Array ( 
//	  [0] => 0.9782025594088044,
//	  [1] => 0.9895808115135271
// )

?>