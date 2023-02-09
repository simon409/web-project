<?php 
    require('./config/config.php');

    //get all popular flights
    $popf = "SELECT cmd.flightnum, COUNT(cmd.id) as num, f.*, c.namecoun as 'fromcoun', u.username,c1.* , c1.namecoun as 'tocoun', a.nameairp as 'fromair',a1.nameairp as 'toair' from commandedf cmd, users u, flights f, airport a, airport a1, country c, country c1 where ((f.froma = a.idairp and a.countryid=c.idcoun) and (f.toa = a1.idairp and a1.countryid = c1.idcoun)) and (cmd.flightnum = f.flightnum and cmd.iduser = u.id) GROUP BY cmd.flightnum ORDER BY num desc LIMIT 4;";
    $res = mysqli_query($conn, $popf);
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
    <?php $_SESSION['previous_url']=$_SERVER['PHP_SELF'];?>
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
                <img src="./assets/travel.png" width="750" alt="">
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
        <?php
            if(isset($res))
            {
                if($res->num_rows>0)
                {
                    while($row = mysqli_fetch_assoc($res)){
        ?>
            <div class="col-2 text-center">
                <div class="containerc">
                    <div class="cardc">
                        <div class="card-img">
                        <img style="width: 220px; height: 220px; object-fit: cover;" src="<?php echo $row['image']?>" alt="">
                        </div>
                        <div class="card-content">
                        <h3 class="big-title"><?php echo $row['tocoun']?></h3>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                    }
                }
            }
        ?>
        </div>

    </section>
    <section id="gallery" class="main">
        <div class="title">
            <h3>Gallery</h3>
        </div>
        <div class="containerg">
            <div class="image">
                <div class="image-text">
                    <h1>Barcelona</h1>
                    <h3>City in Spain</h3>
                    <p>Barcelona, the cosmopolitan capital of Spain’s Catalonia region, is known for its art and architecture. The fantastical Sagrada Família church and other modernist landmarks designed by Antoni Gaudí dot the city. Museu Picasso and Fundació Joan Miró feature modern art by their namesakes. City history museum MUHBA, includes several Roman archaeological sites.</p>
                </div>
            </div>

            <div class="image">
                <div class="image-text">
                    <h1>London</h1>
                    <h3>Capital of England</h3>
                    <p>London, the capital of England and the United Kingdom, is a 21st-century city with history stretching back to Roman times. At its centre stand the imposing Houses of Parliament, the iconic ‘Big Ben’ clock tower and Westminster Abbey, site of British monarch coronations. Across the Thames River, the London Eye observation wheel provides panoramic views of the South Bank cultural complex, and the entire city.</p>
                </div>
            </div>

            <div class="image">
                <div class="image-text">
                    <h1>New York</h1>
                    <h3>City in New York State</h3>
                    <p>New York City comprises 5 boroughs sitting where the Hudson River meets the Atlantic Ocean. At its core is Manhattan, a densely populated borough that’s among the world’s major commercial, financial and cultural centers. Its iconic sites include skyscrapers such as the Empire State Building and sprawling Central Park. Broadway theater is staged in neon-lit Times Square. </p>
                </div>
            </div>

            <div class="image">
                <div class="image-text">
                    <h1>Paris</h1>
                    <h3>Capital of France</h3>
                    <p>Paris, France's capital, is a major European city and a global center for art, fashion, gastronomy and culture. Its 19th-century cityscape is crisscrossed by wide boulevards and the River Seine. Beyond such landmarks as the Eiffel Tower and the 12th-century, Gothic Notre-Dame cathedral, the city is known for its cafe culture and designer boutiques along the Rue du Faubourg Saint-Honoré.</p>
                </div>
            </div>

            <div class="image">
                <div class="image-text">
                    <h1>Rome</h1>
                    <h3>Capital of Italy</h3>
                    <p>Rome is the capital city and a special comune of Italy, as well as the capital of the Lazio region. The city has been a major human settlement for almost three millennia. With 2,860,009 residents in 1,285 km², it is also the country's most populated comune.</p>
                </div>
            </div>

            <div class="image">
                <div class="image-text">
                    <h1>Shinjuku</h1>
                    <h3>Special ward of Tokyo</h3>
                    <p>Shinjuku City encompasses the buzzing clubs and karaoke rooms of neon-lit East Shinjuku and upscale hotel bars and restaurants in the Skyscraper District. Tokyo Metropolitan Building has a popular observation deck, and Mount Hakone rises over tranquil urban parkland. Galleries, theaters, and bookstores attract students from busy campuses. New National Stadium is a high-tech sports venue built for the 2020 Olympics. </p>
                </div>
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