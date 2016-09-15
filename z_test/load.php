<?php
require ("../app.php");

$title = array("U.S. opens door to oil exports after year of pressure", "Shares slip in low-volume trading; safe-havens rise", "Venezuela confirms recession, highest inflation in Americas", "U.S. home price growth slows further in October", "Samsung Elec asks S.Korea customers to stop using Galaxy Note 7");
$date = array("Tue, 30 Dec 2014 17:30:18 GMT", "Tue, 30 Dec 2014 16:44:44 GMT", "Tue, 30 Dec 2014 17:56:45 GMT", "Tue, 30 Dec 2014 09:55:08 GMT", "Sat, 10 Sep 2016 00:05:06 GMT");

$utcdt = array();
$excelutcdt = array();
$excelestdt = array();
$key = array();

$l = db_connect();

for ($i=0;$i<5;$i++) {
    $utcdt[$i] = rss2time($date[$i]);
    $excelutcdt[$i] = exceltime($utcdt[$i]);
    $excelestdt[$i] = $excelutcdt[$i]-(4/24);
    $key[$i] = "TEST-" . $utcdt[$i];
    $title[$i] = $l->real_escape_string($title[$i]);
}

include ("../z_format/head.php");

for ($i=0;$i<5;$i++) {
    $query = $l->query("INSERT INTO `primary` (`source`, `group`, `utcdt`, `excelutcdt`, `excelestdt`, `title`, `key`)
                                VALUES ('TEST', 'TEST', '$utcdt[$i]', '$excelutcdt[$i]', '$excelestdt[$i]', '$title[$i]', '$key[$i]')");
    
    echo "INSERT INTO `primary` (`source`, `group`, `utcdt`, `excelutcdt`, `excelestdt`, `title`, `key`)
                                VALUES ('TEST', 'TEST', '$utcdt[$i]', '$excelutcdt[$i]', '$excelestdt[$i]', '$title[$i]', '$key[$i]')" . "<br />";
}

include ("../z_format/foot.php");

db_close($l);

?>