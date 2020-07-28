<?php
include "../config/setup.php";
include "header.php";

try {
    $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);

    $omail = $_GET['email'];
    if (isset($_POST['yes'])) {
        $insert = $conn->prepare("UPDATE users SET notify = 1 WHERE email = '$omail'");
        $insert->execute();
    }
    else if (isset($_POST['no'])) {
        $insert = $conn->prepare("UPDATE users SET notify = 0 WHERE email = '$omail'");
        $insert->execute();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<html>
    <link rel="stylesheet" href="../css/images/login.css">
    <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
        <div class="loginbox">
            <h1>Send Email Notification</h1><br>
            <p>Yes to receive notifications and no to not.<p>
            <form method="POST">
              <input class="button" type="submit" name="yes" value="Send"/>
              <input class="button" type="submit" name="no" value="Don't Send"/>
            </form>
        </div>
    </body>
</html>