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

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $name = $_POST['gender']; // This seems like an error, should be $gender instead of $name
    $email = $_POST['email'];
    $department = $_POST['department'];
    $position = $_POST['position'];

    // Update the employee details in the database
    $sql = "UPDATE employees SET id='$id', name='$name', gender='$gender', email='$email', department='$department', position='$position' WHERE id=$id";
   
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Error updating employee details: ' . $conn->error;
    }
}

$conn->close();
?>