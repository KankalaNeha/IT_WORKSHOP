<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];

    $sql = "SELECT * FROM students WHERE student_id='$student_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['student_id'] = $student_id;
        header("Location: hall_ticket.php");
    } else {
        echo "Invalid ID";
    }

    $conn->close();
}
?>

