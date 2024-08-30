<?php
include 'includes/autoloader.inc.php';
include_once "header.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css">
  </head>
  <body>
    <!-- Start your project here-->
    <!-- Section: Design Block -->
<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
  <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
          margin-top: -100px;
          background: hsla(0, 0%, 100%, 0.8);
          backdrop-filter: blur(30px);
          ">
      <div class="card-body py-5 px-md-5">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <?php
              //if(isset($_SESSION["userid"]))
             //{
            ?>
            <h2 class="fw-bold mb-5">Sign up now</h2>
            <form action="includes/signup.inc.php" method="post">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" name="username" class="form-control" />
                    <label class="form-label" >Username</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" name="email" class="form-control" />
                    <label class="form-label" >Email address</label>
                  </div>
                </div>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="pwd" class="form-control" />
                <label class="form-label" >Password</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="pwdrepeat" class="form-control" />
                <label class="form-label" >Repeat password</label>
              </div>
              <?php
                  if (isset($_GET["newpwd"])) {  //Proveravamo da li get[reset]  success
                      if ($_GET["newpwd"] == "passwordupdated") {
                          echo '<p class="signupsuccess">Your password has been reset!</p>';
                      }
                  }
              ?>
              <a href="reset-password.inc.php">Forgot your password?</a>
              <br><br>

              <!-- Checkbox -->
              <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                <label class="form-check-label" for="form2Example33">
                  Subscribe to our newsletter
                </label>
              </div>

              <!-- Submit button -->
              <button type="submit" name="submit"  class="btn btn-primary btn-block mb-4">
                Sign up
              </button>


              <!-- Register buttons -->
              <div class="text-center">
                <p>or sign up with:</p>
                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-github"></i>
                </button>
              </div>
            </form>
            <?php
              //}
              //else
              //{
            ?>
          <form action="includes/login.inc.php" method="post">
            <div class="col-md-6 mb-4">
              <div class="form-outline">
                <input type="text" name="username" class="form-control" />
                <label class="form-label" >Username</label>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="form-outline">
                <input type="password" name="pwd" class="form-control" />
                <label class="form-label" >Password</label>
              </div>
            </div>
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                Login
              </button>
           </form>
           <?php
              //}
            //?>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Section: Design Block -->
    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.umd.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>

