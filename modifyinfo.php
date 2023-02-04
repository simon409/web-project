<?php
    require('./config/config.php');
    session_start();

    $uid = $_SESSION['user_id'];
    $query = "SELECT * FROM users where id = $uid";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);

    $fullname = $_POST['fullname'];
    $mail = $_POST['mail'];
    $phonenum = $_POST['phonenum'];

    $updatequery = "UPDATE users SET fullname = '$fullname', email = '$mail', phone_num = '$phonenum' where id = $uid";

    if (isset($_POST['actpass'])&& isset($_POST['newp']) && isset($_POST['confnewp'])) {
        $pass = md5($_POST['newp']);
        $passconf = md5($_POST['confnewp']);
        if ($pass == $passconf) {
            $updatequery = "UPDATE users SET fullname = '$fullname', email = '$mail', phone_num = '$phonenum', password='$pass' where id = $uid";
        }
    }

    $update = mysqli_query($conn, $updatequery);
    $_SESSION['message'] = "You have modified you infos with success";

    header("location: user.php");
?>