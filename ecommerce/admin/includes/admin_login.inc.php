<?php 
require "connect.inc.php";
if(isset($_POST["login_submit"])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if( empty($pass) || empty($email)){
    header("Location: ../login.php?error=emptyfield");
    exit();
    }
    else{
        $sql = "SELECT * FROM administrator WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../login.php?error=sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            if($pass != $row['passwd']){
                
                header("Location: ../admin_login.php?error=wrong");
                exit();
            }
            else if($pass == $row['passwd']){
                session_start();
                $_SESSION['adminID'] = $row['administratorID'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['fname2'] = $row['FirstName'];
                $_SESSION['lname2'] = $row['LastName'];
                header("Location: ../admin_page.php?sucess");

       }
    
        }
        else{
            header("Location: ../login.php?error=wrong");
            exit();
        }
        
    }
}
}
else{
    header("Location: ../login.php");
}
?>