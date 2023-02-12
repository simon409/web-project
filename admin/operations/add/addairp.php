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
        <h3>You have added this Airport to your Website</h3>
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
        <<h3>We had difficulties adding the Airport to your website, our teams is working on it</h3>
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