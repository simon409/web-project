<?php
    require('./config/config.php');
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: login.php');
        exit;
    }
    $uid = $_SESSION['user_id'];
    $query = "SELECT * FROM users where id = $uid";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);

    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        // Prepare and execute a SELECT statement to check the cart items
        $querygetcard1 = "SELECT c.*, ct.namecoun FROM card c, flights f, country ct, airport a WHERE iduser = '$id' and (c.flightnum=f.flightnum and (f.toa = a.idairp and a.countryid = ct.idcoun));";
        $cardquery1 = $conn->query($querygetcard1);
        if (isset($_GET['proceed'])) {
            proceed($id);
        }
    }
    else{
        header("location:login.php");
    }

    function proceed($id){
        //add some function to check available site
        $querycopytocomm = "INSERT INTO commandedflights SELECT * FROM card WHERE iduser=$id";
        $cardquery2 = $conn->query($querycopytocomm);
        //add some function to reduce available places
        $deletefromcard = "DELETE FROM card WHERE iduser = '$id'";
        $cardquery3 = $conn->query($deletefromcard);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/user.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Welcome ...</title>
</head>
<body>
    <section>
        <div class="menu">
            <div class="salut">
                <h3>Welcome Mr.</h3>
                <h2><?php echo $row['fullname']?></h2>
            </div>
            <ul>
                <li><a href="#">Check Cart</a></li>
                <li><a href="#">Check Ordered Flights</a></li>
                <li><a href="#">Your infos</a></li>
                <li><a href="?logout=true">Sign out</a></li>
            </ul>
            <div class="logo">
                <h2>Fly.Me</h2>
            </div>
        </div>
        <div class="content">
            <!--User Cart-->
            <div class="custom">
                <h2>Proeed to check out</h2>
                <div class="m-4">
                    <ul class="list-unstyled list-group">
                    <?php
                        while($card = mysqli_fetch_assoc($cardquery1))
                        {
                        ?>
                        <li class="carditem flex flex-row card p-4 justify-content-between mb-2">
                            <div class="infos">
                                Flight to <?php echo $card['namecoun']?> | <?php echo $card['numt_adult']." Person"; 
                                if ($card['numt_child']>0){
                                    echo " and ".$card['numt_child']." Child";
                                }
                                ?>
                            </div>
                            <div class="action">
                                <a class="delete_data" id="<?php echo $card['id']?>"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </li>
                        <?php
                            }
                            if($cardquery1->num_rows>0){
                                ?>
                                    
                                <?php
                            }
                            else {
                                echo '<li class="carditem flex flex-row card p-4 justify-content-between mb-2">'. "Your cart is empty".'</li>';
                            }
                        ?>
                    </ul>
                    <div class="confirm">
                        <a href="?proceed=true">Confirm Purchase</a>
                    </div>
                </div>
            </div>
            
            <!--User Order-->
            <div class="custom hide">
                <h2>Your Orders</h2>
                <div class="m-4">
                    <ul class="list-unstyled list-group">
                    <?php
                        while($card = mysqli_fetch_assoc($cardquery1))
                        {
                        ?>
                        <li class="carditem flex flex-row card p-4 justify-content-between mb-2">
                            <div class="infos">
                                Flight to <?php echo $card['namecoun']?> | <?php echo $card['numt_adult']." Person"; 
                                if ($card['numt_child']>0){
                                    echo " and ".$card['numt_child']." Child";
                                }
                                ?>
                            </div>
                            <div class="action">
                                <a href="#"><i class="fa-solid fa-print"></i></a>
                                <a class="delete_data" id="<?php echo $card['id']?>"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </li>
                        <?php
                            }
                            if($cardquery1->num_rows>0){
                                ?>
                                    
                                <?php
                            }
                            else {
                                echo '<li class="carditem flex flex-row card p-4 justify-content-between mb-2">'. "You haven't made any order yet!".'</li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <!--User Infos-->
            
        </div>
    </section>
</body>
</html>