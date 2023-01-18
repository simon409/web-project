<?php
    require('../config/config.php');
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: index.php');
        exit;
    }
    if (isset($_SESSION['admin_id'])) {
        $id = $_SESSION['admin_id'];
        // Prepare and execute a SELECT statement to check the entered credentials
        $query1 = "SELECT username FROM users WHERE id = '$id'";
        $userquery = mysqli_query($conn, $query1);
        $user = mysqli_fetch_assoc($userquery);

        // If the entered credentials match, start a session and save the user's ID in a session variable
        if ($user) {
            $username = $user['username'];
        }
    }
    /*get all flight */
    $sql = "SELECT f.flightnum, f.boardtime, c.namecoun as 'tocoun', c.codecoun as 'tocode', c1.namecoun as 'fromcoun', c1.codecoun as 'fromcode' FROM flights f, country c, country c1 where f.tol = c.idcoun and f.froml = c1.idcoun;";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <main>
        <div class="menu">
            <div class="menuitems">
                <div class="logo">
                    <h2 class="h1 fw-bold mb-0 text-center"><span class="firsthalf">Fly.</span>Me</h2>
                </div>
                <div class="menui">
                    <ul>
                        <li><a href="#" class="fw-bold"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                        <li><a href="#" class="fw-bold"><i class="fa-solid fa-plane"></i> Show Flights</a></li>
                        <li><a href="#" class="fw-bold"><i class="fa-solid fa-globe"></i> Show Countries</a></li>
                        <li><a href="#" class="fw-bold"><i class="fa-solid fa-plane-departure"></i> Show Airports</a></li>
                        <li><a href="#" class="fw-bold"><i class="fa-solid fa-plane"></i> Add Flight</a></li>
                        <li><a href="#" class="fw-bold"><i class="fa-solid fa-globe"></i> Add Country</a></li>
                        <li><a href="#" class="fw-bold"><i class="fa-solid fa-plane-departure"></i> Add Airports</a></li>
                        <li><a href="#" class="fw-bold"><i class="fa-solid fa-plane-circle-check"></i> Flights booked</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="header">
                <div class="time">
                    <?php echo '<h5 class="fw-bold">'.date("F j, Y, g:i a").'</h5>';?>
                </div>
                <div class="user">
                    <a href="#"><i class="fa-solid fa-message"></i></a>
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
            </div>
            <div class="pages">
                <section id="main">

                </section>
                <!--we will add class="hide" so we can show every page at once-->
                <section id="showf">
                    <h2>List of available flights</h2>
                    <div id="tablescroll" style="height: 600px;overflow-y: scroll;">
                        <table class="table table-bordered table-striped mt-5">
                            <thead>
                                <tr>
                                <th scope="col">FlightNum</th>
                                <th scope="col">Flight Departure</th>
                                <th scope="col">Flight Arrival</th>
                                <th scope="col">Boarding Time</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($result->num_rows>0)
                            {
                                foreach ($result as $flight) {
                                    ?>
                                <tr>
                                <th scope="row"><?php echo $flight['flightnum']?></th>
                                <td><?php echo $flight['fromcoun']?></td>
                                <td><?php echo $flight['tocoun']?></td>
                                <td><?php echo $flight['boardtime']?></td>
                                <td class="action">
                                    <a href="operations/deletef.php?id=<?php echo $flight['flightnum']?>"><i class="fa-solid fa-trash"></i></a>
                                    <a href="operations/editf.php?id=<?php echo $flight['flightnum']?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                                </tr>
                            <?php
                                }
                            }
                            else{
                            ?>
                                <tr>
                                    <td colspan="5">No flights available</td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </style=>
                </section>
            </div>
        </div>
        
    </main>
    <script src="../script/app.js"></script>
</body>
</html>