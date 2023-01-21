<?php
    require('../../config/config.php');
    $id = $_GET['id'];
    echo $id;
    $query1 = "DELETE FROM flights WHERE flightnum = '$id'";
    $result = mysqli_query($conn, $query1);
    header('location:../dashboard.php')
?>