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
                  <h1 class="h4 text-center  text-gray-900">Forgot password</h1>
                  <p class="">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit quidem aut, iusto veritatis odio ea?</p>
                  <hr>
                </div>
                <form class="user" method="post">
                  <div class="row">
                    <div class="col">
                      <div class="form-group text-center">
                        <!-- Alerts messages -->
                        <?php
                        if (isset($_SESSION['msg'])) {
                          echo '<script>
                                  Swal.fire({
                                    position: "top-end",
                                    icon: "' . $_SESSION['sessionIcon'] . '",
                                    title: "' . $_SESSION['errorTitle'] . '",
                                    showConfirmButton: false,
                                    timer: 2500
                                  });
                              </script>';
                          unset($_SESSION['msg']);
                          unset($_SESSION['sessionIcon']);
                          unset($_SESSION['errorTitle']);
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" name="email" required placeholder="Enter your email address">
                  </div>
                  <button class="btn btn-primary btn-user btn-block" name="btn-forgot_password">
                    Submit
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
include("includes/footer.php");
?>