<?php
    require('../../../config/config.php');
    /*get all airports */
    $sql1 = "SELECT * FROM airport";
    $result3 = $conn->query($sql1);

    if(isset($_POST['submit'])) {
        $stopa = $_POST['stopa'];
        $arrtime = $_POST['arrtime'];
        $deptime = $_POST['deptime'];

        var_dump($stopa);

        $sql2 = "INSERT INTO stopover (airid, arrival, departure) values ($stopa, '$arrtime', '$deptime')";
        $result2 = mysqli_query($conn,$sql2);

        echo '<script> window.setTimeout("window.close()", 1000); </script>';
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add StopOver</title>
</head>
<body>
    <main>
        <div class="stopform">
            <h2 class="mt-5 text-center">Add stopover</h2>
            <form action="" method="post">
                <div class="form-outline mt-4">
                    <label class="form-label" for="form2Example17">Departure Airport</label>
                    <select name="stopa" class="form-control form-control-lg">
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
                <div class="form-outline mt-4">
                    <label class="form-label" for="form2Example17">Arrival time</label>
                    <input type="time" id="arrtime" name="arrtime" class="form-control form-control-lg" />
                </div>
                <div class="form-outline mt-4">
                    <label class="form-label" for="form2Example17">Departure time</label>
                    <input type="time" id="deptime" name="deptime" class="form-control form-control-lg" />
                </div>
                <div class="pt-1 mt-4">
                    <input class="btn btn-dark btn-lg btn-block" value="Add Stopover" name="submit" type="submit"/>
                </div>
            </form>
        </div>
    </main>
</body>
</html>