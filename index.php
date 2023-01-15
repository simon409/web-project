<?php 
    require('./config/config.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--linking the css file-->
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/header_foot.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Fly.Me Feel the sky</title>
</head>

<body onscroll="test(0)">
    <?php include('./components/header.php') ?>
    <section id="hero">
        <div class="half2">
            <div class="container">
                <h1>Travel</h1>
                <h2>Sale &nbsp;<span>50%</span></h2>
                <h3>So what's your next destination?</h3>
                <h4>Enjoy the best travels with our lines, feel the sky!</h4>
                <div class="viewcont">
                    <a id="view" href="#">View More</a>
                </div>
            </div>
        </div>
        <div class="half1">
            <div class="container">
                <img src="./assets/plane3d.png" width="600" alt="">
            </div>
        </div>
    </section>
    <section id="book">
        <div class="menu">
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
            <form action="flights.php" method="POST">
                <div class="container1">
                    <div class="card1">
                        <h5>Departure</h5>
                        <input type="text" name="departure" placeholder="Departure" autocomplete="off" onkeyup="javascript:load_data(this.value, 0);" required>
                    </div>
                    <div class="card1">
                        <h5>Arrival</h5>
                        <input type="text" name="arrival" placeholder="Arrival" autocomplete="off" onkeyup="javascript:load_data(this.value, 1);" required>
                    </div>
                    <!--<div class="card1">
                        <h5>People</h5>
                        <input type="text" name="personnum" id="person" value="0 People" readonly required>
                        <div class="incdec">
                            <a onclick="incr(0);">More</a>
                            <a onclick="incr(1);">Less</a>
                        </div>
                    </div>-->
                    <div class="card1">
                        <h5>Flight date</h5>
                        <input type="date" name="cin" class="today" required>
                    </div>
                    <div class="card1">
                        <input type="submit" class="bookn" value="Book Now" />
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section id="Popflight">
        <h2>POPULAR FLIGHTS</h2>
        <div class="d-flex justify-content-around mt-5">
            <div class="col-2 text-center card">
                <img src="https://images.unsplash.com/photo-1522093007474-d86e9bf7ba6f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&q=80" alt="">
                <span>France</span>
            </div>
            <div class="col-2 text-center card">
                United States
            </div>
            <div class="col-2 text-center card">
                Morocco
            </div>
            <div class="col-2 text-center card">
                Spain
            </div>
        </div>

    </section>

    <!--Footer-->
    <?php include('./components/footer.php') ?>
    <!--adding the script file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./script/app.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</body>

</html>