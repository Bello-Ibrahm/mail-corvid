<?php
include("includes/header.php");
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
                    <p class="">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit quidem aut, iusto veritatis odio ea?</p>
                    <hr>
                  </div>
                  <form class="user" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Enter first name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputEmail" required placeholder="Enter other name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputEmail" required placeholder="Enter your username">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail" required placeholder="Enter Email Address...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <input type="password" class="form-control form-control-user" id="exampleInputPassword" required  placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <input type="password" class="form-control form-control-user" id="exampleInputPassword" required  placeholder="Confirm your password">
                              <span class="text-danger small">Confirm your password</span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
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
