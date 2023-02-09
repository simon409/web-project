<?php
    require('../../../config/config.php');
    
    if(isset($_POST['counname']) && isset($_POST['councode']) && isset($_POST['imagecoun'])){
        $counname = $_POST['counname'];
        $councode = $_POST['councode'];
        $counimage = $_POST['imagecoun'];

        $query = "INSERT INTO country (namecoun, codecoun, image) values ('$counname', '$councode', '$counimage')";
        $res = mysqli_query($conn, $query);
    }
    else{
        header('location: admin/index.php');
    }
?>