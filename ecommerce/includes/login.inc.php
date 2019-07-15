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
        $sql = "SELECT * FROM clients WHERE email=?";
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
            $passCheck = password_verify($pass, $row['passwd']);
            if($passCheck == false){
                
                header("Location: ../login.php?error=wrong");
                exit();
            }
            else if($passCheck == true){
                session_start();
                $_SESSION['userID'] = $row['clientID'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['fname'] = $row['firstName'];
                $_SESSION['lname'] = $row['lastName'];
                header("Location: ../index.php?sucess");

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