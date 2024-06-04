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
    <div class="content">
        <div class="card-header">
            <h4>Add Users
                <a href="dashboard.php" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        <form method="POST" action="../action.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="add_user">Sign Up</button>
        </form>
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

