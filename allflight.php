<?php
require('./config/config.php');
    if(isset($_POST['senddepa']))
    {
        $from = $_POST['departure'];
        $getf = "SELECT f.*, c.namecoun as 'fromcoun', c.codecoun as 'fromcode', c1.namecoun as 'tocoun', c1.*, c1.codecoun as 'tocode' from flights f, airport a, airport a1, country c, country c1 where ((f.froma = a.idairp and a.countryid=c.idcoun) and (f.toa = a1.idairp and a1.countryid = c1.idcoun)) and (c.namecoun = '$from')";
        $res = mysqli_query($conn, $getf);

        //get all popular flight
        $popf = "SELECT cmd.flightnum, COUNT(cmd.id) as num, f.*, c.namecoun as 'fromcoun', u.username,c1.* , c1.namecoun as 'tocoun', a.nameairp as 'fromair',a1.nameairp as 'toair' from commandedf cmd, users u, flights f, airport a, airport a1, country c, country c1 where ((f.froma = a.idairp and a.countryid=c.idcoun) and (f.toa = a1.idairp and a1.countryid = c1.idcoun)) and ((cmd.flightnum = f.flightnum and cmd.iduser = u.id) and c.namecoun = '$from') GROUP BY cmd.flightnum ORDER BY num desc LIMIT 4;";
        $res2 = mysqli_query($conn, $popf);

        //get date
        $date = date("Y-m-d"); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/allflights.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <div class="from" 
    <?php 
        if(isset($_POST['senddepa']))
        {
            ?>
            style="display: none;"
            <?php
        }
    ?>>
        <div class="content">
            <div class="items">
                <h2>Hey there, where are you from?</h2>
                <lord-icon
                    src="https://cdn.lordicon.com/fihkmkwt.json"
                    trigger="loop"
                    delay="1000"
                    style="width:250px;height:250px">
                </lord-icon>
                <div class="container2">
                    <div id="search_result">
                        
                    </div>
                </div>
                <form method="post" id="form">
                    <input type="text" class="text" name="departure" onkeyup="javascript:load_data(this.value, 0);" required name="from">
                    <input type="submit" id="btn" name="senddepa" value="Search">
                </form>
            </div>
        </div>
    </div>
    <section class="hero">
        <div class="backbtn">
            <a href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                BACK
            </a>
        </div>
        <div class="half1">
            <div class="texts">
                Here some flights from your country
                <p>Enjoy the best flights with our flights</p>
            </div>
        </div>
        <div class="half2">
            <img src="./assets/fligthphone.jpg" alt="" srcset="">
        </div>
    </section>
    <section class="flights">
        <div class="popularf">
            <h3>POPULAR FLIGHTS</h3>
            <div class="flightscar">
                <ul class="list">
                    <?php
                    if(isset($res))
                    {
                        if($result->num_rows>0)
                        {
                            while($row = mysqli_fetch_assoc($res)){
                    ?>
                    <li>
                        <form action="flights.php" method="post">
                            <button type="submit">
                                <div class="card1">
                                    <img src="<?php echo $row['image']?>" alt="">
                                    <h4><?php echo $row['tocoun']?></h4>
                                    <input type="hidden" name="cin" value="<?php echo $date?>">
                                    <input type="hidden" name="arrival" value="<?php echo $row['tocoun']?>">
                                    <input type="hidden" name="departure" value="<?php echo $from?>">
                                </div>
                            </button>
                        </form>
                    </li>
                    <?php
                            }
                        }
                        else{
                    ?>
                    <h3>it looks like there is no flights from your location right now!</h3>
                    <?php
                        }
                    }
                    else{
                    ?>
                    <h3>Loading ...</h3>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="allf">
            <h3>ALL FLIGHTS</h3>
            <div class="grid">
                <ul class="list">
                    <?php
                    if(isset($res2)){
                        while($row1 = mysqli_fetch_assoc($res2))
                        {
                    ?>
                    <li>
                        <form action="flights.php" method="post">
                            <button type="submit">
                                <div class="card1">
                                    <img src="<?php echo $row1['image']?>" alt="">
                                    <h4><?php echo $row1['tocoun']?></h4>
                                    <input type="hidden" name="cin" value="<?php echo $date?>">
                                    <input type="hidden" name="arrival" value="<?php echo $row1['tocoun']?>">
                                    <input type="hidden" name="departure" value="<?php echo $from?>">
                                </div>
                            </button>
                        </form>
                    </li>
                    <?php
                        }
                    }
                    else{
                    ?>
                    <h3>Loading ...</h3>
                    <?php
                    }
                    ?>
                </ul>
               
            </div>
        </div>
    </section>
    <footer>
        <h3>Fly.Me Copyright © <?php echo date('Y')?></h3>
    </footer>

    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./script/app.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</body>
</html>