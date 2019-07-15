<?php 
if(isset($_GET['cart'])){
    require "connect.inc.php";
    $productId = $_GET['cart'];
    $sql = "DELETE FROM cart WHERE productID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../cart.php?action=sqlerror");
        exit();
    }else {

        mysqli_stmt_bind_param($stmt, "i", $productId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        header("Location:../cart.php?action=success");
    } 
}
?>