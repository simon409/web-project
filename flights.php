<?php 
    require('./config/config.php');
    $from = $_POST["departure"];
    $to = $_POST["arrival"];
    $sql = "SELECT f.flightnum, f.boardtime, c.couname as 'tocoun', c.councode as 'tocode', c1.couname as 'fromcoun', c1.councode as 'fromcode' FROM flights f, city c, city c1 where (f.tol in (select c.numcoun from city where c.couname = '$to') and f.froml in (select c1.numcoun from city where c1.couname = '$from')) and f.tol = c.numcoun;";
    $result = $conn->query($sql);

    //getting the image for the background
    $query2 = "SELECT img_url from city where couname='$to'";
    $result1 = mysqli_query($conn, $query2);
    // Get the image URL from the result
    $row = mysqli_fetch_assoc($result1);
    $image_url = $row['img_url'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Flights to <?php echo $_POST['arrival']?>
    </title>
    <link rel="stylesheet" href="./style/styleflight.css">
</head>

<body onscroll="test()">
    <?php
        include('./components/header.php') 
    ?>
    <section id="main" style="
    background: linear-gradient(rgba(241, 250, 238) 10%, rgba(241, 250, 238, 0.4)),url('<?php echo $image_url?>');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    ">
        <div>
            <p style="display: none;">Picture by someone on unsplash</p>
        </div>
        <div class="infos">
            <h1>Fligths to <?php echo $_POST['arrival']?></h1>
            <h2>Here are our flights to your destination</h2>
        </div>
        <div class="shwf">
            <a href="#flights">
                View flights
            </a>
        </div>
    </section>
    <section>
        <div class="options">
            <form action="flights.php" id="form" method="POST">
                <div class="container1">
                    <div class="card1">
                        <h5>Departure</h5>
                        <input type="text" name="departure" placeholder="Departure"  value="<?php echo $_POST['departure']?>" onkeyup="javascript:load_data(this.value, 0);" required>
                    </div>
                    <div class="card1">
                        <h5>Destination</h5>
                        <input type="text" name="arrival" placeholder="Country" value="<?php echo $_POST['arrival']?>" onkeyup="javascript:load_data(this.value, 1);" required>
                    </div>
                    <!--<div class="card1">
                        <h5>People</h5>
                        <div class="people">
                            <input type="text" name="personnum" id="person" value="<?php echo $_POST['personnum']?>"
                                readonly required>
                            <div class="incdec">
                                <a onclick="incr(0);">More</a>
                                <a onclick="incr(1);">Less</a>
                            </div>
                        </div>
                    </div>-->
                    <div class="card1">
                        <h5>Check in</h5>
                        <input type="date" name="cin" value="<?php echo $_POST['cin']?>" required>
                    </div>
                    <div class="card1">
                        <input type="submit" class="bookn" value="Update flights" />
                    </div>
                </div>
            </form>
            <div class="container2">
                <div id="search_result">
                    
                </div>
                <div id="search_result2">
                    
                </div>
                <div id="search_result3">
                    b
                </div>
                <div id="search_result3">
                    c
                </div>
            </div>
        </div>
        <div class="listf" id="flights">
            <div class="title">
                <h2>Fligths to <?php echo $_POST['arrival']?></h2>
            </div>
            <?php
                if($result->num_rows>0)
                {
                    foreach ($result as $flight) {
                        ?>
                        <div class="flightitem">
                            <div class="part1">
                                <div class="codes">
                                    <h5><?php echo $flight['fromcode'] ?></h5>
                                    <h5>|</h5>
                                    <h5>|</h5>
                                    <h5>|</h5>
                                    <h5>|</h5>
                                    <h5>|</h5>
                                    <h5>|</h5>
                                    <h5><?php echo $flight['tocode'] ?></h5>
                                </div>
                            </div>
                            <div class="details">
                                <div class="header1">
                                    <h2><strong>Flight: </strong><?php echo $flight['flightnum'] ?></h2>
                                    <h2><strong>Date: </strong><?php echo $_POST['cin']?></h2>
                                </div>
                                <div class="finfos">
                                    <div class="pt1">
                                        <h2><strong>FROM: </strong><?php echo $flight['fromcoun'] ?></h2>
                                        <h2><strong>TO: </strong><?php echo $flight['tocoun'] ?></h2>
                                    </div>
                                    <div class="pt2">
                                        <h2><strong>Boarding Time</strong></h2>
                                        <h2><?php echo $flight['boardtime'] ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="book">
                                <div class="det">
                                    <a href="fdetails.php?id=<?php echo $flight['flightnum'] ?>">View details</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                else {
                    ?>
                        <div class="nores">
                            Oops! it looks like there no flights right now
                        </div>
                    <?php
                }
            ?>
        </div>
    </section>

    <!--adding the script file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./script/app.js"></script>
</body>

</html>