<?php
require "header.php"
?>
<?php 
include "css/productDetail.css.php";
?>
<br>
<br>
<br>
<br>
<br>
<br>
<main>
<?php
if(isset($_GET['details'])){
require "includes/connect.inc.php";
$productId = $_GET['details'];
$sql = "SELECT  *
FROM    category
JOIN    product ON category.productID = product.productID
WHERE   category.productID = ?
;";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    header("Location:productList.php?error=sqlerror".$productId);
    exit();
}
mysqli_stmt_bind_param($stmt, "i", $productId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

?>
<div class="container">	
<div class="card">
	<div class="row">
		<aside class="col-sm-5 border-right">
<article class="gallery-wrap"> 
<div class="img-big-wrap">
  <div><a href="#"><img src="upload_image/<?= $row['productImage'] ?>" style="width:100%;"></a></div>
</div> <!-- slider-product.// -->
</article> <!-- gallery-wrap .end// -->
		</aside>
		<aside class="col-sm-7">
<article class="card-body p-5">
	<h3 class="title mb-3"><?= $row['productName'] ?></h3>

<p class="price-detail-wrap"> 
	<span class="price h3 text-warning"> 
		<span class="currency" style="color:#009900;">$</span><span class="num" style="color:#009900;"><?= $row['price']; ?></span>
</p> <!-- price-detail-wrap .// -->
<dl class="item-property">
  <dt>Description</dt>
  <dd><p><?= $row['description']; ?></p></dd>
</dl>
<dl class="param param-feature">
  <dt>Category</dt>
  <dd><?= $row['categoryName']; ?></dd>
</dl>  <!-- item-property-hor .// -->
<?php if($row['categoryName']!='instrument'){ ?>
<dl class="param param-feature">
  <dt>Audio</dt>
  <dd>
    <audio controls>
  <source src="upload_audio/<?= $row['productAudio']; ?>" type="audio/ogg">
</audio>
</dd>
</dl> 
<?php }?>
<hr>
<?php if($row['categoryName']=='instrument'){?>
	<div class="row">
		<div class="col-sm-5">
			<dl class="param param-inline">
                
			  <dt>Quantity: </dt>
			  <dd>
			  	<input class="form-control form-control-sm" type="number">
			  </dd>
			</dl>
		</div> <!-- col.// -->
        </div> <!-- col.// -->
<?php } ?>
	</div> <!-- row.// -->
	<hr>
	<a href="#" class="btblack btn btn-outline-success my-2 my-sm-0 "> Buy now </a>
	<a href="#" class="btblack btn btn-outline-success my-2 my-sm-0 "> <i class="fas fa-shopping-cart"></i> Add to cart </a>
</article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</div> <!-- card.// -->
<?php } ?>

</div>
<!--container.//-->
</main>
<br>
<br>
<?php
require "footer.php"
?>