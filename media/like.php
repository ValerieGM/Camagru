<?php
include '../config/setup.php';
session_start();

$conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);

$name = $_SESSION['username'];
if (!empty($name)) {
    if (isset($_GET['type'], $_GET['pictures_id'])) {

        $type = $_GET['type'];
        $id = $_GET['pictures_id'];

        switch ($type) {
            case 'picture':
                $conn->query("INSERT INTO like_pic (pictures_id, users_name) 
                        SELECT '" . $id . "', '" . $name . "' 
                        FROM pictures 
                        WHERE EXISTS (
                            SELECT pictures_id
                            FROM pictures
                            WHERE pictures_id = '" . $id . "')
                        AND NOT EXISTS ( 
                            SELECT like_id
                            FROM like_pic
                            WHERE users_name = '" . $name . "'
                            AND pictures_id = '" . $id . "')
                            LIMIT 1;
                        ");
                break;
            case 'delete':
                $conn->query("DELETE FROM pictures 
                            WHERE users_name = '" . $name . "'
                            AND pictures_id = '" . $id . "'");
                break;
        }
    }
}
header('location: gallery.php')
?>