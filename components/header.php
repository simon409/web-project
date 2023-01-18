<?php
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: login.php');
        exit;
    }
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        // Prepare and execute a SELECT statement to check the entered credentials
        $query1 = "SELECT username FROM users WHERE id = '$id'";
        $userquery = mysqli_query($conn, $query1);
        $user = mysqli_fetch_assoc($userquery);

        // If the entered credentials match, start a session and save the user's ID in a session variable
        if ($user) {
            $username = $user['username'];
        }

        $querygetcard = "SELECT c.*, ct.namecoun FROM card c, flights f, country ct WHERE iduser = '$id' and (c.flightnum=f.flightnum and f.tol=ct.idcoun);";
        $cardquery = $conn->query($querygetcard);
    }
?>
<header id="header">
        <div class="nav1">
            <div class="logo">
                <h2><strong>Fly.</strong>Me</h2>
            </div>
            <ul>
                <li class="nav-item"><a href="index.php">Home</a></li>
                <li class="nav-item"><a href="#">Flights</a></li>
                <li class="nav-item"><a href="#">About</a></li>
                <li class="nav-item"><a href="#">Contact us</a></li>
            </ul>
            <?php
                if (isset($_SESSION['user_id'])) {
            ?>
            <div class="logged">
                <div class="card rounded-circle">
                    <?php
                        if($cardquery->num_rows>0){
                            ?>
                            <div class="dote">
                                
                            </div>
                            <?php
                        }
                    ?>
                    <button id="showc" type="button" onclick="togglemenucard();"><i class="fa-solid fa-cart-shopping"></i></button>
                    <div id="menucard" class="listcard">
                        <ul>
                            <?php
                                while($card = mysqli_fetch_assoc($cardquery))
                                {
                            ?>
                            <li class="carditem">
                                Flight to <?php echo $card['namecoun']?> | <?php echo $card['numt_adult']." Person"; 
                                if ($card['numt_child']>0){
                                    echo " and ".$card['numt_child']." Child";
                                }
                                ?>
                                </li>
                                <hr style="margin-left: 10%; margin-right: 10%;">
                            <?php
                                }
                                if($cardquery->num_rows>0){
                                    ?>
                                        <li><a id="proceed" href="user.php">Proceed to check out</a></li>
                                    <?php
                                }
                                else {
                                    echo '<li>'. "Your cart is empty".'</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="account">
                    <button id="showl" type="button" onclick="togglemenu();"><i class="fa-solid fa-user"></i></button>
                    <div id="menu" class="list">
                        <ul>
                            <li><a id="user" href="user.php"><?php echo $username?></a></li>
                            <li><a id="logout" href="?logout=true">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            }
            else {

            ?>
            <div class="register">
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            </div>
            <?php
                }
            ?>
        </div>
        <script src="../script/app.js"></script>
</header>