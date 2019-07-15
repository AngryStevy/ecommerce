
  <?php include "header.php"?>
  <?php 
  if(isset($_SESSION['userID'])){
      header("Location:index.php");
      ob_end_flush();
  }
  ?>
  <main>
  <div class="container">
      <?php
      include "css/login.css.php";
      ?>
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="img/profil.png" />
            <p id="profile-name" class="profile-name-card" >Login</p>
            <?php 
            if(isset($_GET['error'])){
                if($_GET['error'] == "emptyfield"){
                    echo '<p class="profile-name-card" style="color:red">fill all the field !!</p>';
                }
                else if($_GET['error'] == "wrong"){
                    echo '<p class="profile-name-card" style="color:red">wrong user or password !!</p>';
                }
                else if($_GET['error'] == "sqlerror"){
                    echo '<p class="profile-name-card" style="color:red">the connection failed try again !!</p>';
                }
            }
            
            ?>
            <form class="form-signin" action="includes/login.inc.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input name="email" type="text" id="inputEmail" class="form-control" placeholder="Email address" autofocus>
                <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" >
                <button name="login_submit" class="btn btn-lg btn-outline-success btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
</main>
<br>
<br>
<br>
<?php 
include "footer.php";
?>


