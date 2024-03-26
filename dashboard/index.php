<?php
include("./includes/header.php");

include("component.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard <?php  ?></h1>
        <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#sendMailModal">
            <i class="fas fa-envelope fa-fw fa-sm text-white-50"></i>
            Send newsletter
        </a>
    </div>

    <!-- Send mail Modal -->
    <div class="modal fade" id="sendMailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mailing page</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="gender">* Category</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value=""> Select category...</option>
                                        <?php getMailCategory(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gender">* Subject</label>
                                    <input type="text" name="subject" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">* Message:</label>
                                    <textarea name="message" id="summernote" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" name="send_mail_btn" class="btn btn-sm btn-primary"> Send </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Mailing category Modal -->
    <div class="modal fade" id="mailListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mailing category page</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col">
                                <p>Type in your mailing category in the textbox below and click on submit </p>
                                <div class="form-group">
                                    <label for="gender"> * Category</label>
                                    <input type="text" name="category_name" class="form-control">
                                    <input type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" hidden class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="gender">List of category</label>
                                    <select class="form-control" name="mail_cat_list">
                                        <option value=""> Category...</option>
                                        <?php 
                                         getMailCategory();
                                         ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" name="mail_cat_btn" class="btn btn-sm btn-primary"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<form action="" method="post">
    <button type="submit" class="my-1 btn" name="logout">Logout</button>
</form>
    <!-- Mailing category link Modal -->
    <div class="modal fade" id="getLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mailing category link page</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col">
                                <p>Select mailing category to create page </p>
                                <div class="form-group">
                                    <label for="gender">List of category</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value=""> Select category...</option>
                                        <?php getMailCategory(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" name="get-link" class="btn btn-sm btn-primary"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add contact Modal -->
    <div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contact registration page</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col">
                                <p>Select mailing category to create page </p>
                                <div class="form-group">
                                    <label>* First name:</label>
                                    <input type="text" name="fname" placeholder="First name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>* Other name:</label>
                                    <input type="text" name="oname" placeholder="Other name" class="form-control" required>
                                    <input type="text" hidden name="user_id" value="<?php echo $_SESSION['user_id']; ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>* Email address:</label>
                                    <input type="email" name="email" placeholder="Enter email address" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Category list</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value=""> Select category...</option>
                                        <?php getMailCategory(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_contact_btn" class="btn btn-sm btn-primary"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total subscriber card -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total contact</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php getAllSubscription(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscriber Card -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active subscriber</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php getSubscribed(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unsubscriber Card -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Unsubscriber</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php getUnsubscribed(); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3 d-sm-flex justify-content-between"> -->
        <div class="card-header p-1 ">
            <!-- <h6 class="m-0 font-weight-bold text-primary">Data Table Records</h6> -->
            <button class="btn btn-sm btn-primary d-sm-inline-block m-1" data-toggle="modal" data-target="#mailListModal">Add mailing category</button>
            <a class="btn btn-sm btn-primary m-1 d-sm-inline-block" href="portforlio?upr=<?php echo $_SESSION['username']; ?>&uid=<?php echo $_SESSION['user_id']; ?>" title="Open and copy the page URL" target="_blank">Subscription page</a>
            <button class="btn btn-sm btn-primary m-1 d-sm-inline-block" data-toggle="modal" data-target="#addContact">Add contact</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subscription</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subscription</th>
                            <th>Category</th>
                        </tr>
                    </tfoot> -->
                    <tbody>
                        <?php getContactRecord(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
include("includes/script.php");
include("includes/footer.php");
?>