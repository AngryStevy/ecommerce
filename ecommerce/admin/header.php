<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>

<body>

  <header>
  <style>
  #nav1{  
    /* Fallback for web browsers that don't support RGBa */
    background-color: rgb(0, 0, 0);
   /* RGBa with 0.6 opacity */
   background-color: rgba(0, 0, 0, 1);
   /* For IE 5.5 - 7*/
   filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
   /* For IE 8*/
   -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";    
}
.custom-toggler .navbar-toggler-icon {
  background-image: url("img/menu.png")
}
.custom-toggler.navbar-toggler {
  border-color: #009900;
}
.custom-toggler.navbar-toggler:focus {
  border-color: #009900;
}  
#profile-name{
    color: #009900 !important;
}
  </style>
  <script></script>
 
  <?php 
  if(isset($_SESSION['adminID'])){
    echo '
    <nav class="navbar fixed-top navbar-expand-lg navbar" id="nav1">
    <!-- Brand -->
    <a class="navbar-brand" href="#">
      <img src="img/logo.png" alt="Logo" style="width:40px; height:40px">
    </a>
    <button class="navbar-toggler hidden-md-up pull-xs-right custom-toggler" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-xs-center pull-lg-right " id="navbarSupportedContent">
     <!-- Links -->
     <ul class="navbar-nav ">
        <!-- Dropdown -->
      </li>
      <li class="nav-item">
        <a class="nav-link text-success" href="index.php">Home</a>
      </li>
      <form class="form-inline pl-lg-5 pr-lg-5">
      <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" id="search">
      <button class="btn btn-outline-success my-2 my-sm-0 " type="submit">Search</button>
    </form>
    <ul class="navbar-nav pl-lg-5 ">
    <li class="nav-item">
      <a class="nav-link text-success " href="#"><img src="img/profil.png" alt="" class="" style="width:25px; height:25px"> Welcome '.$_SESSION['fname2'].
      " ".$_SESSION['lname2'].'</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-success " href="addProduct.php">Add product</a>
    </li>
    <li class="nav-item">
<a class="nav-link text-success " href="productList.php">product list</a>
</li>
<li class="nav-item">
<a class="nav-link text-success " href="orderList.php">Order list</a>
</li>
    <form class="form-inline pl-lg-5 pr-lg-5" action="includes/admin_logout.inc.php" method="post">
    <button class="btn btn-outline-success my-2 my-sm-0 " type="submit">Logout</button>
  </form>
</ul> ';
  }
  else{
    echo '<nav class="navbar fixed-top navbar-expand-lg navbar" id="nav1">
    <!-- Brand -->
    <a class="navbar-brand" href="#">
      <img src="img/logo.png" alt="Logo" style="width:40px; height:40px">
    </a>
    <button class="navbar-toggler hidden-md-up pull-xs-right custom-toggler" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-xs-center pull-lg-right " id="navbarSupportedContent">
     <!-- Links -->
     <ul class="navbar-nav ">
        <!-- Dropdown -->
      <li class="nav-item">
        <a class="nav-link text-success" href="../index.php">Home</a>
      </li>
      
    </ul>';
  }
  ?>

  </div>

  
</nav>
  </header> 