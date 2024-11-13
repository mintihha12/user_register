<?php
// Retrieve the id from the URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Photos</title>
</head>
<body>
   
    <form action="level_up_action.php" method="POST" enctype="multipart/form-data">
        <label for="photo">Upload Profile Photo:</label>
        <input type="file" name="photo" id="photo" required>

        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($id); ?>">
        
        <br><br>
        <label for="front_nrc_photo">Upload Front NRC Photo:</label>
        <input type="file" name="front_nrc_photo" id="front_nrc_photo" required>
        <br><br>
        <label for="back_nrc_photo">Upload Back NRC Photo:</label>
        <input type="file" name="back_nrc_photo" id="back_nrc_photo" required>
        <br><br>
        <button type="submit">Upload Photos</button>
    </form>
</body>
</html>
