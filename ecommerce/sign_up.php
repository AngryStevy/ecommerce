
<?php
include "header.php";
?>
<?php 
include "css/sign_up.css.php";
?>
<main>
<div class="container">
        <div class="card card-container">
            <p id="profile-name" class="profile-name-card">
                registration form
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
            <form class="form-signin" action="includes/signup.inc.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input name="email" type="text" id="inputEmail" class="form-control" placeholder="Email address" >
                <input name="fname" type="text" id="inputFname" class="form-control" placeholder="First name" >
                <input name="lname" type="text" id="inputLname" class="form-control" placeholder="Last name" >
                <input name="address" type="text" id="inputAddress" class="form-control" placeholder="Address" >
                <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" >
                <input name="vpass" type="password" id="vinputPassword" class="form-control" placeholder="Password" >
                <button name="signup_submit" class="btn btn-lg btn-outline-success btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
</main>
<?php
include "footer.php"
?>