<?php
    require('../../../config/config.php');
    
    if(isset($_POST['forma']) && isset($_POST['toa']) && isset($_POST['seata']) && isset($_POST['priceadt']) && isset($_POST['pricecld']) && isset($_POST['depttime']) && isset($_POST['arrtime'])){
        //getting data
        $froma = $_POST['forma'];
        $toa = $_POST['toa'];
        $seata = $_POST['seata'];
        $pricea = $_POST['priceadt'];
        $pricec = $_POST['pricecld'];
        $deptime = $_POST['depttime'];
        $arrtime = $_POST['arrtime'];

        //checking if it have stopover
        if($_POST['stopover'] == "Contains Stopover"){
            $stopover = $_POST['stopa'];
            $query = "INSERT INTO flights (froma, toa, idescale, boardtime, arrivaltime, price_adult, price_child, seats_available, seats_taken) values ($froma, $toa, $stopover, '$deptime', '$arrtime', $pricea, $pricec, $seata, 0)";
        }
        else{
            $query = "INSERT INTO flights (froma, toa, boardtime, arrivaltime, price_adult, price_child, seats_available, seats_taken) values ($froma, $toa, '$deptime', '$arrtime', $pricea, $pricec, $seata, 0)";
        }
        $res = mysqli_query($conn, $query);
    }
    else{
        header('location: admin/index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style/addtocart.css">
    <title>Congratulations 🥳</title>
</head>

<body>
    <?php
    if ($result) {
        ?>
    <div class="celebrate">
        <h1>Congrats</h1>
        <h3>You have added this flight to your Website</h3>
        <lord-icon src="https://cdn.lordicon.com/xzksbhzh.json" trigger="loop" delay="1000"
            style="width:250px;height:250px">
        </lord-icon> <br>
        <div class="btn">
            <a href="../../dashboard.php">Back to dashboard</a>
        </div>
    </div>
    <?php
    }
    else{
    ?>
    <div class="celebrate">
        <h1>Oops</h1>
        <h3>We had diffuculties adding the flight to your cart, our teams is working on it</h3>
        <lord-icon src="https://cdn.lordicon.com/kjkiqtxg.json" trigger="loop" delay="2000"
            style="width:250px;height:250px">
        </lord-icon> <br>
    </div>
    <?php
    }
    ?>
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
</body>

</html>