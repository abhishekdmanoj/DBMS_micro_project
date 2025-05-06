<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Add New Contact</h2>
<form action="" method="POST">
    <label>Name:</label>
    <input type="text" name="name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Phone:</label>
    <input type="text" name="phone" pattern="[0-9]{10}" title="Enter a valid 10-digit number" required><br>
    <button type="submit" name="submit">Add</button>
</form>

<?php

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    $errors = [];

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Phone validation (10 digits)
    if (!preg_match('/^\d{10}$/', $phone)) {
        $errors[] = "Phone number must be exactly 10 digits.";
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert error'>{$error}</div>";
        }
    } else {
        // Proceed with insert/update query
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = "INSERT INTO contacts (name, email, phone) VALUES ('$name', '$email', '$phone')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Contact added successfully!";
            header("Refresh:2; url=index.php");
        } else {
            echo "Error: " . $conn->error;
    }
}
    }

    
?>

</body>
</html>