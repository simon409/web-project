<?php
    require('./config/config.php');
    require_once('./config/phpqrcode/qrlib.php');
    session_start();
    //save last page url
    if (isset($_POST['num_adt']) && isset($_POST['num_cld']) && isset($_POST['price']) && isset($_POST['numf'])) {
        $id_user = $_SESSION['user_id'];
        $num_f = $_POST['numf'];
        $date = $_POST['date'];
        $num_adt = $_POST['num_adt'];
        $num_cld = $_POST['num_cld'];
        $price = $_POST['price'];

        $query1 = "SELECT fullname FROM users WHERE id = '$id_user'";
        $userquery = mysqli_query($conn, $query1);
        $user = mysqli_fetch_assoc($userquery);

        $fullname = $user['fullname'];

        //to add qrcode too
        $path = './assets/qrimages/';
        $qrcode = $path.time().".png";
        $qrimage = time().".png";

        //qrcode
        $inscartquery = "INSERT INTO card (flightnum, iduser, numt_adult, numt_child, totalprice, date, qrcode) values ($num_f, $id_user, $num_adt, $num_cld, $price, '$date', '$qrimage')";
        $result = mysqli_query($conn, $inscartquery);
        
        if($num_cld==0)
        {
            QRcode :: png("Flight Num:".$num_f." - Ordered by : M. ".$fullname." - Ordered for Adults ".$num_adt."Date: .".$date,$qrcode, 'H', 4,4);
        }
        else{
            QRcode :: png("Flight Num:".$num_f." - Ordered by : M. ".$fullname." - Ordered for Adults ".$num_adt." and for children ".$num_cld."Date: .".$date,$qrcode, 'H', 4,4);
        }

        

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
    else{
    ?>
        <div class="celebrate">
            <h1>Oops</h1>
            <<h3>We had diffuculties adding the flight to your cart, our teams is working on it</h3>
            <lord-icon
                src="https://cdn.lordicon.com/kjkiqtxg.json"
                trigger="loop"
                delay="2000"
                style="width:250px;height:250px">
            </lord-icon> <br>
        </div>
    <?php
    }
    ?>

</body>
<script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
</html>