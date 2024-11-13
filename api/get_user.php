<?php
// Include the database connection
require '../config.php';

// Set content type to JSON for the API response
header('Content-Type: application/json');

// SQL query to fetch all users
$sql = "SELECT id, user_name, email, user_level, photo, front_nrc_photo, back_nrc_photo FROM user";
$result = $pdo->query($sql);

$data = [];

if ($result) {
    // Fetch each row as an associative array
    foreach ($result as $key => $user) {
        $data[$key] = $user;
    }
} else {
    $data['message'] = "No records found.";
}

// Convert PHP array to JSON and output it
echo json_encode($data, JSON_PRETTY_PRINT);

?>
