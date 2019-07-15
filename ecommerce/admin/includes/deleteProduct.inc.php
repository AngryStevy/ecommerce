<?php 
if(isset($_GET['delete'])){
    require "connect.inc.php";
    $productId=$_GET['delete']; 
    $sql = "SELECT productImage from product where productID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../productList.php?action=sqlerror");
        exit();
    }else {

        mysqli_stmt_bind_param($stmt, "i", $productId);
        mysqli_stmt_execute($stmt);
       $result2= mysqli_stmt_get_result($stmt);
       $row2 = mysqli_fetch_assoc($result2);
       unlink("../upload_image/".$row2['productImage']);
    }

    $sql = "SELECT productAudio from product where productID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../productList.php?action=sqlerror");
        exit();
    }else {

        mysqli_stmt_bind_param($stmt, "i", $productId);
        mysqli_stmt_execute($stmt);
       $result2= mysqli_stmt_get_result($stmt);
       $row2 = mysqli_fetch_assoc($result2);
       unlink("../upload_audio/".$row2['productAudio']);
    }

    $sql = "DELETE from category where productID=(select productID from product where productID=?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../productList.php?action=sqlerror");
        exit();
    }else {

        mysqli_stmt_bind_param($stmt, "i", $productId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    $sql = "DELETE from product where productID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../productList.php?action=sqlerror");
        exit();
    }else {

        mysqli_stmt_bind_param($stmt, "i", $productId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        header("Location:../productList.php?action=success");
    }

}
?>