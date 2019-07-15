<?php 
if(isset($_POST["signup_submit"])){

    require "connect.inc.php";
    $email = $_POST["email"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $pass = $_POST["pass"];
    $vpass = $_POST["vpass"];
    $address= $_POST["address"];
    if(empty($email) || empty($fname) || empty($lname) || empty($pass) || empty($vpass) || empty($address) ){
        header("Location: ../sign_up.php?error=emptyfields&email=".$email."&fname=".$fname."&lname=".$lname."&address=".$address);
        exit();
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$fname) 
    && !preg_match("/^[a-zA-Z0-9]*$/",$lname) ){
        exit();
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$fname) ){
        header("Location: ../sign_up.php?error=invalidemail&email=");
        header("Location: ../sign_up.php?error=invaliduid&email=".$lname);
        exit();
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$lname) ){
        header("Location: ../sign_up.php?error=invalidemail&email=");
        header("Location: ../sign_up.php?error=invaliduid&email=".$fname);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/",$fname) && !preg_match("/^[a-zA-Z0-9]*$/",$lname) ){
        header("Location: ../sign_up.php?error=invaliduid&email=".$email);
        exit();
    }

    else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header("Location: ../sign_up.php?error=invalidemail&fname=".$fname."&lname=".$lname);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/",$fname)){
        header("Location: ../sign_up.php?error=invaliduid&email=".$email."&lname=".$lname);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/",$lname)){
        header("Location: ../sign_up.php?error=invaliduid&email=".$email."&fname=".$fname);
        exit();
    }
    else if($pass != $vpass){
        header("Location: ../sign_up.php?error=passwordCheck&email=".$email."&fname=".$fname."&lname=".$lname);
        exit();
    }
   
    else {
        $sql = "SELECT * FROM clients WHERE firstName=? AND lastName=?";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../sign_up.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"ss",$fname,$lname);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../sign_up.php?error=nameTaken&email=".$email);
                exit();
            }
            else {
                $sql = "SELECT * FROM clients WHERE email=?";
                $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("Location: ../sign_up.php?error=sqlerror");
                    exit();
                  }
                else{
                    mysqli_stmt_bind_param($stmt,"s",$email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    if($resultCheck > 0){
                        header("Location: ../sign_up.php?error=emailTaken&fname=".$fname."&lname=".$lname);
                        exit();
                    } 
                    else {
                        $sql = "INSERT INTO clients (lastName, firstName, address, email, passwd) VALUES (?,?,?,?,?)";
                        $stmt= mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql)){
                            header("Location: ../sign_up.php?error=sqlerror");
                            exit();
                        }
                        else{
                            $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt,"sssss",$lname,$fname,$address,$email,$hashedPwd);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt); 
                            header("Location: ../sign_up.php?signup=success"); 
                            exit();
                        }           
                    }
                  }
            }
       
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../sign_up.php"); 
    exit(); 
}
?>