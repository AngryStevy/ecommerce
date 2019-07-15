<?php
require "header.php"
?>
<?php 
include "css/addProduct.css.php";
?>
<main>
<div class="container">
        <div class="card card-container">
            <p id="profile-name" class="profile-name-card">
                Edit Product
            </p>
<form class="form-signin" action="includes/editProduct.inc.php?edit=<?= $_GET['edit'] ?>" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input name="productName" type="text" id="inputName" class="form-control" placeholder="product name">
                <input name="quantity" type="number" id="inputQuantity" class="form-control" placeholder="quantity" >
                <br>

                <input name="price" type="text" id="inputPrice" class="form-control" placeholder="price">
                <h5 style="color:#009900">description</h5>
                <textarea name="description" class="form-control" id="description" cols="30" rows="5"
                    placeholder="description"></textarea>
                <br>
                <button name="editProduct" class="btn btn-lg btn-outline-success btn-block btn-signin"
                    type="submit">Edit Product</button>
            </form>
            </div><!-- /card-container -->
    </div><!-- /container -->
</main>
<?php
require "footer.php"
?>