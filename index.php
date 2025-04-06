<?php
require_once "db.php"; // Connect to DB

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

if ($search != '') {
    $sql = "SELECT * FROM contacts 
            WHERE name LIKE '%$search%' 
            OR email LIKE '%$search%' 
            OR phone LIKE '%$search%' 
            ORDER BY name ASC";
} else {
    $sql = "SELECT * FROM contacts ORDER BY name ASC";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Contact Manager</h2>

<form method="GET" action="index.php" style="margin-bottom: 20px; text-align: center;">
    <input type="text" name="search" placeholder="Search by name, email or phone" 
           value="<?php echo htmlspecialchars($search); ?>" 
           style="padding: 10px; width: 300px; border-radius: 8px; border: 1px solid #ccc;">
    <button type="submit" style="padding: 10px 20px; border-radius: 8px; background-color: #3498db; color: white; border: none;">
        Search
    </button>
</form>

<?php if ($search): ?>
    <div style="text-align: center; margin-top: 10px;">
        <a href="index.php" class="add-new-btn">Clear Search</a>
    </div>
<?php endif; ?>

<a href="add.php" class="add-new-btn">Add New Contact</a>

<table>
    <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td>
                        <a href="update.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Delete this contact?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5" style="text-align:center;">No contacts found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

<?php $conn->close(); ?>
