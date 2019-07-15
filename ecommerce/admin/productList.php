<?php
include "header.php"
?>
<main>
<link rel="stylesheet" href="css/productList.css">
<?php 
require "includes/connect.inc.php";
$sql = "SELECT * FROM  product INNER JOIN category WHERE product.productID = category.productID";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    header("Location: ../login.php?error=sqlerror");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<br>
<br>
<br>
<br>
<?php 
if(isset($_GET['action'])){
    if($_GET['action']=='success'){
       echo '<script>
       alert("delete sucessful");
       </script>';
    }
    else{
        echo '<script>
        alert("delete failed");
        </script>'; 
    }
}
?>

<table class="table table-dark" style="background-color:black">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">image</th>
      <th scope="col">price</th>
      <th scope="col">quantity</th>
      <th scope="col">category</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
      <?php while($row=mysqli_fetch_assoc($result)){ ?>
    <tr>
      <th scope="row"><?= $row['productID']; ?></th>
      <td><?= $row['productName']; ?></td>
      <td><img src="upload_image/<?= $row['productImage']; ?>" alt="" style="width:60px;height:60px"></td>
      <td><?= $row['price']; ?></td>
      <td><?= $row['quantity']; ?></td>
      <td><?= $row['categoryName']; ?></td>
      <td>
          <a href="productDetails.php?details=<?= $row['productID']; ?>">
          <button class="btn btn-outline-success my-2 my-sm-0 ">details</button>
          </a>
          <a href="productEdit.php?edit=<?= $row['productID']; ?>">
          <button class="btn btn-outline-success my-2 my-sm-0 ">edit</button>
          </a>
          <a href="includes/deleteProduct.inc.php?delete=<?= $row['productID']; ?>" 
          onclick="return confirm('do you want to delete the product');">
          <button class="btn btn-outline-success my-2 my-sm-0 ">delete</button>
          </a>
      </td>
    </tr>
<?php }?>
  </tbody>
</table>
</main>
<br>
<br>
<br>
<?php
include "footer.php"
?>