<?php
require('vendor/autoload.php');
use \IndicoIo\IndicoIo as IndicoIo;
IndicoIo::$config['api_key'] = '47ba010731895352db83e7ce50a62d3d';

echo IndicoIo::emotion(
    "I did it. I got into Grad School. Not just any program, but a GREAT program. :-)"
    );
?>