<?php
    require('./config/config.php');
    session_start();
    $_SESSION['previous_url']=$_SERVER['PHP_SELF'];
    if (isset($_SESSION['user_id'])) {
        $uid = $_SESSION['user_id'];
    }
    else {
        if (isset($_POST['addtocardbtn'])) {
            header('location: login.php');
        }
    }
    if(isset($_SESSION['previous_url_login'])){
        if($_SESSION['previous_url_login'] == '/webproject/login.php')
        {
            if (isset($_SESSION['fid'])) {
                $fid = $_SESSION['fid'];
                $date = $_SESSION['date'];
                unset($_SESSION['fid']);
                unset($_SESSION['date']);
                unset($_SESSION['previous_url_login']);
            }
            else {
                $fid=$_GET['id'];
                $date=$_GET['date'];
                $_SESSION['fid'] = $fid;
                $_SESSION['date'] = $date;
                unset($_SESSION['previous_url_login']);
            }
        }
        else {
            $fid=$_GET['id'];
            $date=$_GET['date'];
        }
    }
    else {
        $fid=$_GET['id'];
        $date=$_GET['date'];
    }
    $sql = "SELECT f.*, c.namecoun as 'fromcoun', c.codecoun as 'fromcode', c1.namecoun as 'tocoun', c1.codecoun as 'tocode', TIMEDIFF(f.arrivaltime,f.boardtime) as 'duration', a.nameairp as 'fromair', a.codeairport as 'fromaircode' , a1.nameairp as 'toair', a1.codeairport as 'toaircode' from flights f, airport a, airport a1, country c, country c1 where ((f.froma = a.idairp and a.countryid=c.idcoun) and (f.toa = a1.idairp and a1.countryid = c1.idcoun)) and flightnum=$fid";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $tothour = substr($row['duration'], -8, 2);
    $totmin = substr($row['duration'], -5, 2);

    $num_adt = 1;
    $num_cld = 0;
    /*get escale */
    if(!is_null($row['idescale']))
    {
        $idstop = $row['idescale'];
        $sql1 = "SELECT s.*, a.nameairp as 'airname', a.codeairport as 'aircode' , c.namecoun as 'namecoun' FROM stopover s, country c, airport a where (s.airid=a.idairp and a.countryid=c.idcoun) and idstop=$idstop";
        $resultstop = mysqli_query($conn,$sql1);
        $rowstop = mysqli_fetch_assoc($resultstop);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/detail.css">
    <link rel="stylesheet/less" type="text/css" href="./style/fdetstyle.less" />
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Flight to <?php echo $row['tocoun']?></title>
</head>
<body onload="updatetotalprice();" >
    <main>
        <div class="plan">
            <div class="colorhead">
                <h2><?php echo $row['fromcoun']?> → <?php echo $row['tocoun']?></h2>
            </div>
            <div class="padded">
                <div class="heading-time">
                    <h3>
                        Departure:
                    </h3>
                </div>
                <div class="showpcode">
                    <span><?php echo $row['fromcode']?></span>
                    <span><i class="fa-solid fa-plane"></i></span>
                    <span><?php echo $row['tocode']?></span>
                </div>
                <div class="selectper">
                    <div class="adult">
                        <a onclick="incrpers(1);"><i class="fa-solid fa-circle-minus"></i></a>
                        <input type="text" id="person" value="1 Adults" readonly>
                        <a onclick="incrpers(0);"><i class="fa-solid fa-circle-plus"></i></a>
                    </div>
                    <div class="child">
                        <a onclick="incrchild(1);"><i class="fa-solid fa-circle-minus"></i></a>
                        <input type="text" id="child" value="0 Children" readonly>
                        <a onclick="incrchild(0);"><i class="fa-solid fa-circle-plus"></i></a>
                    </div>
                </div>
                <div class="fplan">
                    <fieldset>
                        <legend>
                            <h2>Flight plan:</h2>
                        </legend>
                        <div class="dptarr">
                        <div class="sectionWrap">
                            <div class="sectionSegment sectionSegment-head">
                                <div class="sectionNum">
                                </div>
                                <div class="sectionLeft">Departure</div>
                                <div class="sectionLine"></div>
                                <div class="sectionRight"><span>
                                    <?php
                                        if($tothour>0)
                                        {
                                            echo 'Total travel time is: '.$tothour.' Hours and '.$totmin.' Minutes';
                                        }
                                        else {
                                            echo 'Total travel time is: '.$totmin.' Minutes';
                                        }
                                    ?>
                                </span>
                                <span class="sectionCrossDayLabel">
                                    <?php
                                        if($row['arrivaltime']>18){
                                            echo 'Nightly Arrival';
                                        }
                                        else {
                                            echo 'Overnight Arrival';
                                        }
                                    ?>
                                </span>
                            </div>
                            </div>
                            <div class="sectionSegment">
                                <div class="sectionNum"></div>
                                <div class="sectionLeft">
                                    <?php
                                        echo substr($row['boardtime'], 0, 5);
                                    ?>
                                </div>
                                <div class="sectionLine"><span class="sectionDot"></span></div>
                                <div class="sectionRight">
                                <div>
                                    <?php
                                        echo $row['fromair'].' '.$row['fromaircode'];
                                    ?>
                                </div>
                                <div class="sectionRight-desc"><?php echo $row['fromcoun']?></div>
                                </div>
                            </div>
                            <?php
                                if(!is_null($row['idescale']))
                                {
                            ?>
                            <div class="sectionSegment sectionSegment-transit">
                                <div class="sectionNum"></div>
                                <div class="sectionLeft"></div>
                                <div class="sectionLine"><span class="sectionDot"></span></div>
                                <div class="sectionRight">
                                <div>
                                    <?php
                                        echo $rowstop['airname'].' '.$rowstop['aircode'];
                                    ?>
                                </div>
                                <div class="sectionRight-desc"><?php echo $rowstop['arrival'].' → '.$rowstop['departure']?></div>
                                <div class="sectionRight-desc"><?php echo $rowstop['namecoun']?></div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                            <div class="sectionSegment">
                                <div class="sectionNum"></div>
                                <div class="sectionLeft">
                                    <?php
                                        echo substr($row['arrivaltime'], 0, 5);
                                    ?>
                                </div>
                                <div class="sectionLine"><span class="sectionDot"></span></div>
                                <div class="sectionRight">
                                <div>
                                    <?php
                                        echo $row['toair'].' '.$row['toaircode'];
                                    ?>
                                </div>
                                <div class="sectionRight-desc"><?php echo $row['tocoun']?></div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="features">
                    <h2>Features: </h2>
                    <div class="container">
                        <div class="card">
                            <div class="empty"></div>
                            <i class="fa-solid fa-fan"></i>
                            <span>Air Conditioner</span>
                        </div>
                        <div class="card">
                            <div class="empty"></div>
                            <i class="fa-solid fa-utensils"></i>
                            <span>Restaurant</span>
                        </div>
                        <div class="card">
                            <div class="empty"></div>
                            <i class="fa-solid fa-taxi"></i>
                            <span>Taxi</span>
                        </div>
                        <div class="card">
                            <div class="empty"></div>
                            <i class="fa-solid fa-square-parking"></i>
                            <span>Parking</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="prices">
            <form <?php if (isset($uid)) {?> action="addtocart.php"<?php }?> method="post">
                <div class="header">
                    <h2>Details</h2>
                    <div class="line">
                        <hr>
                    </div>
                </div>
                <div class="passenger">
                    <input type="hidden" name="numf" value="<?php echo $fid ?>">
                    <input type="hidden" name="date" value="<?php echo $date ?>">
                    <div class="adlt">
                        <input type="text" name="num_adt" id="adlt" value="1" readonly> <span> Adult x <span id="pradt"><?php echo $row['price_adult']?></span> DH</span>
                    </div>
                    <div class="cld">
                        <input type="text" name="num_cld" id="chld" value="0" readonly> <span> Children x <span id="pracld"><?php echo $row['price_child']?></span> DH</span>
                    </div>
                </div>
                <div class="price">
                    Total: 
                    <input type="text" name="price" id="totalp" readonly>DH
                </div>
                <div class="btn_conf_ann">
                    <div class="btn">
                        <input type="submit" name="addtocardbtn" value="Add to cart">
                    </div>
                    <div class="btn">
                        <a href="index.php">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./script/app.js"></script>
    <script src="https://kit.fontawesome.com/34ab47bcfb.js" crossorigin="anonymous"></script>
</body>
</html>