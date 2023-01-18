<?php
    require('./config/config.php');
    session_start();
    if (isset($_POST['submit'])) {
        // Get the entered username and password
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Prepare and execute a SELECT statement to check the entered credentials
        $query = "SELECT id FROM users WHERE type='user' AND (username = '$username' AND password = '$password')";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        // If the entered credentials match, start a session and save the user's ID in a session variable
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid username or password';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php if (isset($error)) {
            echo '<p>' . $error . '</p>';
        } ?>
    <section class="bg_login">
        <div class="login">
            <form action="" method="post">
                <h2>Welcome back!</h2>
                <h3>Sign in to your account</h3>
                <div class="input-icons">
                    <i class="fa fa-user icon"></i>
                    <input type="text" name="username" placeholder="Login">
                    <i class="fa fa-lock icon"></i>
                    <input type="password" name="password" placeholder="Password">
                    <a href="#" class="forgotpass">Forgot password?</a>
                    <input type="submit" name="submit" name="password" id="btn_log" value="Sign In">
                    <div class="signup">
                        You don't have an account ? <a href="register.php">Sign Up</a>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <div class="connwithsocial">
                    <i class="fa-brands fa-facebook"></i>
                    <a href="#"><h5 id="texticon">Connect with Facebook</h5></a>
                    <img src="./assets/google.svg">
                    <a href="#"><h5 id="texticon">Connect with Google</h5></a>
                    <i class="fa-brands fa-apple"></i>
                    <a href="#"><h5 id="texticon">Connect with Appel</h5></a>
                </div>
            </form>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/34ab47bcfb.js" crossorigin="anonymous"></script>
</body>
</html>