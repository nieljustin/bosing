<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Fillup Registration</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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

function addEmployee($conn, $id, $name, $gender, $email, $department, $position) {
    $sql = "INSERT INTO employees (id, name, gender, email, department, position) VALUES ('$id', '$name', '$gender', '$email', '$department', '$position')";
    if ($conn->query($sql) === TRUE) {
        echo "New employee added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['add_employee'])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $position = $_POST["position"];

    addEmployee($conn, $id, $name, $gender, $email, $department, $position);
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <h1>Employee Registration</h1>
    <!-- HTML form for adding a new employee with Bootstrap classes -->
    <div class="form-container">
        <form method="post" action="index.php">
            <div class="form-group">
                <input type="text" class="form-control" name="id" placeholder="Id">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <select class="form-control" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="department" placeholder="Department">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="position" placeholder="Position">
            </div>
            <button type="submit" class="btn btn-primary" name="add_employee">Add Employee</button>
        </form>
    </div>

    <h2>Employee Details</h2>
    <form action="index.php" method="get">
        <div class="form-group">
            <input type="text" class="form-control" name="search" placeholder="Search ID ">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <?php
    $search = isset($_GET['search']) ? $_GET['search'] : "";
    $query = "SELECT * FROM employees WHERE id LIKE '%$search%' OR name LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
    ?>

    <?php
    echo '<div class="table-responsive">';
    echo '<table class="table">';
    echo '<thead class="thead-light">';
    echo '<tr>';
    echo '<th>Id</th>';
    echo '<th>Name</th>';
    echo '<th>Gender</th>';
    echo '<th>Email</th>';
    echo '<th>Department</th>';
    echo '<th>Position</th>';
    echo '<th>Actions</th>'; // Add a new column for actions
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    $result = $conn->query("SELECT * FROM employees");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['gender'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['department'] . '</td>';
            echo '<td>' . $row['position'] . '</td>';
            // Add edit and delete buttons with form for each row
            echo '<td>';
            echo '<form method="post" action="edit.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="btn btn-primary" name="edit">Edit</button>';
            echo '</form>';
            echo '<form method="post" action="delete.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="btn btn-danger" name="delete">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    ?>
</div>

<?php $conn->close(); ?>

</body>
</html>