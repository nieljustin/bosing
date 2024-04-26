<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "lab13";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Delete the employee based on the ID
    $sql = "DELETE FROM employees WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Error deleting employee: ' . $conn->error;
    }
}

$conn->close();
?>