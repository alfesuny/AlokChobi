<?php

$link = mysqli_connect("localhost", "root", "", "learnypy");

// Check connection
if (!$link) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "SELECT * FROM student_course ";

$result = mysqli_query($link, $query);

// Create an empty array to store the rows
$dataArray = array();

// Check if there are any rows in the result set
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Append the current row to the array
        $dataArray[] = $row;
    }
} else {
    echo "No rows found.";
}

foreach ($dataArray as $row) {
    echo "Student Name: " . $row['student_email'] . "<br>";
    echo "Course Name: " . $row['course_name'] . "<br>";
}


?>