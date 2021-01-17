<?php
include "dbconnect.php";

     
if($_SERVER['REQUEST_METHOD']=="POST"){
   // Image Upload

    $file = $_FILES['file'];
    $tempFile = $file['tmp_name'];
    print_r($tempFile);
    echo "<br>";
    $fileName = $file['name'];
    print_r($fileName);
    $fileExt = explode('.', $fileName);
    $fileCheck = strtolower(end($fileExt));
    $store = array('jpg', 'jpeg', 'png', 'webp', 'svg', 'pdf');
    if (in_array($fileCheck, $store)) {
        $destFile = "Images/" . $fileName;
        move_uploaded_file($tempFile, $destFile);
    }
 else {
    $target = null;
    echo"Problem inserting image";
    // echo "<br>No Image was uploaded";
}
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $sql = "SELECT * FROM `users` WHERE `username` = '$username' ";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
   
    if($num > 0){
      header('location:signupModal.php');
        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Signup Failed</strong> Username already exists
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
        if($password == $cpassword){
            $sql = "INSERT INTO `users` ( `photo`,`username`, `password`, `date`) VALUES ( '$destFile','$username', '$password', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            header('location:loginModal.php');
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Signup Success!</strong> Please login to chat
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
            echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Password do not match</strong> Please retype same password
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
}


?>