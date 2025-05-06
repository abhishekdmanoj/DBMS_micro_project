<?php
require_once "db.php";

$id = $_GET['id'];
$sql = "SELECT * FROM contacts WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    $errors = [];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate phone (exactly 10 digits)
    if (!preg_match('/^\d{10}$/', $phone)) {
        $errors[] = "Phone number must be exactly 10 digits.";
    }

    if (count($errors) === 0) {
        $sql = "UPDATE contacts SET name='$name', email='$email', phone='$phone' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert success'>Contact updated successfully!</div>";
            header("Refresh:2; url=index.php");
            exit;
        } else {
            echo "<div class='alert error'>Error: " . $conn->error . "</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert error'>$error</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Update Contact</h2>
<form action="" method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
    <label>Phone:</label>
    <input type="text" name="phone" pattern="[0-9]{10}" title="Enter a valid 10-digit number" value="<?php echo $row['phone']; ?>" required><br>
    <button type="submit" name="submit">Update</button>
</form>

</body>
</html>