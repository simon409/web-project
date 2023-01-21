<?php
    require('./config/config.php');
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $query = "DELETE FROM card where id = $id";
        $result = mysqli_query($conn, $query);
        header("location:proceed.php");
    }
    else {
        header("location:proceed.php");
    }
?>