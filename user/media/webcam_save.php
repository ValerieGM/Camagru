<?php

    include 'header.php';
    include "../config/setup.php";

    session_start();
    $conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);

    $name = $_SESSION['username'];
    $select = $conn->prepare("SELECT * FROM pictures WHERE users_name='$name'");
    $select->setFetchMode(PDO::FETCH_ASSOC);
    $select->execute();

    $result = $select->fetch();
    echo $name;
    if (isset($_POST['key']))
    {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        $i = 0;
        while ($i < 10)
        {
            $rand = mt_rand(0, $max);
            $str = $str.$characters[$rand];
            $i++;
        }
        $str = $str.".png";


        $path = "uploads/".$str;

        file_put_contents($path, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$_POST['key'])));

        $select = $conn->prepare("INSERT INTO pictures (pictures, users_name) VALUES (:pictures, :users_name)");

		$select->bindParam(':pictures', $str);
		$select->bindParam(':users_name', $name);

		$select->execute();
        
    }
?>