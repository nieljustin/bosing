<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "lab13";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];

    // Fetch the employee data based on the ID
    $result = $conn->query("SELECT * FROM employees WHERE id = $id");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Display a form to edit the employee details with CSS styling
        echo '<style>
                /* CSS Styles */
              </style>';
        echo '<form method="post" action="update.php">';
        // Form content
        echo '</form>';
    } else {
        echo 'Employee not found.';
    }
}

$conn->close();
?>