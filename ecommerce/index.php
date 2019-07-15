<?php
require "header.php";
?>
<main>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/product.css">
    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active" style="background-color:#009900"></li>
            <li data-target="#demo" data-slide-to="1" style="background-color:#009900"></li>
            <li data-target="#demo" data-slide-to="2" style="background-color:#009900"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/carousel/show1.jpg" alt="Los Angeles" height="750px" width="100%">
                <div class="carousel-caption">
                    <h3>Studio</h3>
                    <p>we sold differents instruments like guitar piano violin etc</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/carousel/show2.jpg" alt="Chicago" height="750px" width="100%">
                <div class="carousel-caption">
                    <h3>Studio</h3>
                    <p>we sell a lot of variety trap hip-hop </p>
                </div>
                </div>
                <div class="carousel-item">
                    <img src="img/carousel/show3.jpg" alt="New York" height="750px" width="100%">
                    <div class="carousel-caption">
                        <h3>Studio</h3>
                        <p>order your beats now</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
</div>
<h1  style="color:#009900;" >Product List</h1>
<?php 
require 'includes/connect.inc.php';
$sql = "SELECT * FROM  product INNER JOIN category WHERE product.productID = category.productID";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    header("Location: index.php?error=sqlerror");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="card" style="width: 18rem;">
  <a href=""><img class="card-img-top" src="admin/upload_image/<?= $row['productImage']; ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?= $row['productName']; ?></h5></a>
    <a href="productDetails.php?details=<?= $row['productID'];?>" class="btn btn-outline-success">buy this product</a>
  </div>
</div>
<?php } ?>

</main>
<br>
<?php 
require "footer.php";
?>