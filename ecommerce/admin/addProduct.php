<?php
include "header.php";
?>
<?php 
include "css/addProduct.css.php";
?>
<?php 
require "script/display.php";
?>

<main>
    <div class="container">
        <div class="card card-container">
            <p id="profile-name" class="profile-name-card">
                Add Product
            </p>
            <?php 
            if(isset($_GET['error'])){
                if($_GET['error'] == "emptyfields"){
                    echo '<p class="profile-name-card" style="color:red">Fill all the field !!</p>';
                }
                else if($_GET['error'] == "invalidemail"){
                    echo '<p class="profile-name-card" style="color:red">insert a valid email !!</p>';
                }
                else if($_GET['error'] == "invaliduid"){
                    echo '<p class="profile-name-card" style="color:red">insert a valid name !!</p>';
                }
                else if($_GET['error'] == "passwordCheck"){
                    echo '<p class="profile-name-card" style="color:red">your password don\'t match try again!!</p>';
                }
                else if($_GET['error'] == "sqlerror"){
                    echo '<p class="profile-name-card" style="color:red">the registration fail try again!!</p>';
                }
                else if($_GET['error'] == "emailTaken"){
                    echo '<p class="profile-name-card" style="color:red">the email already exist!!</p>';
                }
                else if($_GET['error'] == "nameTaken"){
                    echo '<p class="profile-name-card" style="color:red">the name already exist!</p>';
                }
            }
            
            ?>
            <form class="form-signin" action="includes/addProduct.inc.php" method="POST" enctype="multipart/form-data">
                <span id="reauth-email" class="reauth-email"></span>
                <input name="productName" type="text" id="inputName" class="form-control" placeholder="product name">
                <h5 style="color:#009900">Category</h5>
                <div style="color:#009900">
                <div class="radio">
  <label><input type="radio" name="category" id="c1" value="trap">Trap</label>
</div>
<div class="radio">
  <label><input type="radio" name="category" id="c2" value="old-school">Old School</label>
</div>
<div class="radio disabled">
  <label><input type="radio" name="category" id="c3" value="RnB">RnB</label>
</div>
<div class="radio disabled">
  <label><input type="radio" name="category" id="c4" value="instrument">Instrument</label>
</div>
</div>
                <input name="quantity" type="number" id="inputQuantity" class="form-control" placeholder="quantity" style="display:none">
                <br>
                <div class="custom-file mb-3" id="mp3" style="display:none">
                    <input name="audio" type="file" class="custom-file-input" id="customFile" name="addProduct">
                    <label class="custom-file-label" for="customFile">Choose a song</label>
                </div>
                <div class="custom-file mb-3">
                    <input name="image" type="file" class="custom-file-input" id="customFile" name="addProduct">
                    <label class="custom-file-label" for="customFile">Choose an image</label>
                </div>
                <input name="price" type="text" id="inputPrice" class="form-control" placeholder="price">
                <h5 style="color:#009900">description</h5>
                <textarea name="description" class="form-control" id="description" cols="30" rows="5"
                    placeholder="description"></textarea>
                <br>
                <button name="addProduct" class="btn btn-lg btn-outline-success btn-block btn-signin"
                    type="submit">Add Product</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</main>
<?php
include "footer.php"
?>
