<?php
include "../dbconnect.php";

function admin_replies(){
    $query = "SELECT * FROM messages";
    if (isset($conn)) {
        $query_run = mysqli_query($conn, $query);
    }
    $message_count = 0;
    if (isset($query_run)) {
        if(mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $user) {
                $message_count++;
            }
            $_SESSION['user_message_count'] = $message_count;
        }
    }
        return $message_count;
}
