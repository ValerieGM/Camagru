<?php
include "database.php";

try{
 $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sql = "CREATE DATABASE IF NOT EXISTS vgongora";
 $conn->exec($sql);
}
catch (PDOException $e){
	echo "Error Creating Database: ".$e->getMessage();
}
$conn = null;

//Create User Table
try{
 $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sql = "CREATE TABLE IF NOT EXISTS users(
	 `id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	 `username` VARCHAR(100) NOT NULL,
	 `email` VARCHAR(100) NOT NULL,
	 `password` VARCHAR(100) NOT NULL,
	 `verify` INT(2) DEFAULT 0)";
 $conn->exec($sql);
}
catch (PDOException $e){
	echo "Error Creating Tables: ".$e->getMessage();
}
?>