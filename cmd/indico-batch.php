<?php
require ("../app.php");
require("../vendor/autoload.php");
use \IndicoIo\IndicoIo as IndicoIo;
IndicoIo::$config['api_key'] = $CFG->indico_api;

$emotion = array();
$sentiment = array();
$batch_size = 3;

$data = updates_required();

$l = db_connect();

include ("../z_format/head.php");
echo "Processing... <br /> \n";

$count = count($data);

$total_i = ceil($count / $batch_size);

for ($i=0;$i<$total_i;$i++) {
    
    $batch = updates_required($batch_size);
    $batch_titles = "";
    $emotion = array();
    $sentiment = array();
    
    for ($j=0;$j<min($batch_size,count($batch));$j++) {
        $batch_titles .= $batch[$j]["title"] . ", "; 
    }
    $batch_titles = rtrim($batch_titles, ", ");
    
    $emotion = IndicoIo::emotion("[" . $batch_titles . "]");
    $sentiment = IndicoIo::sentiment("[" .$batch_titles . "]");
    
    for ($j=0;$j<min($batch_size,count($batch));$j++) {
        $key = $batch[$j]["key"];
        
        $s = $sentiment[$j];
        $anger = $emotion[$j]["anger"];
        $joy = $emotion[$j]["joy"];
        $fear = $emotion[$j]["fear"];
        $sadness = $emotion[$j]["sadness"];
        $surprise = $emotion[$j]["surprise"];
        
        $query = $l->query("UPDATE `primary` SET
                                sentiment = '$s',
                                anger = '$anger',
                                joy = '$joy',
                                fear = '$fear',
                                sadness = '$sadness',
                                surprise = '$surprise',
                                indicoflag = '1'
                            WHERE
                                `key` = '$key'
            ");
        
        echo $j+1 . " / " . min($batch_size,count($batch)) . " // " . $total_i . " batches :: " . $batch[$j]["title"] . "<br /> \n";
    }
}

db_close($l);

echo "<a href='$CFG->root/views/'>Done</a> <br /> \n";
include ("../z_format/foot.php");

//header("Location: " . $CFG->root . "/views/")
?>