<?php
    // Image Upload Handling
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Restrict file size to 500KB
    if ($_FILES["img"]["size"] > 100000) {
        echo "Sorry, your file is too large. Max size is 100KB.<br>";
        $uploadOk = 0;
    }

    // Allow only JPG, JPEG, and PNG formats
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "Sorry, only JPG, JPEG, and PNG files are allowed.<br>";
        $uploadOk = 0;
    }

    // Upload file if all checks are passed
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    } else {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["img"]["name"])) . " has been uploaded.<br>";
            echo "Stored at: " . $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
?>