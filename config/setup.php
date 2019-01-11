<?php
include "database.php";

try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE DATABASE IF NOT EXISTS vgongora";
	$conn->exec($sql);
} catch (PDOException $e) {
	echo "Error Creating Database: " . $e->getMessage();
}
$conn = null;

//Create User Table
try {
	$conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE TABLE IF NOT EXISTS users(
		`id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`username` VARCHAR(100) NOT NULL,
		`email` VARCHAR(100) NOT NULL,
		`password` VARCHAR(100) NOT NULL,
		`verify` INT(2) DEFAULT 0,
		`notify` INT(2) DEFAULT 1)";
	$conn->exec($sql);
} catch (PDOException $e) {
	echo "Error Creating User Table: " . $e->getMessage();
}

//Create Images Table
try {
	$conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE TABLE IF NOT EXISTS pictures(
		`pictures_id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		`pictures` VARCHAR(255),
		`users_name` VARCHAR(50),
		`reg_date` TIMESTAMP)";
	$conn->exec($sql);

} catch (PDOException $e) {
	echo "Error Creating User Table: " . $e->getMessage();
}

//Create Likes Table
try {
	$conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE TABLE IF NOT EXISTS like_pic(
		`like_id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		`pictures_id` INT(6) UNSIGNED,
		`users_name` VARCHAR(50),
		`reg_date` TIMESTAMP)";
	$conn->exec($sql);
} catch (PDOException $e) {
	echo "Error Creating User Table: " . $e->getMessage();
}

//Create Comments Table
try {
	$conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE TABLE IF NOT EXISTS comments(
		`comments_id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		`pictures_id` INT(6) UNSIGNED,
		`users_name` VARCHAR(50),
		`comment` VARCHAR (225),
		`reg_date` TIMESTAMP)";
	$conn->exec($sql);
} catch (PDOException $e) {
	echo "Error Creating User Table: " . $e->getMessage();
}

if (!file_exists('../media/uploads')){
	mkdir('../media/uploads', 0777, true);
}