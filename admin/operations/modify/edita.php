<?php
    require('../../../config/config.php');
    $id = $_GET['id'];
    //get all country
    $getcoun = "SELECT * FROM country";
    $result2 = mysqli_query($conn, $getcoun);

    //get all from selected airport
    $getair = "SELECT a.*, c.namecoun FROM airport a, country c where idairp=$id and a.countryid=c.idcoun";
    $result3 = mysqli_query($conn, $getair);
    $row = mysqli_fetch_assoc($result3);

    if(isset($_POST['modifya']))
    {
        $airname = $_POST['airname'];
        $aircode = $_POST['aircode'];
        $coun = $_POST['coun'];

        $query = "UPDATE airport SET nameairp='$airname', codeairport='$aircode', countryid=$coun where idairp = $id";
        $update = mysqli_query($conn, $query);
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
            if(isset($update))
            {
                if ($update) {
                    ?>
    <div class="celebrate">
        <h1>Congrats</h1>
        <h3>You have modified this airport with success</h3>
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
        <section id="adda">
            <h1>Add Airport</h1>
            <form action="" method="post">
                <div class="half mt-5">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Airport Name</label>
                        <input type="text" id="airname" name="airname" class="form-control form-control-lg"
                            value="<?php echo $row['nameairp']?>" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Airport Code</label>
                        <input type="text" id="aircode" name="aircode" class="form-control form-control-lg"
                            value="<?php echo $row['codeairport']?>" />
                    </div>
                    <div class="form-outline mb-4">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example17">Country</label>
                            <select name="coun" class="form-control form-control-lg">
                                <?php
                                                if($result2->num_rows>0)
                                                {
                                                    foreach ($result2 as $country) {
                                                ?>
                                <option value="<?php echo $country['idcoun'];?>" <?php
                                                        if($row['namecoun'] == $country['namecoun']){
                                                            ?> selected <?php
                                                        }
                                                    ?>><?php echo $country['namecoun'] ?></option>
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
                        <input class="btn btn-dark btn-lg btn-block" name="modifya" type="submit" value="Add Airport" />
                    </div>
                </div>
            </form>
        </section>

        <?php
            }
        ?>
    </div>
    <script src="../../script/script.js"></script>
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
</body>

</html>