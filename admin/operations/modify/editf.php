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
    $sql1="SELECT * FROM flights where flightnum=$id";
    $res=$conn->query($sql1);
    $row=mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>
<body id="modif" onload="getdata();">
    <div id="container" class="container p-5 bg-white rounded">
    <section id="addf">
                    <h1>Modify Flight Number : <?php echo $id;?></h1>
                    <div class="formdiv">
                        <form action="./operations/add/addflight.php" method="post">
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
                                                <select id="toa" name="toa" class="form-control form-control-lg">
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
                                                <input class="form-check-input" type="radio" checked name="stopover" onclick="hidestopmenu();" id="inlineRadio1" value="No Stopover">
                                                <label class="form-check-label" for="inlineRadio1">No Stopover</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input class="form-check-input" type="radio" onclick="showstopmenu();" name="stopover" id="inlineRadio2" value="Contains Stopover">
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
                                                <input type="number" name="seata" class="form-control form-control-lg" value="<?php echo $row['seats_available']; ?>"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Price for adults</label>
                                                <input type="number" name="priceadt" class="form-control form-control-lg" value="<?php echo $row['price_adult']; ?>"/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Price for children</label>
                                                <input type="number" name="pricecld" class="form-control form-control-lg" value="<?php echo $row['price_child']; ?>"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Departure time</label>
                                                <input type="time" name="depttime" class="form-control form-control-lg" value="<?php echo $row['boardtime']; ?>"/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example17">Arrival time</label>
                                                <input type="time" name="arrtime" class="form-control form-control-lg" value="<?php echo $row['arrivaltime']; ?>"/>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                
                                <div class="pt-1 mb-4">
                                    <input class="btn btn-dark btn-lg btn-block" name="submit" type="submit" value="Modify flight"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
    </div>
    <script src="../../script/script.js"></script>
    <script>
        function getdata(){
            document.getElementById("froma").selectedIndex = <?php echo $row['froma']-1?>;
            document.getElementById("toa").selectedIndex = <?php echo $row['toa']-1?>;
        }
    </script>
</body>
</html>