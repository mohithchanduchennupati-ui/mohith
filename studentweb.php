<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert student record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $department = $_POST['department'];
    $email = $_POST['email'];

    $sql = "INSERT INTO students (name, roll_no, department, email)
            VALUES ('$name', '$roll_no', '$department', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<h3>Student Registered Successfully!</h3>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Display all students
$result = $conn->query("SELECT * FROM students");
?>

<h2>Registered Students</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Roll No</th>
        <th>Department</th>
        <th>Email</th>
    </tr>

<?php
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['roll_no']."</td>
            <td>".$row['department']."</td>
            <td>".$row['email']."</td>
          </tr>";
}
?>

</table>

<?php
$conn->close();
?>
