<?php
require "header.php";
?>
<?php
if (isset($_GET['order'])) {
    if ($_GET['order'] == 'success') {
        require "includes/connect.inc.php";
        $sql = "SELECT * FROM cart
        INNER JOIN product ON (product.productID = cart.productID)
        INNER JOIN clients ON (clients.clientID = cart.clientID)
        INNER JOIN category ON (category.productID = cart.productID)
        WHERE clients.clientID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: cart.php?error=sqlerror1");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($update_quantity = mysqli_fetch_assoc($result)) {
                $sql = "UPDATE product set quantity=? where productID=?";
                $newQuantity = $update_quantity['quantity'] - $update_quantity['unit_number'];
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: cart.php?error=sqlerror1");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ii", $newQuantity, $update_quantity['productID']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }
            }
        }

        $sql = "SELECT productID from cart where clientID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: cart.php?error=sqlerror1");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row_cart = mysqli_fetch_assoc($result)) {
                $date = date("Y/m/d");
                $sql = "INSERT into orders (productID,clientID,orderDate,unit) values (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: cart.php?error=sqlerro2");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "iiii", $row_cart['productID'], $_SESSION['userID'], $date, $row_cart['unit_number']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }
            }
        }

        if (mysqli_stmt_store_result($stmt)) {
            $sql = "DELETE from cart where clientID=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: cart.php?error=sqlerror3");
                exit();
            } else {

                mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                ?>
                <br>
                <br>
                <br>
                <br>
                <main>
                    <h1>Order sucessful</h1>
                </main>
            <?php     }
    }
}
} ?>
<?php
require "footer.php";
?>