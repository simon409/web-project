<?php

require('./config/config.php');

if (isset($_POST["query"])) {
    $data = array();
    $condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);
    $query = "SELECT namecoun FROM country 
    WHERE namecoun LIKE '%".$condition."%'
    ORDER BY namecoun asc LIMIT 10";
    $result = $conn->query($query);
    $replace_string = '<b>'.$condition.'</b>';
    foreach ($result as $row) {
        $data[] = array(
            'couname'=> str_ireplace($condition, $replace_string, $row["namecoun"])
        );
    }

    echo json_encode($data);
}

?>