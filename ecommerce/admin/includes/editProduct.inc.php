<?php
if (isset($_POST['editProduct'])) {
    if (isset($_GET['edit'])) {
        require "connect.inc.php";
        $name = $_POST['productName'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $productId = $_GET['edit'];
        $sql = "SELECT categoryName from category  where productID=(SELECT productID from product where productID=?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../productEdit.php?action=sqlerror");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt, "i", $productId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row2 = mysqli_fetch_assoc($result);
            if($row2['categoryName']!='instrument' and $quantity>1){
            $quantity = 1;
            }
            
        }
        $sql = "UPDATE product SET productName=?, quantity=?, price=?, description=?  WHERE productID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../productEdit.php?action=sqlerror");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt, "sddsi", $name, $quantity, $price, $description, $productId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            header("Location:../productList.php?action=editSuccess");
            
        }
    }
}
