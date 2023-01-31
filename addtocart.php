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
    <link rel="stylesheet" href="style/addtocart.css">
    <title>Congratulations 🥳</title>
</head>
<body>
    <?php
    if ($result) {
        ?>
        <div class="celebrate">
            <h1>Congrats</h1>
            <h3>You have added this flight to your card, you can proceed following this link</h3>
            <lord-icon
                src="https://cdn.lordicon.com/xxdqfhbi.json"
                trigger="loop"
                delay="2000"
                style="width:250px;height:250px;">
            </lord-icon> <br>
            <div class="btn">
                <a href="user.php">Proceed to check out</a>
            </div>
        </div>
        <?php
    }
    ?>
</body>
<script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
</html>