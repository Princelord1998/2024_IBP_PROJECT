<?php
session_start();
include "dbconnect.php";
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{
    header('location:index.php');
    exit();
}
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
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="document">
    <header class="header"><h1>Dashboard</h1></header>
    <div class="profile-icon">
        <img src="images/profile.png" class="img-fluid rounded-circle" alt="Profile Icon" width="50">
        <p><?php echo isset($_SESSION['name']) ? $_SESSION['name']: '';?></p>
    </div>
    <?php include('admin/session_message.php'); ?>
    <nav>
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
                        <a href="logout.php"><i class="fas fa-user" style="margin-right: 14px"></i>Logout</a>
                        <a href="update_form.php"><i class='fas fa-lock'></i>Change Password</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="dashboard.php"><i class="fa fa-home" style="margin-right: 14px"></i>Home</a></li>
            <li><a href="messages.php"><i class='fas fa-paper-plane' style="margin-right: 14px"></i>send message</a></li>
            <li><a href="message_box.php" style="background-color: red"><i class="fa fa-commenting" style="margin-right: 14px"></i>Inbox</a></li>
            <li><a href="outbox.php"><i class="fa fa-commenting-o" style="margin-right: 14px"></i>Outbox</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="card-header">
            <h4>Incoming Messages
                <a href="dashboard.php" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $user_id = $_SESSION['id'];
            $query = "SELECT * FROM admin_reply where user_id=$user_id";
            if (isset($conn)) {
                $query_run = mysqli_query($conn, $query);
            }
            $admin_reply = 0;
            if(mysqli_num_rows($query_run) > 0)
            {
                $counter = 0;
                foreach($query_run as $user)
                {
                    $admin_reply++;
                    $counter++;
                    ?>
                    <tr>
                        <td><?= $counter; ?></td>
                        <td><?= $user['date'];?></td>
                        <td>
                            <a href="user_message_view.php?id=<?= $user['id']; ?>" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                    <?php
                    $_SESSION['admin_reply_count'] = $admin_reply;
                }
            }
            else
            {
                echo "<h5> No Messages Found </h5>";
            }
            ?>

            </tbody>
        </table>
    </div>
</div>
<script src="functions.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer class="footer">
    <div class="container">
        <p>&copy; 2024 My Dashboard. All rights reserved.</p>
    </div>
</footer>
</html>
