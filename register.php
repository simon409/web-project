<?php
    require('./config/config.php');
    session_start();
    if (isset($_POST['submit'])) {
        // Get the entered information
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        // Prepare and execute a SELECT statement to check if the chosen username or email is already taken
        $stmt = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";

        $user = mysqli_query($conn, $stmt);

        // If the chosen username or email is already taken, set an error message
        if (mysqli_num_rows($user) > 0) {
            $error = 'Username or email already taken';
        } else {
            //Validate the entered information
            if ($password != $password2) {
                $error = 'Passwords do not match';
            } else if(strlen($password) < 8) {
                $error = 'Password must be at least 8 characters';
            } else {
                // Hash the password
                $password = md5($password);

                // Prepare and execute an INSERT statement to insert the user's information into the database
                $stmt = $conn->prepare("INSERT INTO users(username, fullname, email, password, type) VALUES(?, ?, ?, ?, 'user')");
                $stmt->bind_param("ssss", $username, $fullname, $email, $password);
                $stmt->execute();

                // Get the user's ID
                //$user_id = $conn->lastInsertId();

                // Start a session and save the user's ID in a session variable
                //$_SESSION['user_id'] = $user_id;
                header('Location: login.php');
                exit;
            }
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
        ?>
    <div class="error">
        <?php echo '<p>' . $error . '</p>';?>
    </div>
        <?php
    } ?>
    <section class="bg_login">
        <div class="login">
            <form action="" method="post">
                <h2>Welcome!</h2>
                <h3>Make new account</h3>
                <div class="input-icons">
                    <i class="fa fa-user icon"></i>
                    <input type="text" name="username" placeholder="username">
                    <i class="fa fa-user icon"></i>
                    <input type="text" name="fullname" placeholder="Full Name">
                    <i class="fa-solid fa-envelope icon"></i>
                    <input type="text" name="email" placeholder="Email Address">
                    <i class="fa fa-lock icon"></i>
                    <input type="password" name="password" placeholder="Password">
                    <i class="fa fa-lock icon"></i>
                    <input type="password" name="password2" placeholder="Confirm Password">
                    <input type="submit" name="submit" id="btn_log" value="Sign Up">
                    <div class="signup">
                        You already have an account? <a href="login.php">Sign In</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="backhome">
            <a href="index.php">Back to home page</a>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/34ab47bcfb.js" crossorigin="anonymous"></script>
</body>
</html>

<!--This project was made by Mohamed Addar - for a school project in web development-->