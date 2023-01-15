<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'webproject';
    
    // Create connection
    $conn = mysqli_connect($host, $user, $password, $dbname);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //AUTO COMPLETE CODE
    $sql_aut = "SELECT * FROM country";
    $result = mysqli_query($conn, $sql_aut);
    $json_array = array();

    while ($data = mysqli_fetch_assoc($result)){
        $json_array[] = $data;
    }

    //echo json_encode($json_array)
?>