<?php
session_start();
include "dbconnect.php";

// Check if the user is already logged in, redirect to dashboard if yes
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
// Process form submission
if(isset($_POST['submit'])) {
    // Get form data
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = hash('sha256', $password);

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if (isset($conn)) {
        if ($conn->query($sql) === TRUE) {
            header("Location:index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header("Location:signup.php");
        }
    }
}

if(isset($_POST['add_user'])) {
    // Get form data
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = hash('sha256', $password);

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if (isset($conn)) {
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "User Added Successfully";
            header("Location:admin/add_users.php");
            exit();
        } else {
            $_SESSION['message'] = "User Not Added";
            echo "Error: " . $sql . "<br>" . $conn->error;
            header("Location:add_users.php");
        }
    }
}

if(isset($_POST['add_book'])) {
    // Get form data
    if(isset($_POST['title']))
        $title = $_POST['title'];
    if(isset($_POST['author']))
        $author = $_POST['author'];

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO books (title,author) VALUES ('$title', '$author')";

    if (isset($conn)) {
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Book Added Successfully";
            header("Location:admin/add_books.php");
            exit();
        } else {
            $_SESSION['message'] = "Book Not Added";
            echo "Error: " . $sql . "<br>" . $conn->error;
            header("Location:add_books.php");
        }
    }
}

if(isset($_POST['submit'])) {
    // Get form data
    $username = $_POST['name'];
    $password = $_POST['password'];
    $hashed_password = hash('sha256', $password);
    // Check if the user exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $_SESSION['name'] = $username;
        $_SESSION['password'] = $password;

        header("Location: dashboard.php");
        header("Location: update_form.php");
        header("Location: update_password.php");
        exit();
            // You may redirect to another page using header("Location: dashboard.php");

    } else {
        // Invalid username or password
        echo "Invalid username or password.";
        header("Location: dashboard.php");
    }
}

if(isset($_POST['delete_user']))
{
   if(true){
       if (isset($conn)) {
           $user_id = mysqli_real_escape_string($conn, $_POST['delete_user']);
       }

       $query = "DELETE FROM users WHERE id='$user_id' ";
       $query_run = mysqli_query($conn, $query);

       if($query_run)
       {
           $_SESSION['message'] = "User Deleted Successfully";
           header("Location: admin/users.php");
           exit(0);
       }
       else
       {
           $_SESSION['message'] = "User Not Deleted";
           header("Location: admin/users.php");
           exit(0);
       }
   }else{
       header("Location: admin/users.php");
       exit(0);
   }
}

if(isset($_POST['delete_user_message']))
{
    if(true){
        if (isset($conn)) {
            $user_id = mysqli_real_escape_string($conn, $_POST['delete_user_message']);
        }

        $query = "DELETE FROM messages WHERE id='$user_id' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $_SESSION['message'] = "User Message Deleted Successfully";
            header("Location: admin/messages.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "User Message Not Deleted";
            header("Location: admin/messages.php");
            exit(0);
        }
    }else{
        header("Location: admin/messages.php");
        exit(0);
    }
}

if(isset($_POST['delete_user_message_sent']))
{
    if(true){
        if (isset($conn)) {
            $user_id = mysqli_real_escape_string($conn, $_POST['delete_user_message_sent']);
        }

        $query = "DELETE FROM messages WHERE id='$user_id' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Message Deleted Successfully";
            header("Location: outbox.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Message Not Deleted";
            header("Location: outbox.php");
            exit(0);
        }
    }else{
        header("Location: outbox.php");
        exit(0);
    }
}

if(isset($_POST['delete_user_message1']))
{
    if(true){
        if (isset($conn)) {
            $user_id = mysqli_real_escape_string($conn, $_POST['delete_user_message1']);
        }

        $query = "DELETE FROM admin_reply WHERE id='$user_id' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Message Deleted Successfully";
            header("Location: admin/outbox.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Message Not Deleted";
            header("Location: admin/outbox.php");
            exit(0);
        }
    }else{
        header("Location: admin/outbox.php");
        exit(0);
    }
}

if(isset($_POST['update_user']))
{
    if (isset($conn)) {
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    }

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = hash('sha256', $password);

    $query = "UPDATE users SET name='$name', email='$email', password='$hashed_password' WHERE id='$user_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "User Updated Successfully";
        header("Location: admin/users.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "User Not Updated";
        header("Location: admin/users.php");
        exit(0);
    }

}

if(isset($_POST['delete_user_message']))
{
    if(true){
        if (isset($conn)) {
            $student_id = mysqli_real_escape_string($conn, $_POST['delete_user_message']);
        }

        $query = "DELETE FROM messages WHERE id='$student_id' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Message Deleted Successfully";
            header("Location: admin/messages.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Message Not Deleted";
            header("Location: admin/messages.php");
            exit(0);
        }
    }
}
// Admin respond to user
if(isset($_POST['reply_user'])) {
    // Get form data
    $user_id = $_POST['user_id'];
    $user_name = $_POST['name'];
    $data = $_POST['data'];

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO admin_reply (user_id, name, data) VALUES ('$user_id', '$user_name', '$data')";

    if (isset($conn)) {
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Message sent Successfully";
            header("Location:admin/dashboard.php");
            exit();
        } else {
            $_SESSION['message'] = "Error:".$conn->error;
            header("Location:admin/dashboard.php");
            exit();
        }
    }
}

if(isset($_POST['announcement'])) {
    // Get form data
    $announcement = $_POST['announce'];
    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO announcements (data) VALUES ('$announcement')";

    if (isset($conn)) {
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Info announced Successfully";
            header("Location:admin/add_announcements.php");
            exit();
        } else {
            $_SESSION['message'] = "Error:".$conn->error;
            header("Location:admin/add_announcements.php");
            exit();
        }
    }
}

if(isset($_POST['delete_announcement']))
{
    if(true){
        if (isset($conn)) {
            $user_id = mysqli_real_escape_string($conn, $_POST['delete_announcement']);
        }

        $query = "DELETE FROM announcements WHERE id='$user_id' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Announcement Deleted Successfully";
            header("Location: admin/view_announcements.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "User Message Not Deleted";
            header("Location: admin/view_announcements.php");
            exit(0);
        }
    }else{
        header("Location: admin/view_announcements.php");
        exit(0);
    }
}

if(isset($_POST['update_announcement']))
{
    if (isset($conn)) {
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    }

    $announcement = $_POST['announces'];
    $query = "UPDATE announcements SET data='$announcement' WHERE id='$user_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Announcement Updated Successfully";
        header("Location: admin/view_announcements.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Announcement Not Updated";
        header("Location: admin/view_announcements.php");
        exit(0);
    }

}

if(isset($_POST['update_book']))
{
    if (isset($conn)) {
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    }
    if(isset($_POST['title']))
        $title = $_POST['title'];
    if(isset($_POST['author']))
        $author = $_POST['author'];
    $query = "UPDATE books SET title='$title', author='$author' WHERE id='$user_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Book Updated Successfully";
        header("Location: admin/view_books.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Book Not Updated";
        header("Location: admin/view_books.php");
        exit(0);
    }

}

if(isset($_POST['delete_book']))
{
    if(true){
        if (isset($conn)) {
            $user_id = mysqli_real_escape_string($conn, $_POST['delete_book']);
        }

        $query = "DELETE FROM books WHERE id='$user_id' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Book Deleted Successfully";
            header("Location: admin/view_books.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Book Not Deleted";
            header("Location: admin/view_books.php");
            exit(0);
        }
    }else{
        header("Location: admin/view_books.php");
        exit(0);
    }
}

// Close connection
$conn->close();
