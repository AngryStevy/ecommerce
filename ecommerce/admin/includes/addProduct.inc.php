<?php
require "connect.inc.php";
if (isset($_POST['addProduct'])) {
    $name = $_POST['productName'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $image = $_FILES['image'];
    $audio = $_FILES['audio'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // image declaration 
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];
    $imageError = $_FILES['image']['error'];
    $imageType = $_FILES['image']['type'];

    $imageExt = explode('.', $imageName);
    $imageActualExt =  strtolower(end($imageExt));
    $imageAllowed = array('jpg', 'jpeg', 'png');
    
    // audio declaration
    $audioName = $_FILES['audio']['name'];
    $audioTmpName = $_FILES['audio']['tmp_name'];
    $audioSize = $_FILES['audio']['size'];
    $audioError = $_FILES['audio']['error'];
    $audioType = $_FILES['audio']['type'];

    $audioExt = explode('.', $audioName);
    $audioActualExt =  strtolower(end($audioExt));
    $audioAllowed = array('mp3');

    if (empty($category)) {
        header('Location: ../addProduct.php?error=emptyCategory');
        exit();
        ///////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
    } elseif ($category != 'instrument') {
        $quantity = 1;
        if (empty($name) or empty($image) or empty($audio) or empty($price) or empty($description) or empty($quantity)) {
            header('Location: ../addProduct.php?error=emptyField');
            exit();
        } else {
            if(!in_array($audioActualExt, $audioAllowed)) {
                header('Location: ../addProduct.php?error=invalidAudioFormat');
                exit();
                // audio error handling
            } 
            elseif(in_array($audioActualExt, $audioAllowed)) {
                if ($audioError === 0){
                if ($audioSize < 16000000) {
                    $audioNewName = $name.".".$audioActualExt;
                    $audioDestination = '../upload_audio/'.$audioNewName;
                    move_uploaded_file($audioTmpName, $audioDestination);
                } else {
                    header('Location: ../addProduct.php?error=audioSizeLimit');
                    exit();
                }
            }else{
                header('Location: ../addProduct.php?error=audioUploadFailed '.$imageTmpName);
                    exit(); 
            }
            }
            // if the image dont respect the extension in the array in no instrument Category
            if (!in_array($imageActualExt, $imageAllowed)) {
                header('Location: ../addProduct.php?error=invalidImageFormat');
                exit();
            }
            // if the image  respect the extension in the array in  no instrument Category
            elseif (in_array($imageActualExt, $imageAllowed)) {
                if ($imageError === 0) {
                    if ($imageSize < 16000000) {
                        $imageNewName = $name.".".$imageActualExt;
                        $imageDestination = '../upload_image/'.$imageNewName;
                        move_uploaded_file($imageTmpName, $imageDestination);
                    } else {
                        header('Location: ../addProduct.php?error=imageSizeLimit');
                        exit();
                    }
                } else{
                    header('Location: ../addProduct.php?error=imageUploadFailed');
                    exit();
                }
            }
       
        }
        $sql = "SELECT * FROM product WHERE productName=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../addProduct.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../addProduct.php?error=productNameTaken");
                exit();
            } else {
                $sql = "INSERT INTO product (productName, productImage, productAudio, description, price, quantity) VALUES (?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../addProduct.php?error=sqlerror");
                    exit();
                } else {

                    mysqli_stmt_bind_param($stmt, "ssssdd", $name, $imageNewName, $audioNewName, $description, $price, $quantity);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                            $sql = "INSERT INTO category (categoryName,productID) VALUES (?,(select productID from 
                            product where productName=?))";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../addProduct.php?error=sqlerror");
                                exit();
                            }else {

                                mysqli_stmt_bind_param($stmt, "ss", $category,$name);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_store_result($stmt);
                                header("Location: ../addProduct.php?result=success");
                            }
                   
                    
                }

            }
        }
        //////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////
    } elseif ($category == 'instrument') {
        $audio = null;
        if (empty($name) or empty($quantity) or empty($image) or empty($price) or empty($description)) {
            header('Location: ../addProduct.php?error=emptyField');
            exit();
        } else {
            // if the image dont respect the extension in the array in  instrument Category
            if (!in_array($imageActualExt, $imageAllowed)) {
                header('Location: ../addProduct.php?error=invalidImageFormat');
                exit();
            }
            // if the image  respect the extension in the array in  instrument Category
            elseif (in_array($imageActualExt, $imageAllowed)) {
                if ($imageError === 0) {
                    if ($imageSize < 16000000) {
                        $imageNewName = $name.".".$imageActualExt;
                        $imageDestination = '../upload_image/'.$imageNewName;
                        move_uploaded_file($imageTmpName, $imageDestination);
                    } else {
                        header('Location: ../addProduct.php?error=imageSizeLimit');
                        exit();
                    }
                } elseif ($imageError != 0) {
                    header('Location: ../addProduct.php?error=imageUploadFail');
                    exit();
                }
                $sql = "SELECT * FROM product WHERE productName=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../addProduct.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $name);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    if ($resultCheck > 0) {
                        header("Location: ../addProduct.php?error=productNameTaken");
                        exit();
                    } else {
                        $sql = "INSERT INTO product (productName, productImage, productAudio, description, price, quantity) VALUES (?,?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../addProduct.php?error=sqlerror");
                            exit();
                        } else {

                            mysqli_stmt_bind_param($stmt, "ssssdd", $name, $imageNewName, $audio, $description, $price, $quantity);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            
                                    $sql = "INSERT INTO category (categoryName,productID) VALUES (?,(select productID from 
                                    product where productName=?))";
                                    $stmt = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                                        header("Location: ../addProduct.php?error=sqlerror");
                                        exit();
                                    }else {
        
                                        mysqli_stmt_bind_param($stmt,"ss",$category,$name);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_store_result($stmt);
                                        header("Location: ../addProduct.php?result=success");
                                    }
                            
                        }
                    }
                } //
            }
        }
    }
}
