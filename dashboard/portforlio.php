<?php
// require_once("includes/header.php");


function SetSubscriptionPage($user, $user_id)
{
    $filename = "../sub-list/$user.php";

    if (file_exists($filename)) {
        header("Location: ../sub-list/$user?uid=$user_id"); // Open created user link page
    } else {
        // Create a file
        $file = fopen($filename, 'w') or die("Unable to open file");
        // $text = $user_id;
        $text = '<?php
        if (isset($_GET[\'uid\'])) {
            include("../database/Database.php");
            include("../dashboard/component.php");
            include("../dashboard/includes/mail.php");
            if (isset($_POST[\'btn-subcribe\'])) {
                $db = new Database();

                $fname = $_POST[\'fname\'];
                $oname = $_POST[\'oname\'];
                $email = $_POST[\'email\'];
                $category_id = $_POST[\'category_id\'];
                $user_id = $_GET[\'uid\'];

                // confirm user_id 
                $db->query("SELECT user_id FROM user_tbl WHERE user_id = :user_id;");
                $db->bind(\':user_id\', $user_id);
                if ($db->execute()) {
                    if ($db->rowCount() > 0) {
                        // Check if already subscribed
                        $db->query("SELECT email_address FROM contact_tbl WHERE email_address = :email AND user_id = :user_id;");
                        $db->bind(\':email\', $email);
                        $db->bind(\':user_id\', $user_id);
                        if ($db->execute()) {
                            if ($db->rowCount() > 0) {
                                $_SESSION[\'msgWarning\'] = "Already subscibed";
                            } else {
                                $db->query("INSERT INTO contact_tbl(user_id, category_id, fname, oname, email_address)
                                VALUES(:user_id, :category_id, :fname, :oname, :email);");

                                $db->bind(\':user_id\', $user_id);
                                $db->bind(\':category_id\', $category_id);
                                $db->bind(\':fname\', $fname);
                                $db->bind(\':oname\', $oname);
                                $db->bind(\':email\', $email);

                                if (($db->execute()) && (Mail::contactCreationMail($email, $fname.\' \'.$oname))) {
                                    $_SESSION[\'msgSuccess\'] = "Successfully subscribed";
                                } else {
                                    die("Error: " . $db->getError());
                                }
                            }
                        } else {
                            die("Error: " . $db->getError());
                        }
                    } else {
                        $_SESSION[\'msgWarning\'] = "User ID does not exist";
                    }
                } else {
                    die("Error: " . $db->getError());
                }
                $db->Disconect();
            }
        ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>

                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta name="description" content="">
                <meta name="author" content="">

                <title>Mailcorvid</title>

                <link rel="icon" href="../prototype-image/logo-no_bg.png" type="image/png" />

                <!-- Custom fonts for this template-->
                <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
                <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

                <!-- Custom styles for this template-->
                <link href="../css/sb-admin-2.min.css" rel="stylesheet">

            </head>

            <body>
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
                                                    <h1 class="h4 text-center  text-gray-900">Subscription page</h1>
                                                    <p class="">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit quidem aut, iusto veritatis odio ea?</p>
                                                    <hr>
                                                </div>
                                                <form class="user" method="post" action="">
                                                    <div class="row text-center">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <?php
                                                                if (isset($_SESSION[\'msgSuccess\'])) {
                                                                    echo "<div class=\'alert alert-success\'>" . $_SESSION[\'msgSuccess\'] . "</div>";
                                                                    unset($_SESSION[\'msgSuccess\']);
                                                                }
                                                                if (isset($_SESSION[\'msgError\'])) {
                                                                    echo "<div class=\'alert alert-danger\'>" . $_SESSION[\'msgError\'] . "</div>";
                                                                    unset($_SESSION[\'msgError\']);
                                                                }
                                                                if (isset($_SESSION[\'msgWarning\'])) {
                                                                    echo "<div class=\'alert bg-warning\'>" . $_SESSION[\'msgWarning\'] . "</div>";
                                                                    unset($_SESSION[\'msgWarning\']);
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-user" name="fname" placeholder="First name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-user" name="oname" placeholder="Other name" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <select name="category_id" class="form-control" required>
                                                                    <option value="">Select category...</option>
                                                                    <?php if (isset($_GET[\'uid\'])) {
                                                                        getCategoryByUID($_GET[\'uid\']);
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="email" class="form-control form-control-user" name="email" placeholder="Email address" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary btn-user btn-block" name="btn-subcribe">
                                                        Subscribe
                                                    </button>
                                                    <hr>
                                                </form>
                                                <div class="">
                                                    <a class="small" href="../index">Home</a>
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

            </body>

            </html>
        <?php
        } else {
            header(\'Location: ../\');
        }';

        // $test = "<h1 class=\" \" name=''></h1>";

        fwrite($file, $text);
        fclose($file);
        header("Location: ../sub-list/$user?uid=$user_id"); // Open created user link page
    }
}


// if (isset($_POST['get-link'])){
//     $username = $_SESSION['username'];
//     $user_id = $_SESSION['user_id'];
//     $filename = "../sub-list/$username.php";
//     if (file_exists($filename)){
//         SetSubscriptionPage($user_id, $username);
//         // header("Location: $filename?user_id=$user_id&category_id=2"); // Open created user link page
//     }else{
//         // Create a file
//         $file = fopen($filename, 'w') or die("Unable to open file");
//         $text = "<?php \n echo 'It work fine';";
//         fwrite($file, $text);
//         fclose($file);
//         header("Location: $filename?user_id=$user_id&category_id=2"); // Open created user link page
//     }

// }
if (isset($_GET['upr'])) {
    $user = $_GET['upr'];
    $user_id = $_GET['uid'];
    SetSubscriptionPage($user, $user_id);
}
