<?php
    require('./config/config.php');
    session_start();
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        // Prepare and execute a SELECT statement to check the cart items
        $querygetcard1 = "SELECT c.*, ct.namecoun FROM card c, flights f, country ct, airport a WHERE iduser = '$id' and (c.flightnum=f.flightnum and (f.toa = a.idairp and a.countryid = ct.idcoun));";
        $cardquery1 = $conn->query($querygetcard1);
        if (isset($_GET['proceed'])) {
            proceed($id);
        }
    }
    else{
        header("location:login.php");
    }

    function proceed($id){
        //add some function to check available site
        $querycopytocomm = "INSERT INTO commandedflights SELECT * FROM card WHERE iduser=$id";
        $cardquery2 = $conn->query($querycopytocomm);
        //add some function to reduce available places
        $deletefromcard = "DELETE FROM card WHERE iduser = '$id'";
        $cardquery3 = $conn->query($deletefromcard);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/header_foot.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <style>
        section{
            height: 100vh;
            background-color: #F1FAEE;
        }
        .custom{
            height: 70%;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0, 0, 0, .3);
            top: 50%;
            position: relative;
            transform: translateY(-50%);
            padding: 30px;
        }
        .list-group{
            max-height: 450px;
            margin-bottom: 10px;
            overflow-y:scroll;
            -webkit-overflow-scrolling: touch;
        }
        .list-group::-webkit-scrollbar {
            width: 12px;
        }

        .list-group::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1); 
            border-radius: 10px;
        }

        .list-group::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.2); 
        }
        .confirm{
            position: absolute;
            bottom: 30px;
        }

        .confirm a{
            background-color: #1D3557;
            padding: 10px 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, .3);
            border-radius: 15px;
            text-decoration: none;
            color: #fff;
            transition: .3s ease-in-out;
        }
        .confirm a:hover{
            background-color: #457B9D;
        }
        .delete_data{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <section>
        <div class="container custom">
            <h2>Proceed to check out</h2>
            <div class="m-4">
                <ul class="list-unstyled list-group">
                <?php
                    while($card = mysqli_fetch_assoc($cardquery1))
                    {
                    ?>
                    <li class="carditem flex flex-row card p-4 justify-content-between mb-2">
                        <div class="infos">
                            Flight to <?php echo $card['namecoun']?> | <?php echo $card['numt_adult']." Person"; 
                            if ($card['numt_child']>0){
                                echo " and ".$card['numt_child']." Child";
                            }
                            ?>
                        </div>
                        <div class="action">
                            <a class="delete_data" id="<?php echo $card['id']?>"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </li>
                    <?php
                        }
                        if($cardquery1->num_rows>0){
                            ?>
                                
                            <?php
                        }
                        else {
                            echo '<li class="carditem flex flex-row card p-4 justify-content-between mb-2">'. "Your cart is empty".'</li>';
                        }
                    ?>
                </ul>
                <div class="confirm">
                    <a href="?proceed=true">Confirm Purchase</a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./script/app.js"></script>
    <script>
        $(".delete_data").click(function(){
        var choice = confirm('Do you really want to delete this record?');
            if(choice === true) {
                var del_id = $(this).attr('id');
                $.ajax({
                    type: 'GET',
                    url: 'deletec.php',
                    data: 'id='+del_id,
                    success: function(data){
                        alert("this flight was removed from your cart!!");
                        window.location.reload();
                    }
                });
            }else{
                return false;
            }
        });
    </script>
</body>
</html>