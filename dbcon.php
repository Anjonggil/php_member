<?php

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'userdb';

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try{
        $con = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username,$password);
    }catch (PDOException $e){
        die("Failed to connection to the database: " . $e->getMessage());
    }

    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

    if (function_exists('get_magic_quotes_gpc')&& get_magic_quotes_gpc()){ //get_magic_quotes_gpc함수가 존재하는 지에 대한 if
        function undo_magic_quotes_gpc(&$array){
            foreach ($array as &$value){
                if (is_array($value)){
                    undo_magic_quotes_gpc($value);
                }else{
                    $value = stripslashes($value);
                }
            }
        }

        undo_magic_quotes_gpc($_POST);
        undo_magic_quotes_gpc($_GET);
        undo_magic_quotes_gpc($_COOKIE);
}

    header('Content-Type: text/html; charset=utf-8');
    session_start();
?>