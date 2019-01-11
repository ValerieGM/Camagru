<?php
include "../config/setup.php";
include "header.php";

session_start();

$conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);
$query = ("
    SELECT 
    pictures.pictures_id, 
    pictures.users_name, 
    pictures.pictures,
    COUNT(like_pic.like_id) AS likes,
    GROUP_CONCAT(users.username SEPARATOR '|') AS liked_by

    FROM pictures

    LEFT JOIN like_pic
    ON pictures.pictures_id = like_pic.pictures_id

    LEFT JOIN users
    ON like_pic.users_name = users.username

    GROUP BY pictures_id");
$imgquery = $conn->query($query);

while ($row = $imgquery->fetch(PDO::FETCH_ASSOC)) {
    $row['liked_by'] = $row['liked_by'] ? explode('|', $row['liked_by']) : [];
    $pictures[] = $row;
}

$name = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$name'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['type'])) {
    if (isset($_POST['comment_btn'])) {
        $comment = $_POST['comment'];

        $pictures_id = $_GET['pictures_id'];

        $type = $_GET['type'];
        switch ($type) {
            case 'comment':

                if ($result['notify'] == 1) {
                    $email = $result['email'];
                    $message =
                        "
                                    Someone has commented on your picture.
                                    Click the link below to to view the comment
                                    http://localhost:8080/camagru/confirm_email.php?username=$name
                                ";

                    mail($email, "Notification Email", $message, "From: noreply@camagru.com");
                }
                $insert = $conn->prepare("INSERT INTO comments (pictures_id,users_name, comment) VALUES (:pictures_id, :users_name, :comment)");

                $insert->bindParam(':pictures_id', $pictures_id);
                $insert->bindParam(':users_name', $name);
                $insert->bindParam(':comment', $comment);

                $insert->execute();

                break;
        }
    }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/gallery.css">
    <title>Gallery</title>
</head>
<body>
    <br/>
    <div class="row">
        <div class="container_gallery">
                <strong>Gallery</strong>
            <hr/>
                <a href="edit.php?users_id=<?php echo $data['users_id'];?>">Edit Images</a>
             <hr/> 
                <?php foreach ($pictures as $img) : ?>
                    <div class="col-sm-3">
                        <h3><?php echo $img['users_name']; ?></h3>
                        <img src="uploads/<?php echo $img['pictures'] ?>" width="80%" height="300px"><br>
                        <a href="like.php?type=picture&pictures_id=<?php echo $img['pictures_id']; ?>">Like</a>
                        <a href="like.php?type=delete&pictures_id=<?php echo $img['pictures_id']; ?>">Delete</a>
                        <?php if ($img['likes'] == 1) : ?>
                            <p><?php echo $img['likes'] ?> like.</p>
                        <?php endif; ?>
                        <?php if ($img['likes'] > 1) : ?>
                            <p><?php echo $img['likes'] ?> likes.</p>
                        <?php endif; ?>
                        <?php if (!empty($img['liked_by'])) : ?>
                            <ul>
                                <?php foreach ($img['liked_by'] as $user) : ?>
                                    <li><?php echo $user; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                            <form action="" method="post">
                                <a name="comment_btn" type="submit" href="gallery.php?type=comment&pictures_id=<?php echo $img['pictures_id']; ?>">comment</a>
                                <textarea class="comment" type="text" name="comment" placeholder="comment" required></textarea>
                                <br/>
                                <input name="comment_btn" type="submit" value="Post"/>
                            </form>
                            <?php 
                            $id = $img['pictures_id'];
                            $comquery = $conn->prepare("SELECT * FROM `comments` WHERE `pictures_id` = '$id'");
                            $comquery->execute();
                            while ($com = $comquery->fetch(PDO::FETCH_ASSOC)) {

                                ?>
                                        <ul>
                                            <li><?php echo $com['users_name'] ?></p>
                                            <p><?php echo $com['comment'] ?></p>
                                        </ul>
                                    <?php

                                }
                                ?>
                           
                    </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="footer">
        <?php
        include 'footer.php';
        ?>
    </div>
</body>
</html>
