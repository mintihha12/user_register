<?php
require 'config.php';

// Define the upload directory
$uploadDir = 'uploads/';

// Allowed file types and maximum file size (2MB)
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

$id = $_POST['user_id'];

// Check if both files are uploaded
if (isset($_FILES['photo']) && isset($_FILES['front_nrc_photo']) && isset($_FILES['back_nrc_photo'])) {
    $photo = $_FILES['photo'];
    $front_nrc_photo = $_FILES['front_nrc_photo'];
    $back_nrc_photo = $_FILES['back_nrc_photo'];

    // Validate file
    function validateFile($file, $allowedTypes, $maxFileSize) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return "Error uploading file.";
        }
        if (!in_array($file['type'], $allowedTypes)) {
            return "Invalid file type. Only JPG, PNG, and GIF are allowed.";
        }
        if ($file['size'] > $maxFileSize) {
            return "File size exceeds the 2MB limit.";
        }
        return true;
    }

    // Validate both photos
    $photoValidation = validateFile($photo, $allowedTypes, $maxFileSize);
    $front_nrc_photo_Validation = validateFile($front_nrc_photo, $allowedTypes, $maxFileSize);
    $back_nrc_photo_Validation = validateFile($back_nrc_photo, $allowedTypes, $maxFileSize);

    if ($photoValidation === true && $front_nrc_photo_Validation === true && $back_nrc_photo_Validation == true) {
        // Set target paths
        $photoPath = $uploadDir . uniqid('photo_') . '_' . basename($photo['name']);
        $front_nrcPhotoPath = $uploadDir . uniqid('nrc_front_') . '_' . basename($front_nrc_photo['name']);
        $back_nrcPhotoPath = $uploadDir . uniqid('nrc_back_') . '_' . basename($back_nrc_photo['name']);

        // Move files to the target directory
        if (move_uploaded_file($photo['tmp_name'], $photoPath) && move_uploaded_file($front_nrc_photo['tmp_name'], $front_nrcPhotoPath) && move_uploaded_file($back_nrc_photo['tmp_name'], $back_nrcPhotoPath)) {
            // Insert file paths into the database
            $sql = "UPDATE user SET photo = ?, front_nrc_photo = ?, back_nrc_photo = ? , user_level = 2 WHERE id = ?";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$photoPath, $front_nrcPhotoPath, $front_nrcPhotoPath, $id]);

            

            if ($stmt->execute()) {
                echo "Files uploaded and saved to the database successfully!<br>";
                
                header("Location: index.php"); // Redirect to homepage
                exit;

            } else {
                echo "Database error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Failed to move uploaded files.";
        }
    } else {
        // Display validation errors
        echo "Photo Validation: $photoValidation<br>";
        echo "Front NRC Photo Validation: $front_nrc_photo_Validation<br>";
        echo "Back NRC Photo Validation: $back_nrc_photo_Validation<br>";

    }
} else {
    echo "Both photos are required.";
}
$conn->close();
?>
