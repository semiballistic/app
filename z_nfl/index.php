<?php
require ('../app.php');

for ($k=0;$k<50;$k++) {

    $l = db_connect();
    
    $query = mysqli_query($l, "SELECT `id`, `json_call` FROM `nfl` WHERE flag = '0' LIMIT 0, 2");
    
    for($i = 0; $data[$i] = mysqli_fetch_assoc($query); $i++) ;
    array_pop($data);
    
    for ($i=0;$i<count($data);$i++) {
        $json_string = file_get_contents($data[$i]["json_call"]);
        $parsed_json = json_decode($json_string);
        $json = $parsed_json->{"history"}->{"dailysummary"};
        
        $temp = $json[0]->meantempm;
        $precip = $json[0]->precipm;
        $fog = $json[0]->fog;
        $rain = $json[0]->rain;
        $snow = $json[0]->snow;
        $hail = $json[0]->hail;
        $thunder = $json[0]->thunder;
        $tornado = $json[0]->tornado;
        $id = $data[$i]["id"];
        
        $query = $l->query("UPDATE `nfl` SET
            temp = '$temp',
            precip = '$precip',
            fog = '$fog',
            rain = '$rain',
            snow = '$snow',
            hail = '$hail',
            thunder = '$thunder',
            tornado = '$tornado',
            flag = '1'
            WHERE
            `id` = '$id'
            ");
        
        echo "id: " . $id . " // ";
        echo "temp: " . $temp . " ";
        echo "precip: " . $precip . " ";
        echo "fog: " . $fog . " ";
        echo "rain: " . $rain . " ";
        echo "snow: " . $snow . " ";
        echo "hail: " . $hail  . " ";
        echo "thunder: " . $thunder . " ";
        echo "tornado: " . $tornado . " <br> \n";
        
    }
    db_close($l);
    sleep(13);
}
?>