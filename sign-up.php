<?php
include("includes/header.php");
include("code.php");
?>


  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-md-8 my-5">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <div class="py-5 px-2">
                  <div class="mb-4">
                    <h1 class="h4 text-center  text-gray-900">Sign up!</h1>
                    <p>
                      Your best email marketing platform that provides mailing services for businesses and individuals. 
                      This offers features such as email campaign creation, audience management, 
                      and marketing automation.
                    </p>
                    <hr>
                  </div>
                  <form class="user" method="post" action="sign-up" enctype="multipart/form-data">
                    <div class="row my-5 text-center">
                      <div class="col">
                          <img id="image" class="form-control-img img-thumbnail" width="100px" height="100px" />
                          <p class="text-danger" style="font-size: 13px;"> Image size should be in the range of 1KB to 100KB</p>
                          <input type="file" name="fileToUpload" onchange="loadFile(event)" />
                          <br>
                          <span class="text-danger small"><?php if (isset($errorPicture)){echo $errorPicture;} ?></span>
                      </div>
                    </div>
                    <div class="row text-center">
                      <div class="col">
                        <div class="form-group">
                          <?php 
                              if (isset($errorSuccess)){
                                echo "<div class='text-white bg-success p-1 form-control'>$errorSuccess</div>";
                              }
                              if (isset($errorMsg)){
                                echo "<div class='text-white bg-danger p-1 form-control'>$errorMsg</div>";
                              }
                              ?>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" value="<?php if (isset($_POST['fname'])){echo $_POST['fname'];} ?>" name="fname" placeholder="Enter first name">
                                <span class="text-danger small"><?php if (isset($errorFname)){echo $errorFname;} ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" value="<?php if (isset($_POST['oname'])){echo $_POST['oname'];} ?>" name="oname" placeholder="Enter other name">
                                <span class="text-danger small"><?php if (isset($errorOname)){echo $errorOname;} ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" value="<?php if (isset($_POST['username'])){echo $_POST['username'];} ?>" name="username" placeholder="Enter your username">
                                <span class="text-danger small"><?php if (isset($errorUsername)){echo $errorUsername;} ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" placeholder="Enter Email Address...">
                                <span class="text-danger small"><?php if (isset($errorEmail)){echo $errorEmail;} ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <input type="password" class="form-control form-control-user" name="pwd"  placeholder="Password">
                              <span class="text-danger small"><?php if (isset($errorPassword)){echo $errorPassword;} ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <input type="password" class="form-control form-control-user" name="confirm_pwd" placeholder="Confirm your password">
                              <span class="text-danger small"><?php if (isset($errorConfirmPassword)){echo $errorConfirmPassword;} ?></span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" name="btn_signup">
                      Sign-up
                    </button>
                    <hr>
                  </form>
                  <div class="">
                    <a class="small" href="index">Back</a>
                  </div>
                </div>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php
        include("./includes/footer.php");
        ?>
