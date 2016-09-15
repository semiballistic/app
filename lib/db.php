<?php
function db_connect() {
    $conn = mysqli_connect("127.7.249.2:3306","adminVZDGrp4","_ymVB1MWKeDC", "ballistic"); 
    if (!$conn) {
        die(mysqli_connect_error());
    }
    return $conn;
}

function db_close($conn) {
    mysqli_close($conn);
}

function updates_required($limit = 10000) {
    $l = db_connect();
    
    $query = mysqli_query($l, "SELECT `title`, `content`, `key` FROM  `primary` WHERE indicoflag = '0' LIMIT 0, " . $limit);
    
    for($i = 0; $data[$i] = mysqli_fetch_assoc($query); $i++) ;
    array_pop($data);
    
    db_close($l);
    
    return $data;
}

function show_db($start, $limit) {
    $l = db_connect();

    $query = mysqli_query($l, "SELECT * FROM  `primary` LIMIT " . $start . ", " . $limit);

    for($i = 0; $data[$i] = mysqli_fetch_assoc($query); $i++) ;
    array_pop($data);

    db_close($l);

    return $data;
}

function dump_csv() {
    $l = db_connect();
    $result = $l->query('SELECT * FROM `primary`');
    if (!$result) die('Couldn\'t fetch records');
    $num_fields = mysqli_num_fields($result);
    $headers = array();
    while ($fieldinfo = mysqli_fetch_field($result)) {
        $headers[] = $fieldinfo->name;
    }
    $fp = fopen('php://output', 'w');
    if ($fp && $result) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="export.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');
        fputcsv($fp, $headers);
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            fputcsv($fp, array_values($row));
        }
        die;
    }
    db_close($l);
}
?>