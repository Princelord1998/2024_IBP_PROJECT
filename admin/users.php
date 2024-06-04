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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style.css">
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
                        <a href="../logout.php"><i class="fas fa-user" style="margin-right: 14px"></i>Logout</a>
                        <a href="update_form.php"><i class='fas fa-lock'></i>Change Password</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="dashboard.php"><i class="fa fa-home" style="margin-right: 14px"></i>Home</a></li>
            <li><a href="messages.php"><i class="fa fa-comment-o" style="margin-right: 14px"></i>Inbox</a></li>
            <li><a href="outbox.php"><i class="fa fa-commenting-o" style="margin-right: 14px"></i>Outbox</a></li>
            <li><a href="users.php" style="background-color: red"><i class="fa fa-group" style="margin-right: 14px"></i>Users</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="card-header">
            <h3>Users Details
                <a href="dashboard.php" class="btn btn-danger float-end">BACK</a>
            </h3>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT * FROM users";
            if (isset($conn)) {
                $query_run = mysqli_query($conn, $query);
            }
            $user_count = 0;

            if(mysqli_num_rows($query_run) > 0)
            {
                $counter = 0;
                foreach($query_run as $user)
                {
                    $user_count++;
                    $counter++;
                    ?>
                    <tr>
                        <td><?= $counter; ?></td>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td>
                            <a href="user_view.php?id=<?= $user['id']; ?>" class="btn btn-info btn-sm">View</a>
                            <a href="user_edit.php?id=<?= $user['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <form action="../action.php" method="POST" class="d-inline">
                                <button onclick="return confirm('Are you sure you wanna delete user?')" style="width: 60px" type="submit" name="delete_user" value="<?=$user['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php

                }
            }
            else
            {
                echo "<h5> No Record Found </h5>";
            }
            ?>

            </tbody>
        </table>
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

