<?php
    require_once('./config/config.php');

    if (isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['subject']) && isset($_POST['message'])) {
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $query = "INSERT into message (fullname, email, subject, message) values ('$name', '$mail', '$subject', '$message')";
        $res = mysqli_query($conn, $query);
    } else {
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/addtocart.css">
    <title>Congratulations 🥳</title>
</head>
<body>
<?php
    if (true) {
        ?>
        <div class="celebrate">
            <h1>Congrats</h1>
            <h3>You have sent the message, we will get to you shortly!</h3>
            <lord-icon
                src="https://cdn.lordicon.com/pdpnqfoe.json"
                trigger="loop"
                delay="1000"
                colors="primary:#1375ad,secondary:#ebe6ef"
                style="width:250px;height:250px">
            </lord-icon><br>
            <div class="btn">
                <a href="index.php">Back to home page</a>
            </div>
        </div>
        <?php
    }
    else{
    ?>
        <div class="celebrate">
            <h1>Oops</h1>
            <<h3>We had difficulties adding the Airport to your website, our teams is working on it</h3>
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