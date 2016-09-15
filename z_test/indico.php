<?php
require("../app.php");
require("../vendor/autoload.php");
use \IndicoIo\IndicoIo as IndicoIo;
IndicoIo::$config['api_key'] = $CFG->indico_api;

$title = array("U.S. opens door to oil exports after year of pressure", "Shares slip in low-volume trading; safe-havens rise", "Venezuela confirms recession, highest inflation in Americas", "U.S. home price growth slows further in October", "Samsung Elec asks S.Korea customers to stop using Galaxy Note 7");

$batch_titles = "";
for ($j=0;$j<count($title);$j++) {
    $batch_titles .= "'" . $title[$j] . "'" . ", ";
}
$batch_titles = rtrim($batch_titles, ", ");
$s = IndicoIo::sentiment([$title[0], " "]);

include ("../z_format/head.php");
echo $batch_titles . "<br />\n";
var_dump($s);
include ("../z_format/foot.php");
?>