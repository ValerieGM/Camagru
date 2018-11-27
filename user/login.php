<?php
include "../config/setup.php";
include "header.php";
include "login.html";

if (isset($_POST['SignIn'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    try{
        $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);
        $select = $conn->prepare("SELECT * FROM users WHERE username='$username' and password='$password'");

        $select->setFetchMode(PDO::FETCH_ASSOC);
        $select->execute();

        $data = $select->fetch();
        if ($data['username']!=$username && $data['password']!=$password)
            echo "Invalid Username or Password";
        else if ($data['username']==$username && $data['password']==$password)
        {
            session_start();
            $_SESSION['username']=$data['username'];
            $_SESSION['email']=$data['email'];
            header("location:profile.php?username=$username");
        }
    }
    catch(PDOException $e){
        echo "Error: ".$e->getMessage();
    }
}
?>