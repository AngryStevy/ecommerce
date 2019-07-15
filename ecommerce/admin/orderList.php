<?php
include "header.php"
?>
<main>
<link rel="stylesheet" href="css/productList.css">
<?php 
require "includes/connect.inc.php";
$sql = "SELECT * FROM orders
INNER JOIN product ON (product.productID = orders.productID)
INNER JOIN clients ON (clients.clientID = orders.clientID)
INNER JOIN category ON (category.productID = orders.productID)
";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)){
    header("Location: admin_page.php?error=sqlerror");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<br>
<br>
<br>
<br>
<table class="table table-dark" style="background-color:black">
  <thead>
    <tr>
      <th scope="col">client name</th>
      <th scope="col">product name</th>
      <th scope="col">image</th>
      <th scope="col">price</th>
      <th scope="col">quantity</th>
      <th scope="col">category</th>
      <th scope="col">addresse</th>
    </tr>
  </thead>
  <tbody>
      <?php while($row=mysqli_fetch_assoc($result)){ ?>
    <tr>
      <td><?= $row['firstName']; ?> <?= $row['lastName']; ?></td>
      <td scope="row"><?= $row['productName']; ?></td>
      <td><img src="upload_image/<?= $row['productImage']; ?>" alt="" style="width:60px;height:60px"></td>
      <td><?= $row['price']; ?></td>
      <td><?= $row['quantity']; ?></td>
      <td><?= $row['categoryName']; ?></td>
      <td><?= $row['address']; ?></td>
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