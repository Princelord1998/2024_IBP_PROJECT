<?php
session_start();
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
{
    header('location:../index.php');
    exit();
}
include "../dbconnect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: auto;
            gap: 20px;

        }
        .container1 {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .label {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none; /* Remove underline from link */
            display: inline-block; /* Ensure it behaves like a block element */
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
    <title>Document</title>
</head>
<body>
<div class="document">
    <header class="header"><h1>Admin Dashboard</h1></header>
    <div class="profile-icon">
        <img src="../images/profile.png" class="img-fluid rounded-circle" alt="Profile Icon" width="50">
        <p><?php echo isset($_SESSION['name']) ? $_SESSION['name']: '';?></p>
    </div>
    <?php include('session_message.php'); ?>
    <nav style="margin-top: 90px">
        <ul>
            <li>
                <div class="dropdown target">
                    <button onclick="toggleSidebar()"><i class='fas fa-tasks'></i></i></button>
                </div>
            </li>
            <li>
                <div class="dropdown">
                    <button class="dropbtn"><i class='fas fa-address-card'></i></button>
                    <div class="dropdown-content">
                        <a href="../logout.php"><i class="fas fa-user" style="margin-right: 14px"></i>Logout</a>
                        <a href="update_form.php"><i class='fas fa-lock'></i>Change Password</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="dashboard.php" style="background-color: red"><i class="fa fa-home" style="margin-right: 14px"></i>Home</a></li>
            <li><a href="messages.php"><i class="fa fa-comment-o" style="margin-right: 14px"></i>Inbox</a></li>
            <li><a href="outbox.php"><i class="fa fa-commenting-o" style="margin-right: 14px"></i>Outbox</a></li>
            <li><a href="users.php"><i class="fa fa-group" style="margin-right: 14px"></i>Users</a></li>
        </ul>
    </div>
    <div class="content content1">
        <div class="grid-container">
            <div class="container1">
                <?php
                $query = "SELECT * FROM messages";
                if (isset($conn)) {
                    $query_run = mysqli_query($conn, $query);
                }
                $inbox_count = 0;

                if(mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $user) {
                        $inbox_count++;
                    }
                }
                ?>
                <div class="label"><p>Inbox(<?php echo isset($inbox_count)? $inbox_count : '0' ?>)</p></div>
                <a href="messages.php" class="button">view</a>
            </div>
            <div class="container1">
                <?php
                $query = "SELECT * FROM admin_reply";
                if (isset($conn)) {
                    $query_run = mysqli_query($conn, $query);
                }
                $outbox_count = 0;

                if(mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $user) {
                        $outbox_count++;
                    }
                }
                ?>
                <div class="label"><p>Outbox(<?php echo isset($outbox_count)? $outbox_count : '0' ?>)</p></div>
                <a href="outbox.php" class="button">view</a>
            </div>
            <div class="container1">
                <?php
                $query = "SELECT * FROM announcements";
                if (isset($conn)) {
                    $query_run = mysqli_query($conn, $query);
                }
                $announcement_count = 0;

                if(mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $user) {
                        $announcement_count++;
                    }
                }
                ?>
                <div class="label"><p>Announcements(<?php echo isset($announcement_count)? $announcement_count : '0' ?>)</div>
                <a href="view_announcements.php" class="button">view</a>
                <a href="add_announcements.php" class="button">Add</a>
            </div>
            <div class="container1">
                <?php
                $query = "SELECT * FROM users";
                if (isset($conn)) {
                    $query_run = mysqli_query($conn, $query);
                }
                $user_count = 0;

                if(mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $user) {
                        $user_count++;
                    }
                }
                ?>
                <div class="label"><p>Users(<?php echo isset($user_count)? $user_count : '0' ?>)</div>
                <a href="users.php" class="button">view</a>
                <a href="add_users.php" class="button">Add</a>
            </div>
            <div class="container1">
                <?php
                $query = "SELECT * FROM books";
                if (isset($conn)) {
                    $query_run = mysqli_query($conn, $query);
                }
                $book_count = 0;

                if(mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $user) {
                        $book_count++;
                    }
                }
                ?>
                <div class="label">Books(<?php echo isset($book_count)? $book_count : '0' ?>)</div>
                <a href="view_books.php" class="button">view</a>
                <a href="add_books.php" class="button">Add</a>
            </div>
            <!-- Add more containers as needed -->
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../functions.js"></script>
</body>
<footer class="footer">
    <div class="container">
        <p>&copy; 2024 My Dashboard. All rights reserved.</p>
    </div>
</footer>
</html>

