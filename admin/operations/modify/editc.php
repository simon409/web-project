<?php
    require('../../../config/config.php');
    
    $id = $_GET['id'];
    
    //get data about selected country
    $sql1="SELECT * FROM country where idcoun=$id";
    $res=$conn->query($sql1);
    $row=mysqli_fetch_assoc($res);

    //update data
    if(isset($_POST['updatec']))
    {
        $counname = $_POST['counname'];
        $councode = $_POST['councode'];
        $counimage = $_POST['imagecoun'];

        $query = "UPDATE country set namecoun='$counname', codecoun='$councode', image='$counimage' where idcoun=$id";
        $res = mysqli_query($conn, $query);
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
    <div id="container" class="container p-5 bg-white rounded">
        <section id="addc">
            <h1>Add Country</h1>
            <form action="" method="post">
                <div class="half mt-5">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Country Name</label>
                        <input type="text" id="counname" name="counname" class="form-control form-control-lg"
                            value="<?php echo $row['namecoun'];?>" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Country Code</label>
                        <input type="text" id="councode" name="councode" class="form-control form-control-lg"
                            value="<?php echo $row['codecoun'];?>" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Country Image url</label>
                        <input type="url" id="imagecoun" name="imagecoun" class="form-control form-control-lg"
                            value="<?php echo $row['image'];?>" />
                    </div>
                    <div class="pt-1 mb-4">
                        <input class="btn btn-dark btn-lg btn-block" name="updatec" type="submit"
                            value="Modify Country" />
                    </div>
                </div>
            </form>
        </section>
        <?php
            }
        }
    ?>
    </div>
    <script src="../../script/script.js"></script>
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
</body>

</html>