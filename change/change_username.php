<?php
include "header.php";
include "../config/setup.php";

try{
    $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);
    $user = $_GET['username'];

    if ($_POST['new_user'])
        {
            
            if (isset($_POST['new_username']))
            {
                $name = $_POST['new_username'];
                $insert = $conn->prepare("UPDATE users SET username = '$name' WHERE username = '$user'");

    		    $insert->bindParam(':username', $name);

                $insert->execute();
            }
        }
}
catch(PDOException $e){
	echo "Error: ".$e->getMessage();
}

?>

<html>
    <link rel="stylesheet" href="../css/profile.css">
    <body>
        <div class="profilebox">
            <h1>Enter Your New Username<h1>
            <form action="" method="post">
              <input class="button" type="username" name="new_username" placeholder="Enter your username" required/><br/><br/>
              <input class="button" type="submit" name="new_user"/>
              <a href="logout.php">Log Out</a><br/>
            </form>
        </div>
    </body>
</html>