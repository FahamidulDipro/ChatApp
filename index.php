<?php
include "header.php";
include "dbconnect.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>ChatSquad</title>
</head>

<body>
    <style>
        .chat_container {
            background-color: #99b4c3;
            margin: 10px;
            padding: 10px;
            border-radius: 20px;
            width: 50%;
        }
    </style>
    <?php
    // Inserting the chat
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $chatContent = $_POST['chat_content'];
        $sn = $_POST['sn'];
        $sql = "INSERT INTO `chatpage` ( `chat_content`, `chat_user_id`, `time`) VALUES ( '$chatContent', '$sn',current_timestamp())";
        $result = mysqli_query($conn, $sql);
        echo '<script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        </script>';
    }
    ?>


    <div class="container mt-5" style="min-height:500px;">
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $sql = "SELECT * FROM `chatpage`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $serialBy = $row['chat_user_id'];
                $content = $row['chat_content'];
                $sqlUser = "SELECT * FROM `users` WHERE `user_id`='$serialBy'";
                $resultUser = mysqli_query($conn, $sqlUser);
                $rowUser = mysqli_fetch_assoc($resultUser);
                $name = $rowUser['username'];
                $img = $rowUser['photo'];

                if($name == $_SESSION['username']){
                    echo '<div class="chat_container" style="width:50%;float:right;background-color:#7bdaed"><img src="' . $img . '" style="height:50px;width:50px;border-radius:50%;object-fit:cover; margin:0 10px;"><strong>' . $name . '</strong><span style="font-size:10px;font-weight:700;">  at '. $row['time'] . '</span><br>' .  $content . "<br></div>";
                }
                else{
                    echo '<div class="chat_container" style="width:50%;float:left;"><img src="' . $img . '" style="height:50px;width:50px;border-radius:50%;object-fit:cover; margin:0 10px;"><strong>' . $name . '</strong><span style="font-size:10px;font-weight:700;"> at '. $row['time'] . '</span><br>' .  $content . "<br></div>";
                }
               
            }
        } else {
            echo '<div class="container"><h1>Please login to chat</h1></div>';
        }
     

       

    
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo ' <div class="container ">
                <form action="index.php" method="POST">
                    <div class="mb-3">
               
                        <textarea class="form-control w-70" name="chat_content" id="chat_content" rows="3" placeholder="Write your message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-info mb-3" name="submit" id="submit">SEND</button>
                    <input type="hidden" id="sn" name="sn" value="' . $_SESSION['sn'] . '">
                </form>
            </div>';
        }

        ?>
<!-- 
        <script>
        $(document).ready(function(){
            var chat_content = $('#chat_content').val();
            $('#submit').click(function(){
                $.ajax({
                    url:'index.php',
                    type:'POST',
                    data:{
                        content:chat_content,
                    },

                    success:function(data,result){

                    }
                });
            });
        });
        
        </script> -->

    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>