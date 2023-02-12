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
        <h3>You have added this Country to your Website</h3>
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
        <<h3>We had difficulties adding the Country to your website, our teams is working on it</h3>
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