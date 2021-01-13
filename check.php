<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);

function is_login(){

    global $con;

    if (isset($_SESSION['user_id'])&& !empty($_SESSION['user_id'])){

        $stmt = $con->prepare("SELECT username FROM users WHERE username=:username");
        $stmt->bindParam(':username', $_SESSION['user_id']);
        $stmt->execute();
        $count = $stmt->rowcount();

        if ($count == 1){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

