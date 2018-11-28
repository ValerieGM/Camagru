<?php
include "../config/setup.php";
include "header.php";

try {
    $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);

    $omail = $_GET['email'];
    if (isset($_POST['verify'])) {
            //$name = $_POST['new_email'];
    
            $insert = $conn->prepare("UPDATE users SET verify = 1 WHERE email = '$omail'");
            //header('location:login.php');
            //$insert->bindParam(':verify', 1);

            $insert->execute();
            header('location: login.php');
        }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<html>
    <link rel="stylesheet" href="../css/login.css">
    <body>
        <div class="loginbox">
            <h1>Verification</h1><br>
            <p>Click the verify button<p>
            <form method="POST">
              <input class="button" type="submit" name="verify" value="Verify"/>
            </form>
        </div>
    </body>
</html>