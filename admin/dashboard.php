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
    else{
        header('location:index.php');
    }
    /*get all flight */
    $sql = "SELECT f.*, c.namecoun as 'fromcoun', c.codecoun as 'fromcode', c1.namecoun as 'tocoun', c1.codecoun as 'tocode', TIMEDIFF(f.arrivaltime,f.boardtime) as 'duration', a.nameairp as 'fromair', a.codeairport as 'fromaircode' , a1.nameairp as 'toair', a1.codeairport as 'toaircode' from flights f, airport a, airport a1, country c, country c1 where ((f.froma = a.idairp and a.countryid=c.idcoun) and (f.toa = a1.idairp and a1.countryid = c1.idcoun))";
    $result = $conn->query($sql);
    /*get all the countries */
    $sql2 = "SELECT * FROM country";
    $result2 = $conn->query($sql2);
    /*get all airports */
    $sql3 = "SELECT * FROM airport";
    $result3 = $conn->query($sql3);
    /*get all booked flights */
    $sql4 = "SELECT cmd.*, c.namecoun as 'fromcoun', u.username, c1.namecoun as 'tocoun', a.nameairp as 'fromair',a1.nameairp as 'toair' from commandedf cmd, users u, flights f, airport a, airport a1, country c, country c1 where ((f.froma = a.idairp and a.countryid=c.idcoun) and (f.toa = a1.idairp and a1.countryid = c1.idcoun)) and (cmd.flightnum = f.flightnum and cmd.iduser = u.id);";
    $result4 = $conn->query($sql4);
    /* get stopover */
    $sql5 = "SELECT s.*, a.nameairp FROM stopover s, airport a where s.airid=a.idairp";
    $result5 = $conn->query($sql5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                        <li><a href="javascript:menuselect(0);" class="fw-bold"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                        <li><a href="javascript:menuselect(1);" class="fw-bold"><i class="fa-solid fa-plane"></i> Show Flights</a></li>
                        <li><a href="javascript:menuselect(2);" class="fw-bold"><i class="fa-solid fa-globe"></i> Show Countries</a></li>
                        <li><a href="javascript:menuselect(3);" class="fw-bold"><i class="fa-solid fa-plane-departure"></i> Show Airports</a></li>
                        <li><a href="javascript:menuselect(4);" class="fw-bold"><i class="fa-solid fa-plane"></i> Add Flight</a></li>
                        <li><a href="javascript:menuselect(5);" class="fw-bold"><i class="fa-solid fa-globe"></i> Add Country</a></li>
                        <li><a href="javascript:menuselect(6);" class="fw-bold"><i class="fa-solid fa-plane-departure"></i> Add Airports</a></li>
                        <li><a href="javascript:menuselect(7);" class="fw-bold"><i class="fa-solid fa-plane-circle-check"></i> Flights booked</a></li>
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
                <section id="dash" class="hide">
                    <h1>Dashboard</h1>
                </section>
                <!--we will add class="hide" so we can show every page at once-->
                <section id="showf" class="hide">
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
                                    <a href="operations/delete/deletef.php?id=<?php echo $flight['flightnum']?>"><i class="fa-solid fa-trash"></i></a>
                                    <a href="operations/modify/editf.php?id=<?php echo $flight['flightnum']?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
                    </div>
                </section>
                <section id="showc" class="hide">
                    <h2>List of available Countries</h2>
                    <div id="tablescroll" style="height: 600px;overflow-y: scroll;">
                        <table class="table table-bordered table-striped mt-5">
                            <thead>
                                <tr>
                                <th scope="col">CountryID</th>
                                <th scope="col">Country name</th>
                                <th scope="col">Country CODE</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($result2->num_rows>0)
                            {
                                foreach ($result2 as $country) {
                                    ?>
                                <tr>
                                <th scope="row"><?php echo $country['idcoun']?></th>
                                <td><?php echo $country['namecoun']?></td>
                                <td><?php echo $country['codecoun']?></td>
                                <td class="action">
                                    <a href="operations/delete/deletec.php?id=<?php echo $country['idcoun']?>"><i class="fa-solid fa-trash"></i></a>
                                    <a href="operations/modify/editc.php?id=<?php echo $country['idcoun']?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
                    </div>
                </section>
                <section id="showa" class="hide">
                    <h2>List of available Airports</h2>
                    <div id="tablescroll" style="height: 600px;overflow-y: scroll;">
                        <table class="table table-bordered table-striped mt-5">
                            <thead>
                                <tr>
                                <th scope="col">AirportID</th>
                                <th scope="col">Airport name</th>
                                <th scope="col">Airport CODE</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($result3->num_rows>0)
                            {
                                foreach ($result3 as $airport) {
                                    ?>
                                <tr>
                                <th scope="row"><?php echo $airport['idairp']?></th>
                                <td><?php echo $airport['nameairp']?></td>
                                <td><?php echo $airport['codeairport']?></td>
                                <td class="action">
                                    <a href="operations/delete/deletea.php?id=<?php echo $airport['idairp']?>"><i class="fa-solid fa-trash"></i></a>
                                    <a href="operations/modify/edita.php?id=<?php echo $airport['idairp']?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
                    </div>
                </section>
                <section id="addf" class="hide">
                    <h1>Add Flight</h1>
                    <div class="formdiv">
                        <form action="/operations/add/addflight.php" method="POST">
                            <div class="form">
                                <table class="mt-4">
                                    <tr>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Departure Airport</label>
                                                <select name="forma" class="form-control form-control-lg">
                                                <?php
                                                if($result3->num_rows>0)
                                                {
                                                    foreach ($result3 as $airport) {
                                                ?>
                                                    <option value="<?php echo $airport['idairp']?>"><?php echo $airport['nameairp'].' - '.$airport['codeairport'] ?></option>
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
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example27">Destination Airport</label>
                                                <select name="forma" class="form-control form-control-lg">
                                                <?php
                                                if($result3->num_rows>0)
                                                {
                                                    foreach ($result3 as $airport) {
                                                ?>
                                                    <option value="<?php echo $airport['idairp']?>"><?php echo $airport['nameairp'].' - '.$airport['codeairport'] ?></option>
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
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-inline mb-4">
                                                <input class="form-check-input" type="radio" checked name="stopover" onclick="hidestopmenu();" id="inlineRadio1" value="option1">
                                                <label class="form-check-label" for="inlineRadio1">No Stopover</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input class="form-check-input" type="radio" onclick="showstopmenu();" name="stopover" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2">Contains Stopover</label>
                                            </div>
                                            <div class="form-outline mb-4 hide" id="stopo">
                                                <label class="form-label" for="form2Example27">Select stopover</label>
                                                <select name="toa" class="form-control form-control-lg mb-4">
                                                    <?php
                                                    if($result5->num_rows>0)
                                                    {
                                                        foreach ($result5 as $stopover) {
                                                    ?>
                                                        <option value="<?php echo $stopover['idstop']?>"><?php echo $stopover['nameairp'].' - '.$stopover['arrival'].' -> '.$stopover['departure'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    else{
                                                    ?>
                                                        <tr>
                                                            <td colspan="5">No stopover available</td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <div class="form-check form-check-inline p-0">
                                                    <a href="./operations/add/addstopover.php" class="btn btn-primary btn-lg btn-block" name="submit" target="_blank" rel="noopener noreferrer" type="submit">Add Stop Overs</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Seats Available in flight</label>
                                                <input type="number" id="username" name="username" class="form-control form-control-lg" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Price for adults</label>
                                                <input type="number" id="username" name="username" class="form-control form-control-lg" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Price for children</label>
                                                <input type="number" id="username" name="username" class="form-control form-control-lg" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Departure time</label>
                                                <input type="time" id="username" name="username" class="form-control form-control-lg" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Arrival time</label>
                                                <input type="time" id="username" name="username" class="form-control form-control-lg" />
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                
                                <div class="pt-1 mb-4">
                                    <a class="btn btn-dark btn-lg btn-block" name="submit" type="submit">Add flight</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <section id="addc" class="hide">
                    <h1>Add Country</h1>
                    <form action="/operations/add/addcountry.php">
                        <div class="half mt-5">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example17">Country Name</label>
                                <input type="text" id="counname" name="counname" class="form-control form-control-lg" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example17">Country Code</label>
                                <input type="text" id="councode" name="councode" class="form-control form-control-lg" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example17">Country Image url</label>
                                <input type="url" id="imagecoun" name="imagecoun" class="form-control form-control-lg" />
                            </div>
                            <div class="pt-1 mb-4">
                                <a class="btn btn-dark btn-lg btn-block" name="submit" type="submit">Add Country</a>
                            </div>
                        </div>
                    </form>
                </section>
                <section id="adda" class="hide">
                    <h1>Add Airport</h1>
                    <form action="/operations/add/addairp.php">
                        <div class="half mt-5">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example17">Airport Name</label>
                                <input type="text" id="counname" name="counname" class="form-control form-control-lg" />
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example17">Airport Code</label>
                                <input type="text" id="councode" name="councode" class="form-control form-control-lg" />
                            </div>
                            <div class="form-outline mb-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Country</label>
                                    <select name="forma" class="form-control form-control-lg">
                                                <?php
                                                if($result2->num_rows>0)
                                                {
                                                    foreach ($result2 as $country) {
                                                ?>
                                                    <option value="<?php echo $country['idcoun']?>"><?php echo $country['namecoun'] ?></option>
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
                                                </select>
                                </div>
                            </div>
                            <div class="pt-1 mb-4">
                                <a class="btn btn-dark btn-lg btn-block" name="submit" type="submit">Add Country</a>
                            </div>
                        </div>
                    </form>
                </section>
                <section id="showbooked">
                    <h1>Show booked fligths</h1>
                    <div id="tablescroll" style="height: 600px;overflow-y: scroll;">
                        <table class="table table-bordered table-striped mt-5">
                            <thead>
                                <tr>
                                <th scope="col">OrderID</th>
                                <th scope="col">Flight Departure</th>
                                <th scope="col">Flight Arrival</th>
                                <th scope="col">Person</th>
                                <th scope="col">Number Adult</th>
                                <th scope="col">Number Children</th>
                                <th scope="col">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($result4->num_rows>0)
                            {
                                foreach ($result4 as $orderf) {
                                    ?>
                                <tr>
                                <th scope="row"><?php echo $orderf['id']?></th>
                                <td><?php echo $orderf['fromair']?></td>
                                <td><?php echo $orderf['toair']?></td>
                                <td><?php echo $orderf['username']?></td>
                                <td><?php echo $orderf['numt_adult']?></td>
                                <td><?php echo $orderf['numt_child']?></td>
                                <td><?php echo $orderf['totalprice']?></td>
                                </tr>
                            <?php
                                }
                            }
                            else{
                            ?>
                                <tr>
                                    <td colspan="5">No Orders available</td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <script src="./script/script.js"></script>
</body>
</html>