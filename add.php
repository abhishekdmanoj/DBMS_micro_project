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
    <input type="text" name="phone" required><br>
    <button type="submit" name="submit">Add</button>
</form>

<?php
if (isset($_POST['submit'])) {
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
?>

</body>
</html>