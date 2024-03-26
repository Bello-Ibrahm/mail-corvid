<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


include("./database/Database.php");


// Sign-up code
if (isset($_POST['btn_signup'])) {
    $error = false;

    $fname = $_POST['fname'];
    $oname = $_POST['oname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $confirm_pwd = $_POST['confirm_pwd'];

    if (empty($fname)) {
        $error = true;
        $errorFname = "First name required";
    }
    if (empty($oname)) {
        $error = true;
        $errorOname = "Other name required";
    }
    if (empty($username)) {
        $error = true;
        $errorUsername = "Username required";
    }
    if (empty($email)) {
        $error = true;
        $errorEmail = "Email required";
    }
    if (empty($pwd)) {
        $error = true;
        $errorPassword = "Password required";
    }
    if (empty($confirm_pwd)) {
        $error = true;
        $errorConfirmPassword = "Confirm password required";
    }

    if ($pwd === $confirm_pwd) {
        $db = new Database();

        $hash_pwd = password_hash($pwd, PASSWORD_BCRYPT);

        // For image upload
        $fileToUpload = strtolower($_FILES["fileToUpload"]["name"]);
        //specifying the directory where the file is going to be placed.
        $target_dir = "upload/";
        //specifying path of the file to be uploaded
        $target_file = $target_dir . basename($fileToUpload);
        //Getting the file extension
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //check if file type is an image
        $imgType = ["jpg", "gif", "jpeg", "png"];

        // Checks if username exist
        $db->query("SELECT * FROM user_tbl WHERE username = :username LIMIT 1;");
        $db->bind(':username', $username);

        if ($db->execute()) {
            if ($db->rowCount() > 0) {
                $getUsername = $db->single()->username;
                $error = true;
                $errorMsg = "$getUsername exist";
            }
        } else {
            die("Error " . $db->getError());
        }

        // Checks if email exist
        $db->query("SELECT * FROM user_tbl WHERE email = :email LIMIT 1;");
        $db->bind(':email', $email);
        if ($db->execute()) {
            if ($db->rowCount() > 0) {
                $getEmail = $db->single()->email;
                $error = true;
                $errorMsg = "$getEmail exist";
            }
        } else {
            die("Error " . $db->getError());
        }

        if ($fileToUpload) { // Check if user upload an image
            //Checking for image size
            if ($_FILES['fileToUpload']['size'] > 102405 || $_FILES['fileToUpload']['size'] < 1024) {
                $error = true;
                $errorMsg = "Image size within 15KB to 100KB";
            }

            //Checking for image type
            if (!in_array($imageFileType, $imgType)) {
                $error = true;
                $errorMsg = "The file is not an image type";
            }

            // check if file exists
            if (file_exists($target_file)) {
                $error = true;
                $errorMsg = "Picture exist!";
            }

            if (!$error) {
                $db->query("INSERT INTO user_tbl(
                    fname,
                    oname,
                    username,
                    email,
                    pwd,
                    user_type,
                    passport
                ) 
                
                VALUES(
                    :fname,
                    :oname,
                    :username,
                    :email,
                    :pwd,
                    :user_type,
                    :passport
                    )
                ");

                $db->bind(':fname', $fname);
                $db->bind(':oname', $oname);
                $db->bind(':username', $username);
                $db->bind(':email', $email);
                $db->bind(':pwd', $hash_pwd);
                $db->bind(':user_type', "User");
                $db->bind(':passport', $target_file);

                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && ($db->execute())) {
                    header('Location: index');
                    // $errorSuccess = "Form submitted successfully";
                    $_SESSION['msg'] = "User registered successfully";
                } else {
                    die("Error: " . $db->getError());
                }
            }
        } else { // Registration without image upload
            if (!$error) {
                $db->query("INSERT INTO user_tbl(
                    fname,
                    oname,
                    username,
                    email,
                    pwd,
                    user_type
                ) 
                
                VALUES(
                    :fname,
                    :oname,
                    :username,
                    :email,
                    :pwd,
                    :user_type
                    )
                ");

                $db->bind(':fname', $fname);
                $db->bind(':oname', $oname);
                $db->bind(':username', $username);
                $db->bind(':email', $email);
                $db->bind(':pwd', $hash_pwd);
                $db->bind(':user_type', "User");

                if ($db->execute()) {
                    header('Location: index');
                    // $errorSuccess = "Form submitted successfully";
                    $_SESSION['msg'] = "User registered successfully";
                } else {
                    die("Error: " . $db->getError());
                }
            }
        }

        $db->Disconect();
    } else {
        $error = true;
        $errorMsg = "Password does not match confirm passsword";
    }
}


// Loging code
if (isset($_POST['btn-login'])) {
    $db = new Database();

    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    $db->query("SELECT * FROM user_tbl WHERE username=:username LIMIT 1;");
    $db->bind(':username', $username);
    if ($db->execute()) {
        if ($db->rowCount() > 0) {
            $data = $db->single();

            if (password_verify($pwd, $data->pwd)) {
                if (isset($_POST['remember_me'])) { // Handle auto logout if remember me is checked
                    $_SESSION['logged_in'] = true;
                    $_SESSION['remember_me'] = true;
                    $_SESSION['username'] = $data->username;
                    $_SESSION['fname'] = $data->fname;
                    $_SESSION['oname'] = $data->oname;
                    $_SESSION['user_type'] = $data->user_type;
                    $_SESSION['user_id'] = $data->user_id;
                    $_SESSION['passport'] = $data->passport;
                    $_SESSION['login-time'] = time();
                    header('Location: dashboard/');
                } else {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['remember_me'] = false;
                    $_SESSION['username'] = $data->username;
                    $_SESSION['fname'] = $data->fname;
                    $_SESSION['oname'] = $data->oname;
                    $_SESSION['user_type'] = $data->user_type;
                    $_SESSION['user_id'] = $data->user_id;
                    $_SESSION['passport'] = $data->passport;
                    $_SESSION['login-time'] = time();
                    header('Location: dashboard/');
                }
            } else {
                $_SESSION['err'] = "Invalid password for $username";
            }
        } else {
            $_SESSION['err'] = "$username not found";
        }
    } else {
        die("Error: " . $db->getError());
    }


    $db->Disconect();
}

// Forgot password code
if (isset($_POST['btn-forgot_password'])) {
    // require_once('dashboard/includes/mail.php'); TODO

    $db = new Database();

    $email = $_POST['email'];

    // Checka if email exist
    $db->query("SELECT * FROM user_tbl WHERE email = :email LIMIT 1;");
    $db->bind(':email', $email);
    if ($db->execute()) {
        if ($db->rowCount() > 0) {
            $result = $db->single();
            $email = $result->email;
            $id = $result->user_id;
            $token = password_hash(uniqid(), PASSWORD_DEFAULT);

            // TODO
            // Update the change_pwd to 1 in the database
            // $db->query("UPDATE user_tbl SET change_pwd = 1, token = :token WHERE email = :email"); // Request for change of password
            // $db->bind(':email', $email);
            // $db->bind(':token', $token);
            // if (($db->execute()) && Mail::forgotPasswordEmail($email, $token)) {
            //     $_SESSION['msg'] = true;
            //     $_SESSION['sessionIcon'] = "success";
            //     $_SESSION['errorTitle'] = "Password reset has been sent to this $email";
            // } else {
            //     $_SESSION['msg'] = true;
            //     $_SESSION['sessionIcon'] = "error";
            //     $_SESSION['errorTitle'] = "Error occured";
            //     die($db->getError());
            // }
        } else {
            $_SESSION['msg'] = true;
            $_SESSION['sessionIcon'] = "warning";
            $_SESSION['errorTitle'] = "$email is not a registered account";
        }
    } else {
        die($db->getError());
    }
    $db->Disconect();
}
