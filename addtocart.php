<?php
    require('./config/config.php');
    session_start();
    //save last page url
    if (isset($_POST['num_adt']) && isset($_POST['num_cld']) && isset($_POST['price']) && isset($_POST['numf'])) {
        $id_user = $_SESSION['user_id'];
        $num_f = $_POST['numf'];
        $num_adt = $_POST['num_adt'];
        $num_cld = $_POST['num_cld'];
        $price = $_POST['price'];
        $inscartquery = "INSERT INTO card (flightnum, iduser, numt_adult, numt_child, totalprice) values ($num_f, $id_user, $num_adt, $num_cld, $price)";
        $result = mysqli_query($conn, $inscartquery);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>