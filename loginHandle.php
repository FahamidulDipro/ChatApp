<?php
include "dbconnect.php";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql= "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        $row = mysqli_fetch_assoc($result);
        if($username == $row['username']){
            if($password == $row['password']){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['photo'] = $row['photo'];
                $_SESSION['sn'] = $row['user_id'];
                header("location:index.php?loginsuccess=true");

            }
          
        }
        else{
            header("location:loginModal.php?loginsuccess=false");
   
        }
      
    }
    else{
        header("location:loginModal.php?loginsuccess=false");
    
    }
}


?>