<?php
require ("../app.php");
require("../vendor/autoload.php");
use \IndicoIo\IndicoIo as IndicoIo;
IndicoIo::$config['api_key'] = $CFG->indico_api;

$emotion = array();
$sentiment = 0;
$anger = 0;
$joy = 0;
$fear = 0;
$sadness = 0;
$surprise = 0;
$key = 0;

$data = updates_required();

$l = db_connect();

include ("../z_format/head.php");
echo "Processing... <br /> \n";

$count = count($data);

for ($i=0;$i<$count;$i++) {
    $key = $data[$i]["key"];
    
    $emotion = IndicoIo::emotion($data[$i]["title"]);
    $sentiment = IndicoIo::sentiment($data[$i]["title"]);
    
    $anger = $emotion["anger"];
    $joy = $emotion["joy"];
    $fear = $emotion["fear"];
    $sadness = $emotion["sadness"];
    $surprise = $emotion["surprise"];
    
    $query = $l->query("UPDATE `primary` SET
                            sentiment = '$sentiment',
                            anger = '$anger',
                            joy = '$joy',
                            fear = '$fear',
                            sadness = '$sadness',
                            surprise = '$surprise',
                            indicoflag = '1'
                        WHERE
                            `key` = '$key'
        ");
    echo $i+1 . " / " . $count . " :: " . $data[$i]["title"] . "<br /> \n";
}

db_close($l);

echo "<a href='$CFG->root/views/'>Done</a> <br /> \n";
include ("../z_format/foot.php");

//header("Location: " . $CFG->root . "/views/")
?>