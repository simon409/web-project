<?php
    require('../../../config/config.php');
    
    $id = $_GET['id'];
    /*get all airports */
    $sql3 = "SELECT * FROM airport";
    $result3 = $conn->query($sql3);

    /* get stopover */
    $sql5 = "SELECT s.*, a.nameairp FROM stopover s, airport a where s.airid=a.idairp";
    $result5 = $conn->query($sql5);

    //get data about flight
    $sql1="SELECT f.*, c.namecoun as 'fromcoun', c.codecoun as 'fromcode', c1.namecoun as 'tocoun', c1.codecoun as 'tocode', a.nameairp as 'fromair', a.codeairport as 'fromaircode' , a1.nameairp as 'toair', a1.codeairport as 'toaircode' from flights f, airport a, airport a1, country c, country c1 where ((f.froma = a.idairp and a.countryid=c.idcoun) and (f.toa = a1.idairp and a1.countryid = c1.idcoun)) and flightnum=$id";
    $res=$conn->query($sql1);
    $row=mysqli_fetch_assoc($res);

    //modify flight
    if (isset($_POST['modifyf'])) {
         //getting data
         $froma = $_POST['forma'];
         $toa = $_POST['toa'];
         $seata = $_POST['seata'];
         $pricea = $_POST['priceadt'];
         $pricec = $_POST['pricecld'];
         $deptime = $_POST['depttime'];
         $arrtime = $_POST['arrtime'];
 
         //checking if it have stopover
         if($_POST['stopover'] == "Contains Stopover"){
             $stopover = $_POST['stopa'];
             $query = "UPDATE flights set froma=$froma, toa=$toa, boardtime='$deptime', arrivaltime='$arrtime', price_adult=$pricea, price_child=$pricec, totalseats=$seata, seats_available=$seata, idescale=$stopover where flightnum=$id";
         }
         else{
             $query = "UPDATE flights set froma=$froma, toa=$toa, boardtime='$deptime', arrivaltime='$arrtime', price_adult=$pricea, price_child=$pricec, totalseats=$seata, seats_available=$seata where flightnum=$id";
         }
         $update = mysqli_query($conn, $query);
         if($update)
         {
            $update1 = true;
         }
    }

    if(isset($_GET['reset']))
    {
        $query1 = "UPDATE flights set seats_available = totalseats";
        $update1 = mysqli_query($conn, $query1);
        if($update1)
        {
            $update = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../../style/addtocart.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>

<body id="modif">
    <?php
            if(isset($update) || isset($update1))
            {
                if ($update || $update1) {
                    ?>
    <div class="celebrate">
        <h1>Congrats</h1>
        <h3>You have modified this flight with success</h3>
        <lord-icon src="https://cdn.lordicon.com/alzqexpi.json" trigger="loop" delay="1000"
            style="width:250px;height:250px">
        </lord-icon> <br>
        <div class="btn">
            <a href="../../dashboard.php">Back to dashboard</a>
        </div>
    </div>
    <?php
                }
                else{
                ?>
    <div class="celebrate">
        <h1>Oops</h1>
        <<h3>We had difficulties deleting the Country from your website, the teams is working on it</h3>
            <lord-icon src="https://cdn.lordicon.com/kjkiqtxg.json" trigger="loop" delay="2000"
                style="width:250px;height:250px">
            </lord-icon> <br>
    </div>
    <?php
                }
            }
            else {
                ?>
    <div id="container" class="container p-5 bg-white rounded">
        <section id="addf">
            <div class="head">
                <h1>Modify Flight Number : <?php echo $id;?></h1>
                <a href="?id=<?php echo $id?>&reset=true">Reset Flight</a>
            </div>
            <div class="formdiv">
                <form action="" method="post">
                    <div class="form">
                        <table class="mt-4">
                            <tr>
                                <td>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">Departure Airport</label>
                                        <select id="froma" name="forma" class="form-control form-control-lg">
                                            <?php
                                                if($result3->num_rows>0)
                                                {
                                                    foreach ($result3 as $airport) {
                                                ?>
                                            <option value="<?php echo $airport['idairp']?>" <?php
                                                    if($airport['nameairp'] == $row['fromair'])
                                                    {
                                                        ?> selected <?php
                                                    }
                                                    ?>><?php echo $airport['nameairp'].' - '.$airport['codeairport'] ?>
                                            </option>
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
                            <select id="toa" name="toa" class="form-control form-control-lg">
                                <?php
                                                if($result3->num_rows>0)
                                                {
                                                    foreach ($result3 as $airport) {
                                                ?>
                                <option value="<?php echo $airport['idairp']?>" <?php
                                                    if($airport['nameairp'] == $row['toair'])
                                                    {
                                                        ?> selected <?php
                                                    }
                                                    ?>><?php echo $airport['nameairp'].' - '.$airport['codeairport'] ?>
                                </option>
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
                                <input class="form-check-input" type="radio" checked name="stopover"
                                    onclick="hidestopmenu();" id="inlineRadio1" value="No Stopover">
                                <label class="form-check-label" for="inlineRadio1">No Stopover</label>
                            </div>
                            <div class="form-check form-check-inline mb-4">
                                <input class="form-check-input" type="radio" onclick="showstopmenu();" name="stopover"
                                    id="inlineRadio2" value="Contains Stopover">
                                <label class="form-check-label" for="inlineRadio2">Contains Stopover</label>
                            </div>
                            <div class="form-outline mb-4 hide" id="stopo">
                                <label class="form-label" for="form2Example27">Select stopover</label>
                                <select name="stopa" class="form-control form-control-lg mb-4">
                                    <?php
                                                    if($result5->num_rows>0)
                                                    {
                                                        foreach ($result5 as $stopover) {
                                                    ?>
                                    <option value="<?php echo $stopover['idstop']?>">
                                        <?php echo $stopover['nameairp'].' - '.$stopover['arrival'].' -> '.$stopover['departure'] ?>
                                    </option>
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
                        <a href="../../operations/add/addstopover.php" class="btn btn-primary btn-lg btn-block"
                            name="submit" target="_blank" rel="noopener noreferrer" type="submit">Add Stop Overs</a>
                    </div>
            </div>
            </td>
            <td>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Seats Available in flight</label>
                    <input type="number" name="seata" class="form-control form-control-lg"
                        value="<?php echo $row['seats_available']; ?>" />
                </div>
            </td>
            </tr>
            <tr>
                <td>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Price for adults</label>
                        <input type="number" name="priceadt" class="form-control form-control-lg"
                            value="<?php echo $row['price_adult']; ?>" />
                    </div>
                </td>
                <td>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Price for children</label>
                        <input type="number" name="pricecld" class="form-control form-control-lg"
                            value="<?php echo $row['price_child']; ?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Departure time</label>
                        <input type="time" name="depttime" class="form-control form-control-lg"
                            value="<?php echo $row['boardtime']; ?>" />
                    </div>
                </td>
                <td>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Arrival time</label>
                        <input type="time" name="arrtime" class="form-control form-control-lg"
                            value="<?php echo $row['arrivaltime']; ?>" />
                    </div>
                </td>
            </tr>
            </table>

            <div class="pt-1 mb-4">
                <input class="btn btn-dark btn-lg btn-block" name="modifyf" type="submit" value="Modify flight" />
            </div>
    </div>
    </form>
    </div>
    </section>
    <?php
            }
        ?>
    </div>
    <script src="../../script/script.js"></script>
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
</body>

</html>