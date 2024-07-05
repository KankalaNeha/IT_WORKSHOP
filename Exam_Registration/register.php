<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_registration";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $photo = $_FILES['photo']['name'];
    $subjects = implode(", ", $_POST['subjects']);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    $sql = "INSERT INTO students (year, semester, student_id, name, gender, mobile, photo, subjects)
            VALUES ('$year', '$semester', '$student_id', '$name', '$gender', '$mobile', '$photo', '$subjects')";

    if ($conn->query($sql) === TRUE) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Registration Successful</title>
        </head>
        <body style="font-family: Arial, sans-serif; background-image: url('uploads/1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; height: 100vh; margin: 0; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <div style="text-align: center; font-weight: bold; background-color: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px;">
                Registration successful!
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <form action="Login.html" method="get">
                    <input type="submit" value="Login" style="background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

