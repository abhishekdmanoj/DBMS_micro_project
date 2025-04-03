<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM contacts WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Contact deleted successfully!";
} else {
    echo "Error deleting record: " . $conn->error;
}

header("Location: index.php");
?>