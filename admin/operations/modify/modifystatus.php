<?php
    require('../../../config/config.php');
    $id = $_GET['idm'];
    $query1 = "UPDATE message set status='Read' where idmessage = '$id'";
    $result = mysqli_query($conn, $query1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style/addtocart.css">
    <title>Item Updated successfully</title>
</head>
<body>
<?php
    if ($result) {
        ?>
        <div class="celebrate">
            <h1>Congrats</h1>
            <h3>You have updated the message</h3>
            <lord-icon
                src="https://cdn.lordicon.com/bxxnzvfm.json"
                trigger="loop"
                delay="1000"
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
            <<h3>We had difficulties updating the message, the teams is working on it</h3>
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
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
</body>
</html>