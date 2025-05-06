<?php
session_start();

$host = "localhost";
$user = "vishal";
$pass = "Vishal@7721";
$dbname = "scadabox";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $mobile = $conn->real_escape_string($_POST["mobile"]);
    $organization = $conn->real_escape_string($_POST["organization"]);

    $sql = "INSERT INTO feedbacks (name, email, mobile, organization) 
            VALUES ('$name', '$email', '$mobile', '$organization')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Form submitted successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
}

$conn->close();
header("Location: index.html");
exit();
