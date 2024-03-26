<?php
//Auto logout on idle
$idle_time = 10;  // 60 x 15 => Logout after 15 minutes of idle

// Checks for authorization
if(!$_SESSION['logged_in'] && !$_SESSION['username'])
{
    session_destroy();
    header('location: ../');
}

if ($_SESSION['remember_me'] === true){ // No auto logout 
    $_SESSION['login-time'] = time();
} else {
    if(time() - $_SESSION['login-time'] > $idle_time ){ //Auto logout on idle
        $_SESSION['logged_in'] = false;
        unset($_SESSION['remember_me']);
        unset($_SESSION['username']);
        unset($_SESSION['user_type']);
        unset($_SESSION['user_id']);
        unset($_SESSION['fname']);
        unset($_SESSION['oname']);
        unset($_SESSION['login-time']);
        unset($_SESSION['passport']);
        session_destroy();
        
        header("Location: ../");
    }
    else
    {
        $_SESSION['login-time'] = time(); 
    }
}