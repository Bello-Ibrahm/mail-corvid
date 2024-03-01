<?php

if (isset($_POST['btn-submit'])){

    $username = $_POST['username']; 
    $pwd = $_POST['pwd'];

    echo $username . " + " . $pwd;
}