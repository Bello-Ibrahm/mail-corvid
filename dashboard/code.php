<?php
// require_once ("../database/Database.php");
include('./includes/mail.php');


//  Add mailing category
if (isset($_POST['mail_cat_btn'])){
    $db = new Database();

    $category_name = $_POST['category_name'];
    $user_id = $_POST['user_id'];
    
    // Check if category_name exist
    $db->query("SELECT category_name from category_tbl WHERE user_id = :user_id AND category_name = :category_name;");
    $db->bind(':user_id', $user_id);
    $db->bind(':category_name', $category_name);
    if ($db->execute()){
        if ($db->rowCount() > 0){
            echo "Category name exist";
        }else{
            // Insert category_name
            $db->query("INSERT INTO category_tbl(user_id, category_name) VALUES(:user_id, :category_name);");
            $db->bind(':user_id', $user_id);
            $db->bind(':category_name', $category_name);

            if ($db->execute()){
                $_SESSION['msg'] = true;
                $_SESSION['sessionIcon'] = "success";
                $_SESSION['errorTitle'] = "Success";
            }else{
                die("Error: ".$db->getError());
            }
        }
    }else{
        die("Error: ".$db->getError());
    }
}

// Add contact
if (isset($_POST['add_contact_btn'])){
    $db = new Database();

    $fname = $_POST['fname'];
    $oname = $_POST['oname'];
    $user_id = $_POST['user_id'];
    $email_address = $_POST['email'];
    $category_id = $_POST['category_id'];

    // Check if contact already added
    $db->query("SELECT email_address FROM contact_tbl WHERE user_id = :user_id AND category_id = :category_id AND email_address = :email_address LIMIT 1;");
    $db->bind(':user_id', $user_id);
    $db->bind(':category_id', $category_id);
    $db->bind(':email_address', $email_address);
    if ($db->execute()){
        if ($db->rowCount() > 0){
            $_SESSION['msg'] = true;
            $_SESSION['sessionIcon'] = "warning";
            $_SESSION['errorTitle'] = "Contact already subscribed";
        }else{
            $db->query("INSERT INTO contact_tbl(user_id, category_id, fname, oname, email_address) 
            VALUES(:user_id, :category_id, :fname, :oname, :email_address);");
            $db->bind(':user_id', $user_id);
            $db->bind(':category_id', $category_id);
            $db->bind(':fname', $fname);
            $db->bind(':oname', $oname);
            $db->bind(':email_address', $email_address); 

            if (($db->execute()) && (Mail::contactCreationMail($email_address, $fname." ".$oname))){
                $_SESSION['msg'] = true;
                $_SESSION['sessionIcon'] = "success";
                $_SESSION['errorTitle'] = "Contact added successfully";
                // if (Mail::contactCreationMail($email_address, $fname." ".$oname) === true){
                //     $_SESSION['msg'] = true;
                //     $_SESSION['sessionIcon'] = "warning";
                //     $_SESSION['errorTitle'] = "Contact added successfully";
                // }else{
                //     $_SESSION['msg'] = true;
                //     $_SESSION['sessionIcon'] = "error";
                //     $_SESSION['errorTitle'] = "Error occured, try again later";
                // }
            }else{
                $_SESSION['msg'] = true;
                $_SESSION['sessionIcon'] = "error";
                $_SESSION['errorTitle'] = "Error occured, try again later";
                die("Error: ".$db->getError());
            }
        }
    }else{
        die("Error: ".$db->getError());
    }
}

// Send mail
if(isset($_POST['send_mail_btn'])){
    $category_id = $_POST['category_id'];
    $subject = $_POST['subject'];
    $message_body = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    $db = new Database();

    $db->query("SELECT email_address FROM contact_tbl WHERE user_id = :user_id AND category_id = :category_id;");
    $db->bind(':user_id', $user_id);
    $db->bind(':category_id', $category_id);

    if ($db->execute()){
        if ($db->rowCount() > 0){
            $total_mail = $db->rowCount(); // Get the total numbers of email
            $result = $db->resultset();

            $db->query("INSERT INTO message_tbl(category_id, subject, body) VALUES(:category_id, :subject, :body);");
            $db->bind(':category_id', $category_id);
            $db->bind(':subject', $subject);
            $db->bind(':body', $message_body);
            if ($db->execute()){
                $count = 0;
                foreach($result as $row){
                    if (Mail::sendMail($row->email_address, $subject, $message_body) === true){
                        $count++;
                    }
                }
                if ($count === $total_mail){
                    $_SESSION['msg'] = true;
                    $_SESSION['sessionIcon'] = "success";
                    $_SESSION['errorTitle'] = "Mail sent";
                }else{
                    $_SESSION['msg'] = true;
                    $_SESSION['sessionIcon'] = "error";
                    $_SESSION['errorTitle'] = "Some mail not sent";
                }
            }else{
                die("Error: ".$db->getError());
            }
        }else{
            $_SESSION['msg'] = true;
            $_SESSION['sessionIcon'] = "warning";
            $_SESSION['errorTitle'] = "No contact email found";
        }
    }else{
        die("Error: ".$db->getError());
    }
}
    // Logout
if (isset($_POST['logout'])){
    $_SESSION['logged_in'] = false;
    unset($_SESSION['remember_me']);
    unset($_SESSION['username']);
    unset($_SESSION['user_id']);
    unset($_SESSION['fname']);
    unset($_SESSION['oname']);
    unset($_SESSION['user_type']);
    unset($_SESSION['login-time']);
    unset($_SESSION['passport']);
    
    header("Location: ../index");
}
