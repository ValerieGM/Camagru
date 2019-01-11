<?php
include "header.php";
include "../config/setup.php";

try {
    $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);

    $omail = $_GET['email'];
    if ($_POST['submit']) {
        if (isset($_POST['new_email'])) {
            $name = $_POST['new_email'];
            $insert = $conn->prepare("UPDATE users SET email = '$name' WHERE email = '$omail'");

            $insert->bindParam(':email', $name);

            $insert->execute();
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<html>
    <link rel="stylesheet" href="../css/profile.css">
    <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
        <div class="profilebox">
            <h1>Enter Your New Email Address<h1>
            <form action="" method="post">
              <input class="button" type="email" name="new_email" placeholder="Enter your email" required/><br/><br/>
              <input class="button" type="submit" name="submit"/>
              <a href="../user/logout.php">Log Out</a><br/>
            </form>
        </div>
    </body>
    </html>