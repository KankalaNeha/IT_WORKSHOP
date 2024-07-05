<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hall Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('uploads/1.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .ticket-container {
            background-color: #e3f2fd;
            padding: 20px;
            margin: 50px auto;
            width: 94%;
            max-width: 800px;
            border: 2px solid #000;
            text-align: left;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            color: #1e88e5;
            font-size: 2em;
        }

        .details {
            margin-top: 20px;
            font-size: 1em;
        }

        .details table {
            width: 50%;
        }

        .details th, .details td {
            text-align: left;
            padding: 5px;
        }

        .details th {
            white-space: nowrap;
            width: 10%; 
            padding-right: 10px; 
        }

        .details td {
              white-space: nowrap;
            width: 50%;
            padding-right: 10px; 
        }

        .photo {
            float: right;
            margin-right: 60px; 
        }

        .photo img {
            width: 150px;
            height: 160px; 
            border: 2px solid black;
            padding: 0px;
            background-color: #fff;
        }

        .signature-student {
            float: left;
        }

        .signature-controller {
            float: right;
        }

        .print-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            border-radius: 5px;
            font-size: 1.2em; 
        }

        .print-button:hover {
            background-color: #45a049;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="ticket-container">
    <h1>Hall Ticket</h1>
    <div class="details">
    <?php
        session_start();

        if (!isset($_SESSION['student_id'])) {
            header("Location: login.html");
            exit();
        }

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "exam_registration";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $student_id = $_SESSION['student_id'];

        $sql = "SELECT * FROM students WHERE student_id='$student_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='photo'>";
            echo "<img src='uploads/" . $row['photo'] . "' alt='Photo'>";
            echo "</div>";
            echo "<div class='details'>";
            echo "<table border=0 >";
            echo "<tr><th>Student ID</th><td>:</td><td>" . $row['student_id'] . "</td></tr>";
            echo "<tr><th>Name of the student</th><td>:</td><td>" . $row['name'] . "</td></tr>";
            echo "<tr><th>Year</th><td>:</td><td>" . $row['year'] . "</td></tr>";
            echo "<tr><th>Semester</th><td>:</td><td>" . $row['semester'] . "</td></tr>";
            echo "<tr><th>Mobile No</th><td>:</td><td>" . $row['mobile'] . "</td></tr>";
            echo "</table>";
            echo "</div>";
            echo "<table border='1' cellspacing='0' cellpadding='5' style='margin-top: 30px; width=100%'>";
            echo "<tr><th>Sl. No</th><th>Date & Time</th><th>Paper Code / Subject</th><th>Mode of Exam</th></tr>";
            echo "<tr><td>1</td><td>29-07-2024 (2:00 PM - 5:00 PM)</td><td>CS2202 - Web Technologies</td><td>Regular</td></tr>";
            echo "<tr><td>2</td><td>02-08-2024 (2:00 PM - 5:00 PM)</td><td>CS2203 - Operating System</td><td>Regular</td></tr>";
            echo "<tr><td>3</td><td>04-08-2024 (2:00 PM - 5:00 PM)</td><td>CS2201 - DAA</td><td>Regular</td></tr>";
            echo "<tr><td>4</td><td>06-08-2024 (2:00 PM - 5:00 PM)</td><td>MA2201 - Probability & statistics</td><td>Regular</td></tr>";
            echo "</table>";
            echo "<br>";
            echo "<br>";
            echo "<div class='signature-student'>";
            echo "<h4>Signature of student</h4>";
            echo "</div>";
            echo "<div class='signature-controller'>";
            echo "<h4>Controller of Examinations    </h4>";
            echo "</div>";
            echo "<div style='clear:both'></div>"; 
            echo "<button class='print-button' onclick='window.print()'>Print</button>";
        } else {
            echo "No data found.";
        }

        $conn->close();
        ?>
    </div>
</div>
</body>
</html>

