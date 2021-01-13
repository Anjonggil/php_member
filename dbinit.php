<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include('check.php');


$databaseName = 'userdb';
$databaseUser = 'root';
$databasePassword = '';


/*
 * 데이터베이스 생성
 */
$pdoDatabase = new PDO('mysql:host=localhost', $databaseUser, $databasePassword);
$pdoDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdoDatabase->exec('DROP DATABASE IF EXISTS userdb;');
$pdoDatabase->exec('CREATE DATABASE IF NOT EXISTS userdb DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');


/*
 * 테이블 생성
 */
$pdo = new PDO('mysql:host=localhost;dbname='.$databaseName, $databaseUser, $databasePassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec('DROP TABLE IF EXISTS users;');

$pdo->exec('CREATE TABLE `users` (
 `userid` int(11) NOT NULL AUTO_INCREMENT,
 `username` VARCHAR(255) NOT NULL,
 `password` VARCHAR(255) NOT NULL,
 `userprofile` VARCHAR(255),
 `regtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `is_admin` tinyint(4) NOT NULL DEFAULT 0,
 `activate` tinyint(4) NOT NULL DEFAULT 0,
 PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');


/*
 * 관리자 계정 admin 생성
 */


$createAdmin = $pdo->prepare('INSERT INTO users 
	(username, password, is_admin, activate) VALUES
    ("admin", "admin", 1, 1)');


$createAdmin->execute();


echo "데이터베이스 초기화에 성공했습니다.\n";