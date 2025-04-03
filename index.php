<?php


require_once "db.php";  // This will attempt to include the db.php file

// Rest of your code continues here...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Contact Manager</h2>
<a href="add.php">Add New Contact</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>

    <?php
    // Ensure that the connection is open before querying
    if ($conn) {
        $sql = "SELECT * FROM contacts";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['phone']."</td>
                        <td>
                            <a href='update.php?id=".htmlspecialchars($row['id'])."'>Edit</a> |
                            <a href='delete.php?id=".htmlspecialchars($row['id'])."' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No contacts found</td></tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Failed to connect to the database.</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
// Close the connection after everything else
mysqli_close($conn); // Close the connection after using it
?>
