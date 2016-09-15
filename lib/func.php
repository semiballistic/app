<?php
function get_vars() {
    $vars = array();
    $f_savetime = "savetime.txt";
    
    $vars["savetime"] = file_get_contents ("../vars/" . $f_savetime);
    
    return $vars;
}

function write_var($variable, $value) {
    $variable =  "../vars/" . $variable . ".txt";
    file_put_contents($variable, $value);
}

function rss2time($rss_time) {
    $day = substr($rss_time, 5, 2);
    $month = substr($rss_time, 8, 3);
    $month = date('m', strtotime("$month 1 2011"));
    $year = substr($rss_time, 12, 4);
    $hour = substr($rss_time, 17, 2);
    $min = substr($rss_time, 20, 2);
    $second = substr($rss_time, 23, 2);
    $timezone = substr($rss_time, 26);

    $timestamp = mktime($hour, $min, $second, $month, $day, $year);

    #date_default_timezone_set('EST5EDT');
    date_default_timezone_set('UTC');
    
    if(is_numeric($timezone)) {
        $hours_mod = $mins_mod = 0;
        $modifier = substr($timezone, 0, 1);
        $hours_mod = (int) substr($timezone, 1, 2);
        $mins_mod = (int) substr($timezone, 3, 2);
        $hour_label = $hours_mod>1 ? 'hours' : 'hour';
        $strtotimearg = $modifier.$hours_mod.' '.$hour_label;
        if($mins_mod) {
            $mins_label = $mins_mod>1 ? 'minutes' : 'minute';
            $strtotimearg .= ' '.$mins_mod.' '.$mins_label;
        }
        $timestamp = strtotime($strtotimearg, $timestamp);
    }

    return $timestamp;
}

function exceltime($timestamp) {
    $excel = 25569 + $timestamp / 86400;
    return $excel;
}

?>