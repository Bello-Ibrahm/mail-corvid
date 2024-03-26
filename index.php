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
                <div class="p-5">
                  <div class="mb-4">
                    <h1 class="h4 text-center  text-gray-900">Sign in</h1>
                    <p>
                    Your best email marketing platform that provides mailing services for businesses and individuals. 
                    This offers features such as email campaign creation, audience management, 
                    and marketing automation.
                    </p>
                    <hr>
                  </div>
                  <form class="user" method="post" action="">
                    <div class="row">
                      <div class="col">
                        <div class="form-group text-center">
                            <?php 
                                if (isset($_SESSION['err'])){
                                  echo "<div class='text-white bg-danger p-1 form-control'>". $_SESSION['err'] ."</div>";
                                  unset($_SESSION['err']);
                                }
                                if (isset($_SESSION['msg'])){
                                  echo "<div class='alert alert-success'>". $_SESSION['msg'] ."</div>";
                                  unset($_SESSION['msg']);
                                }
                                ?>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" required autocomplete="off" placeholder="Enter username...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="pwd" required autocomplete="off"  placeholder="Password">
                    </div>
                    <div class="bot-div mb-2">
                        <input type="checkbox" class="m-1" onchange="toggleBotDisplay();" id="bot_checkbox"> <label for="bot_checkbox"> I'm not a Bot? </label>
                    </div>
                    <div class="row d-none form-inline mb-2" id="bot-eval">
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="number" disabled  class="form-control q1">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for=""> + </label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="number" disabled  class="form-control q2">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for=""> = </label>
                          <input type="text" class="form-control total" hidden>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="number" onkeypress="isEqual();" onkeyup="isEqual();" class="form-control ans"  placeholder="" required>
                        </div>  
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <i class="fas fa-check text-success d-none" id="success"></i>    
                          <i class="fas fa-times text-danger d-none" id="fail"></i>
                        </div>  
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" name="remember_me" id="customCheck">
                        <label class="custom-control-label"  for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" name="btn-login" disabled>
                      Login
                    </button>
                    <hr>
                  </form>
                  <div class="">
                    <a class="small" href="forgot-password">Forgot Password?</a>
                  </div>
                  <div class="">
                    <a class="small" href="sign-up">Create an Account!</a>
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
