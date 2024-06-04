<?php
session_start();

require_once "../dbconnect.php";

function validatePassword($password) {
    // Password must be at least 8 characters long
    if (strlen($password) < 4) {
        return false;
    }
    return true;
}

// Function to sanitize input data
function sanitizeData($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input
        $current_password = sanitizeData($_POST["current_password"]);
        $new_password = sanitizeData($_POST["new_password"]);
        $re_new_password = sanitizeData($_POST["confirm_password"]);

        if (!validatePassword($new_password)) {
            $error_message = "Invalid password! Password must be at least 8 characters long.";
        } elseif ($new_password !== $re_new_password) {
            $error_message = "New passwords do not match!";
        } else{
            // Update the password in the database
            $sql = "UPDATE admin_table SET password = ? WHERE id = ?";

            if (isset($conn)) {
                $stmt = $conn->prepare($sql);
            }
            $hashed_password = hash('sha256', $new_password);
            $stmt->bind_param("ss", $hashed_password, $_SESSION['id']);

            if ($stmt->execute()) {
                $_SESSION['message'] = "password updated successfully";
                header("Location: dashboard.php");
            } else {
                $_SESSION['message'] = "error while updating password";
                header("Location: dashboard.php");
            }

            // Close statement
            $stmt->close();
        }
    }


}
?>
