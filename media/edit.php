<?php
include "../config/setup.php";
include "header.php";

$conn = new PDO($DB_DSNM, $DB_USER, $DB_PASSWORD);

$imgquery = $conn->query("
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

    GROUP BY pictures_id
    ");
while ($row = $imgquery->fetch(PDO::FETCH_ASSOC)) {
    $row['liked_by'] = $row['liked_by'] ? explode('|', $row['liked_by']) : [];
    $pictures[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link rel="stylesheet" href="../css/images/edit.css">
</head>
<body>
<br/>
    <div class="row">
        <div class="container_gallery">
                <strong>Edit Images</strong>
            <hr/>
            <?php foreach ($pictures as $img) : ?>
                <div class="col-sm-3">
                <h3><?php echo $img['users_name']; ?></h3>
                <div class="meanie">
                    <a href="stickers.php?pictures_id=<?php echo $img['pictures_id']; ?>"><img src="uploads/<?php echo $img['pictures'] ?>"></a><br>
                </div>
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
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</body>
</html>