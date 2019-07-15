<?php
include "header.php"
?>
<link rel="stylesheet" href="admin/css/productList.css">
<br>
<br>
<br>
<?php
if (isset($_SESSION['userID'])) {
    require "includes/connect.inc.php";
    if (isset($_POST['add_cart'])) {
        $quantity = $_POST['quantity'];
        if (isset($_GET['order'])) {
            $productId =  $_GET['order'];
            $sql = "SELECT categoryName from category where 
            productID=(SELECT productID from product where productID=? )";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: cart.php?error=sqlerror");
                exit();
            } else {

                mysqli_stmt_bind_param($stmt, "i", $productId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row_category = mysqli_fetch_assoc($result);
                if($row_category['categoryName']!='instrument'){
                    $quantity=1;
                }
            }
            $sql = "SELECT quantity from product where productID=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: cart.php?error=sqlerror2");
                exit();
            } else {

                mysqli_stmt_bind_param($stmt, "i", $productId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row_quantity = mysqli_fetch_assoc($result);
            }
            if ($row_quantity['quantity'] == 0) {
                header("Location:cart.php?stock=empty");
            } elseif ($quantity > $row_quantity['quantity']) {
                header("Location:cart.php?stock=notEnought");
            } else {
                $sql = "INSERT into cart (categoryID,productID,clientID,unit_number)  
                values((select categoryID from category where productID=(select productID from product where productID=?)),
                (select productID from product where productID=?),
                (select clientID from clients where clientID=?),?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: cart.php?error=sqlerror3");
                    exit();
                } else {

                    mysqli_stmt_bind_param($stmt,"iiii",$productId,$productId, $_SESSION['userID'],$quantity);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }
            }
        }
    }
    $sql = "SELECT * FROM cart
    INNER JOIN product ON (product.productID = cart.productID)
    INNER JOIN clients ON (clients.clientID = cart.clientID)
    INNER JOIN category ON (category.productID = cart.productID)
    WHERE  clients.clientID=? ;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: cart.php?error=sqlerror4");
        exit();
    }
    mysqli_stmt_bind_param($stmt,'i',$_SESSION['userID']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    ?>
    <main>
        <table class="table table-dark" style="background-color:black">
            <thead>
                <tr>
                    <th scope="col">name</th>
                    <th scope="col">image</th>
                    <th scope="col">price</th>
                    <th scope="col">quantity</th>
                    <th scope="col">quantity left</th>
                    <th scope="col">category</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['productName']; ?></td>
                        <td><img src="admin/upload_image/<?= $row['productImage']; ?>" alt="" style="width:60px;height:60px"></td>
                        <td><?= $row['price']; ?></td>
                        <td><?= $row['unit_number']; ?></td>
                        <td><?= $row['quantity']; ?></td>
                        <td><?= $row['categoryName']; ?></td>
                        <td><a class="btn btn-outline-success my-2 my-sm-0 " href="includes/delproduct.php?cart=<?= $row['productID']; ?>">Delete</a>                      
            
                    </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a class="btn btn-outline-success my-2 my-sm-0 " href="commande.php?order=success" style="background-color:black">
        Order now</a>
    </main>
<?php } else {
    header("Location:login.php");
} ?>
<br>
<br>
<?php
include "footer.php"
?>