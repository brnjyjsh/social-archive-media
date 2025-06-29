<?php
include('includes/database.php');
include('session.php');

if (isset($_FILES['image'])) {
    $file = $_FILES['image']['tmp_name'];
    $imageName = $_FILES["image"]["name"];
    $size = $_FILES["image"]["size"];
    $error = $_FILES["image"]["error"];

    if ($error > 0 || $size > 10000000) {
        http_response_code(400);
        echo "Error: file too big or invalid.";
        exit;
    }

    $location = "upload/" . uniqid() . "_" . basename($imageName);
    move_uploaded_file($_FILES["image"]["tmp_name"], $location);

    $user = $_SESSION['id'];
    mysqli_query($con, "UPDATE user SET profile_picture = '$location' WHERE user_id='$user'");
    mysqli_query($con, "UPDATE comments SET image = '$location' WHERE user_id='$user'");

    echo $location;
}
