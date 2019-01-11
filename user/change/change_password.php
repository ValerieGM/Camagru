<?php
include "header.php";
include "../config/setup.php";

try {
    $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);
    $user = $_GET['password'];

    if ($_POST['new_user']) {

        if (isset($_POST['new_password'])) {
            $nam = $_POST['new_password'];
            if (ctype_upper($nam) || ctype_lower($nam) || strlen($nam) < 6) {
                header("Location: incorrect.php");
            } else {
                $name = md5($nam);
                $insert = $conn->prepare("UPDATE users SET password = '$name' WHERE password = '$user'");

                $insert->bindParam(':password', $name);

                $insert->execute();
            }
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
            <h1>Enter Your New Password<h1>
            <form action="" method="post">
              <input class="button" type="password" name="new_password" placeholder="Enter your password" required/><br/><br/>
              <input class="button" type="submit" name="new_user"/>
              <a href="../user/logout.php">Log Out</a><br/>
            </form>
        </div>
    </body>
</html>