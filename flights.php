<?php 
    require('./config/config.php');
    if (isset($_POST["departure"]) && isset($_POST["arrival"])) {
        $from = $_POST["departure"];
        $to = $_POST["arrival"];
        $sql = "SELECT f.*, c.namecoun as 'fromcoun', c.codecoun as 'fromcode', c1.namecoun as 'tocoun', c1.codecoun as 'tocode' from flights f, airport a, airport a1, country c, country c1 where ((f.froma = a.idairp and a.countryid=c.idcoun) and (f.toa = a1.idairp and a1.countryid = c1.idcoun)) and (c.namecoun = '$from' and c1.namecoun='$to')";
        $result = $conn->query($sql);

        //getting the image for the background
        $query2 = "SELECT image from country where namecoun='$to'";
        $result1 = mysqli_query($conn, $query2);
        // Get the image URL from the result
        $row = mysqli_fetch_assoc($result1);
        $image_url = $row['image'];
    }
    else {
        header('location: index.php');
    }
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
    <link rel="stylesheet" href="./style/header_foot.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <div class="card1">
                        <h5>Check in</h5>
                        <input type="date" name="cin" value="<?php echo $_POST['cin']?>" required>
                    </div>
                    <div class="card1">
                        <input type="submit" name="submit" class="bookn" value="Update flights" />
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
                                    <a href="fdetails.php?id=<?php echo $flight['flightnum']?>&date=<?php echo $_POST['cin']?>">View details</a>
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

<!--this is a school project in web development - https://github.com/simon409/web-project -->