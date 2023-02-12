<?php
    require('../../../config/config.php');
    
    $id = $_GET['idm'];
    //modify message status
    $query1 = "UPDATE message set status='Read' where idmessage = '$id'";
    $result = mysqli_query($conn, $query1);
    //get message infos
    $query2 = "SELECT * FROM message where idmessage = '$id'";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_fetch_assoc($result2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Message from <?php echo $row['fullname']?></title>
</head>
<body>
    <section id="inbox">
        <div class="inbox">
            <div class="header">
                <div class="line1">
                    <h2><?php echo $row['subject']?></h2>
                    <a href="../delete/deletemsg.php?idm=<?php echo $row['idmessage']?>"><i class="fa fa-trash icon"></i></a>
                </div>
                <div class="line2">
                    <p><?php echo $row['fullname']?></p>
                    <p><?php echo $row['sentat']?></p>
                </div>
            </div>
            <div class="content">
                <p>
                    <?php echo $row['message']?>
                </p>
            </div>
        </div>
    </section>
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
</body>
</html>

