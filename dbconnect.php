<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "project"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getUserId($input_password)
{
    $sql = "SELECT id FROM users WHERE password = ?";
    if (isset($conn)) {
        $stmt = $conn->prepare($sql);
    }
    if (isset($stmt)) {
        $stmt->bind_param("s", $input_password);
    }

    if (isset($stmt)) {
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_id = $row["id"];
                return $user_id;
            } else {
                return null; // User not found
            }
        } else {
            return null; // Error executing query
        }
    }

    // Close statement and connection
    if (isset($stmt)) {
        $stmt->close();
    }
}