<?php
include("./includes/header.php");

include("component.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <p><a href="index">dashboard/</a>sent-mail</p>
    </div>

    <!-- Sent mail -->
    <!-- <div class="container-fluid"> -->

    
    <form action="" method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" name="msg_id">
                        <option value="">Select subject...</option>
                        <?php getSubjectRecord(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="btn-view">View</button>
                </div>
            </div>
        </div>
    </form><br><br>

    <?php 
        if (isset($_POST['btn-view'])){
            $msg_id = $_POST['msg_id'];

            $db = new Database();

            $db->query("SELECT * FROM message_tbl
            AS mt
            JOIN category_tbl AS ct ON mt.category_id = ct.category_id 
            WHERE message_id = :msg_id
            LIMIT 1;");
            $db->bind(':msg_id', $msg_id);

            if ($db->execute()){
                if ($db->rowCount() > 0){
                    $row = $db->single();
                    echo '<div class="row">';
                        echo "<div class='col-md-6'><h4>Message category: </h4>$row->category_name </div>";
                        echo "<div class='col-md-6'><h4>Subject: </h4>$row->subject </div>";
                        echo '</div><br>';
                    echo '<div class="row">';
                        echo "<div class='col'><h4>Body: </h4> $row->body </div>";
                    echo '</div>';
                }else{
                    echo "Empty record returned";
                }
            }else{
                die("Error: ".$db->getError());
            }

            $db->Disconect();
        }
    ?>
    <!-- </div> -->
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