<?php
include("./includes/header.php");

include("component.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <p><a href="index">dashboard/</a>send-mail</p>
    </div>

    <!-- Send mail -->
    <div class="card">
        <div class="card-header">
            <h4>Sending mail page</h4>
        </div>
        <form method="post" action="">
            <div class="modal-body">
                <div class="form-row">
                    <div class="col">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet iusto impedit repudiandae inventore molestiae voluptatem, in laborum vel quia consequuntur?</p>
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
            <div class="modal-footer justify-content-center">
                <button type="submit" name="send_mail_btn" class="btn btn-lg btn-primary"> Send </button>
            </div>
        </form>
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