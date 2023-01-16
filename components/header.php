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
            <div class="account">
                <button id="showl" type="button"><i class="fa-solid fa-user"></i></button>
                <div id="menu" class="list">
                    <ul>
                        <li><a id="logout" href="user.php"><?php echo $username?></a></li>
                        <li><a id="logout" href="?logout=true">Log out</a></li>
                    </ul>
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
</header>