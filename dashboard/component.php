<?php 
// include("../database/Database.php");


function getMailCategory(){
    $db = new Database();
    $user_id = $_SESSION['user_id'];

    $db->query("SELECT * FROM category_tbl WHERE user_id =:user_id;");
    $db->bind(':user_id', $user_id);
    if ($db->execute()){
        if ($db->rowCount() > 0){
            $data = $db->resultset();
            foreach($data as $row){
                echo "<option value='$row->category_id'>$row->category_name</option>";
            }
        }else{
            echo "<option value=''>No record found</option>";
        }
    }else{
        die("Error: ".$db->getError());
    }
    $db->Disconect();
}

function getContactRecord(){
    $db = new Database();

    $user_id = $_SESSION['user_id'];
    $db->query("SELECT * FROM contact_tbl AS con JOIN category_tbl AS cat ON con.category_id = cat.category_id WHERE con.user_id = :user_id ORDER BY cat.category_id DESC;");
    $db->bind(':user_id', $user_id);
    if ($db->execute()){
        if ($db->rowCount() > 0){
            $data = $db->resultset();
            foreach($data as $row){
                echo "<tr>";
                echo "<td>$row->fname $row->oname </td>";
                echo "<td>$row->email_address</td>";
                echo ($row->subscription_status === "1") ? "<td>Subscribed</td>" : "<td>Unsubscribed</td>";
                echo "<td>$row->category_name</td>";
                echo "</tr>";
            }
        }else{
            echo "<tr class='text-center'>";
            echo "<td colspan=4>Contact list is empty</td>";
            echo "</tr>";
        }
    }else{
        die("Error: ".$db->getError());
    }
}

function getAllSubscription(){
    $db = new Database();

    $user_id = $_SESSION['user_id'];

    $db->query("SELECT * FROM contact_tbl WHERE user_id = :user_id;");
    $db->bind(':user_id', $user_id);
    
    if ($db->execute()){
        echo $db->rowCount();
    }
    else{
        die("Error :".$db->getError());
    }
    $db->Disconect();
}
function getSubscribed(){
    $db = new Database();

    $user_id = $_SESSION['user_id'];

    $db->query("SELECT * FROM contact_tbl WHERE user_id = :user_id AND subscription_status = '1';");
    $db->bind(':user_id', $user_id);
    
    if ($db->execute()){
        echo $db->rowCount();
    }
    else{
        die("Error :".$db->getError());
    }
    $db->Disconect();
}
function getUnsubscribed(){
    $db = new Database();

    $user_id = $_SESSION['user_id'];

    $db->query("SELECT * FROM contact_tbl WHERE user_id = :user_id AND subscription_status = '0';");
    $db->bind(':user_id', $user_id);
    
    if ($db->execute()){
        echo $db->rowCount();
    }
    else{
        die("Error :".$db->getError());
    }
    $db->Disconect();
}

function getCategoryByUID($uid){
    $db = new Database();

    $db->query("SELECT * from category_tbl WHERE user_id = :user_id;");
    $db->bind(":user_id", $uid);
    if ($db->execute()){
        if ($db->rowCount() > 0){
            $result = $db->resultset();
            foreach($result as $row){
                echo "<option value='$row->category_id'>$row->category_name</option>";
            }
        }else{
            echo "<option value=''>Empty category</option>";
        }
    }else{
        die("Error :".$db->getError());
    }
    $db->Disconect();
}

function getSubjectRecord(){
    $db = new Database();

    $db->query("SELECT * FROM message_tbl;");
    if ($db->execute()){
        if ($db->rowCount() > 0){
            $result = $db->resultset();
            foreach($result as $row){
                echo "<option value='$row->message_id'>$row->subject</option>";
            }
        }else{
            echo "<option value=''>Empty record fetched</option>";
        }
    }else{
        die("Error: ".$db->getError());
    }
    $db->Disconect();
}
if (isset($_POST['logout'])){
    session_destroy();
    // header('Location: index');
}