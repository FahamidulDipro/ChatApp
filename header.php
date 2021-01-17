

<?php
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
echo'<nav class="navbar navbar-expand-lg navbar-dark bg-info">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php"><strong><i>CHATSQUAD</i></strong></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
     ';
      
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo'   <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Chat</a>
      </li>
        <li class="nav-item" style="color:white;font-weight:800;"><img src="'.$_SESSION['photo'].'" style="height:50px;width:50px;border-radius:50%;object-fit:cover; margin:0 10px;">'.$_SESSION['username'].'</li>
        <li><a class="nav-link active" href="logout.php">Logout</a>
        </li>';
      }
      else{
        echo'   <li class="nav-item">
        <a class="nav-link active" href="loginModal.php">Login</a>
      </li>
      
      <li class="nav-item">
      <a class="nav-link active" href="signupModal.php" >Signup</a>
      </li>';
      }

     echo'</ul>
  </div>
</div>
</nav>';





?>