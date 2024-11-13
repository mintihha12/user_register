<?php
require 'config.php';

// Fetch contacts
$stmt = $pdo->query("SELECT * FROM user");
$contacts = $stmt->fetchAll();
?>



<h1>User List</h1>
<a href="register.html">Add New User</a>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>User Level</th>
        <!-- <th>Actions</th> -->
    </tr>
    <?php foreach ($contacts as $contact): ?>
    <tr>
        <td><?php echo htmlspecialchars($contact['user_name']); ?></td>
        <td><?php echo htmlspecialchars($contact['email']); ?></td>
        <td><?php echo htmlspecialchars($contact['user_level']); ?>
            <?php if ($contact['user_level'] == 1) { ?>
                <i>if you want to level up to 2, please <a href="./level_up.php?id=<?php echo $contact['id']; ?>" target="_blank" rel="noopener noreferrer">submit</a> photo and two nrc photo( front and back ).</i>
            <?php 
                }
            ?>
        </td>
        <!-- <td>
            <a href="edit.php?id=<?php echo $contact['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $contact['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
        </td> -->
    </tr>
    <?php endforeach; ?>
</table>


