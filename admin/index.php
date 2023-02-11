<?php
    require('../config/config.php');
    session_start();
    if (isset($_POST['submit'])) {
        // Get the entered username and password
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Prepare and execute a SELECT statement to check the entered credentials
        $query = "SELECT id FROM users WHERE type='admin' AND (username = '$username' AND password = '$password')";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        // If the entered credentials match, start a session and save the user's ID in a session variable
        if ($user) {
            $_SESSION['admin_id'] = $user['id'];
            header('Location: dashboard.php');
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login admin page</title>
    <style>
        .logo{
            color: #1D3557;
        }
        .firsthalf{
            color: #E63946;
        }
    </style>
</head>
<body>
    <?php 
        if (isset($error)) {
            echo '<p>' . $error . '</p>';
        } 
    ?>
    <section class="vh-100" style="background-color: #457B9D;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div style="position: absolute; width: fit-content; top:90%; left: 50%; transform: translateX(-50%); font-weight: 500;">
            <a href="../index.php" class="bg-white p-2 d-inline text-decoration-none rounded">Back to Site web</a>
        </div>
        <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://images.unsplash.com/photo-1487553333251-6c8e26d3dc2c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                    <form action="" method="POST">
                    <div class="d-flex align-items-center mb-3 pb-1">
                        <span class="h1 fw-bold mb-0 logo"> <span class="firsthalf">Fly.</span>Me</span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Welcome back admin!</h5>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Username</label>
                        <input type="text" id="username" name="username" class="form-control form-control-lg" />
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Password</label>
                        <input type="password" id="pawd" name="password" class="form-control form-control-lg" />
                    </div>

                    <div class="pt-1 mb-4">
                        <button class="btn btn-dark btn-lg btn-block" name="submit" type="submit">Login</button>
                    </div>
                    </form>

                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
</body>
</html>

<!--This project was made by Mohamed Addar - for a school project in web development-->