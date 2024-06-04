<?php
session_start();
include "dbconnect.php";

if(isset($_POST['submit'])) {
    // Get form data
    $message = $_POST['message'];
    $user_id = $_SESSION['id'];
    $user_name = $_SESSION['name'];

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO messages (user_id,name,data) VALUES ('$user_id','$user_name','$message')";

    if (isset($conn)) {
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Message sent to admin";
            header("Location:messages.php");
        } else {
            $_SESSION['message'] = "Error:".$conn->error;
            header("Location:messages.php");
        }
    }
}