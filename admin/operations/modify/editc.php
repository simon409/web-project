<?php
    require('../../../config/config.php');
    $id = $_GET['id'];
    
    //get data about flight
    $sql1="SELECT * FROM country where idcoun=$id";
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
    <section id="addc">
        <h1>Add Country</h1>
        <form action="./operations/add/addcountry.php" method="post">
            <div class="half mt-5">
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Country Name</label>
                    <input type="text" id="counname" name="counname" class="form-control form-control-lg" value="<?php echo $row['namecoun'];?>"/>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Country Code</label>
                    <input type="text" id="councode" name="councode" class="form-control form-control-lg" value="<?php echo $row['codecoun'];?>"/>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example17">Country Image url</label>
                    <input type="url" id="imagecoun" name="imagecoun" class="form-control form-control-lg" value="<?php echo $row['image'];?>"/>
                </div>
                <div class="pt-1 mb-4">
                    <input class="btn btn-dark btn-lg btn-block" name="submit" type="submit" value="Modify Country"/>
                </div>
            </div>
        </form>
    </section>
    </div>
    <script src="../../script/script.js"></script>
</body>
</html>