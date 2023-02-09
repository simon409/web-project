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
        if(isset($_POST['stopover'])){
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