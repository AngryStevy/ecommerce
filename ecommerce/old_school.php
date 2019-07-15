
<?php
require "header.php";
?>
  <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/product.css">
    <br>
    <br>
    <br>
<main>
<h1  style="color:#009900;" >Old-School beats List</h1>
<?php 
require 'includes/connect.inc.php';
$sql = "SELECT * FROM  product INNER JOIN category WHERE product.productID = category.productID and category.categoryName=?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    header("Location: index.php?error=sqlerror");
    exit();
}
$category = 'old-school';
mysqli_stmt_bind_param($stmt,'s',$category);
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