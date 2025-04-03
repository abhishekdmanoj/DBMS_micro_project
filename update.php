<?php include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM contacts WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE contacts SET name='$name', email='$email', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Contact updated successfully!";
        header("Refresh:2; url=index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Contact</title>
</head>
<body>

<h2>Update Contact</h2>
<form action="" method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
    <label>Phone:</label>
    <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br>
    <button type="submit" name="submit">Update</button>
</form>

</body>
</html>