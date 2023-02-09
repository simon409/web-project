<?php
    require('../../../config/config.php');
    
    if(isset($_POST['airname']) && isset($_POST['aircode']) && isset($_POST['coun'])){
        $airname = $_POST['airname'];
        $aircode = $_POST['aircode'];
        $coun = $_POST['coun'];

        $query = "INSERT INTO airport (nameairp, codeairport, countryid) values ('$airname', '$aircode', '$coun')";
        $res = mysqli_query($conn, $query);
    }
    else{
        header('location: admin/index.php');
    }
?>