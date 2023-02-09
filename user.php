<?php
    require('./config/config.php');
    session_start();

    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    else {
        $message = "";
    }

    $_SESSION['previous_url']=$_SERVER['PHP_SELF'];
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
        $querygetcard1 = "SELECT c.*, (c.numt_adult+c.numt_child) as totalt, ct.namecoun FROM card c, flights f, country ct, airport a WHERE iduser = '$id' and (c.flightnum=f.flightnum and (f.toa = a.idairp and a.countryid = ct.idcoun));";
        $cardquery1 = $conn->query($querygetcard1);
        // get all commanded items
        $querygetordered = "SELECT cmd.*, c.namecoun as 'fromcoun', u.username, c1.namecoun as 'tocoun', a.nameairp as 'fromair',a1.nameairp as 'toair' from commandedf cmd, users u, flights f, airport a, airport a1, country c, country c1 where (((f.froma = a.idairp and a.countryid=c.idcoun) and (f.toa = a1.idairp and a1.countryid = c1.idcoun)) and (cmd.flightnum = f.flightnum and cmd.iduser = u.id)) and cmd.iduser = $id;";
        $orderquery = $conn->query($querygetordered);
        if (isset($_GET['proceed'])) {
            //add some function to check available seats
            while($card1 = mysqli_fetch_assoc($cardquery1))
            {
                $flightid = $card1['flightnum'];
                $cartid = $card1['id'];
                $seats_requested = $card1['totalt'];
                $getflight = "SELECT * FROM flights WHERE flightnum = '$flightid'";
                $fgetquery = mysqli_query($conn, $getflight);
                $flight = mysqli_fetch_assoc($fgetquery);
                $seats_available = $flight['seats_available'];
                $seat_taken = $flight['seats_taken'];
                if ($seats_available >= $seats_requested) {
                    $querycopytocomm = "INSERT INTO commandedf SELECT * FROM card WHERE iduser=$id";
                    $cardquery2 = mysqli_query($conn, $querycopytocomm);
                    //add some function to reduce available places
                    $new_seats_available = $seats_available - $seats_requested;
                    $new_seats_taken = $seat_taken + $seats_requested;
                    $update_query = "UPDATE flights SET seats_available = $new_seats_available, seats_taken = $new_seats_taken WHERE flightnum = $flightid";
                    mysqli_query($conn, $update_query);
                    //delete from cart
                    $deletefromcard = "DELETE FROM card WHERE iduser = '$id' and id=$cartid";
                    $cardquery3 = $conn->query($deletefromcard);
                }
                else {
                    $error = "You can't book this flight, seats are full!!";
                }
            }
            //end check available
        }
    }
    else{
        header("location:login.php");
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
                <li><a href="javascript:menuselect(0);">Check Cart</a></li>
                <li><a href="javascript:menuselect(1);">Check Ordered Flights</a></li>
                <li><a href="javascript:menuselect(2);">Your infos</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="?logout=true">Sign out</a></li>
            </ul>
            <div class="logo">
                <h2>Fly.Me</h2>
            </div>
        </div>
        <div class="content">
            <!--User Cart-->
            <div id="cart" class="custom hide">
                <h2>Proceed to check out</h2>
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
                            <?php
                            }
                            ?>
                        </li>
                        <?php
                            if($cardquery1->num_rows>0){
                                ?>
                                    
                                <?php
                            }
                            else {
                                echo '<li class="carditem flex flex-row card p-4 justify-content-between mb-2">'. "Your cart is empty".'</li>';
                            }
                        ?>
                    </ul>
                    <?php
                    if($cardquery1->num_rows>0){
                        ?>
                            <div class="confirm">
                                <a href="?proceed=true">Confirm Purchase</a>
                            </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <!--User Order-->
            <div id="booked" class="custom hide">
                <h2>Your Orders</h2>
                <div class="m-4">
                    <table class="table table-bordered table-striped mt-5 text-center">
                    <thead>
                        <tr>
                            <th scope="col">Flight Departure</th>
                            <th scope="col">Flight Arrival</th>
                            <th scope="col">Number Adult</th>
                            <th scope="col">Number Children</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($order = mysqli_fetch_assoc($orderquery))
                        {
                        ?>
                            <tr>
                                <td><?php echo $order['fromcoun']?></td>
                                <td><?php echo $order['tocoun']?></td>
                                <td><?php echo $order['numt_adult']?></td>
                                <td><?php echo $order['numt_child']?></td>
                                <td><?php echo $order['totalprice']?></td>
                                <td>
                                    <a href="printticket.php?idt=<?php echo $order['id']?>"><i class="fa-solid fa-print"></i></a>
                                </td>
                            </tr>
                        <?php
                            }
                            if($orderquery->num_rows>0){
                                ?>
                                    
                                <?php
                            }
                            else {
                                echo '<li class="carditem flex flex-row card p-4 justify-content-between mb-2">'. "You haven't made any order yet!".'</li>';
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <!--User Infos-->
            <div id="info" class="custom">
                <h2>Your Infos</h2>
                <form action="modifyinfo.php" method="post">
                    <table class="mt-5 table">
                        <?php
                        if ($message!="") {
                        ?>
                        <tr>
                            <td colspan="2">
                                <div class="form-outline p-2" style="background-color: #A8DADC; border: #1D3557 solid 1px; color: #1D3557; border-radius: 15px;">
                                    <?php
                                        echo $message;
                                     ?>
                                </div>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Your username (not changeable)</label>
                                    <input type="text" id="username" name="username" value="<?php echo $row['username']?>" value="username" class="form-control form-control-lg" readonly/>
                                </div>
                            </td>
                            <td>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Full Name</label>
                                    <input type="text" id="fullname" name="fullname" value="<?php echo $row['fullname']?>" class="form-control form-control-lg"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Address Email</label>
                                    <input type="text" id="mail" name="mail" value="<?php echo $row['email']?>" class="form-control form-control-lg"/>
                                </div>
                            </td>
                            <td>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Phone Number</label>
                                    <input type="tel" id="phonenum" value="<?php echo $row['phone_num']?>" name="phonenum" class="form-control form-control-lg"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h5 class="text-center py-5">If you want to change your password just write your actual password below and change it</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Actual Password</label>
                                    <input type="hidden" name="pass" id="passact" value="<?php echo $row['password'];?>">
                                    <input type="password" autocomplete="off" id="actpass" onkeyup="enablepass();" name="actpass" class="form-control form-control-lg"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">New Password</label>
                                    <input type="password" id="newp" name="newp" class="form-control form-control-lg" disabled/>
                                </div>
                            </td>
                            <td>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Confirm Password</label>
                                    <input type="password" id="confnewp" name="confnewp" class="form-control form-control-lg" disabled/>
                                </div>
                            </td>
                        </tr>
                        
                    </table>
                    <div class="pt-1 mb-4">
                        <input value="Confirm" class="btn btn-dark btn-lg btn-block" name="modify" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="./script/app.js"></script>
</body>
</html>