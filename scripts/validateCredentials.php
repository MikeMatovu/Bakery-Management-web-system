<?php
if (isset($_GET['action']) && $_GET['action'] == 'is_user')
    isUser();

function isUser()
{
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';
    if ($conn) {
        $email = $_GET["email"];
        $password = $_GET["password"];
        $query = "SELECT user_id, password, is_admin FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            $user_id = $row['user_id'];
            $is_admin = $row['is_admin'];

            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['is_admin'] = $is_admin;

                echo "true";
            } else {
                // Passwords do not match
                echo "False";
            }
        } else {
            echo "Email not found.";
        }
    } else {
        // Database connection error
        echo "Database error";
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'store_user_info')
    storeAdminData();

function storeAdminData()
{

    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db_connection.php';

    if ($conn) {


        $email = $_GET["email"];
        $username = $_GET["username"];
        $password = $_GET["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $is_admin = $_GET["isAdmin"];
        $query = "INSERT INTO users (username, password, email, is_admin) VALUES('$username', '$hashedPassword', '$email', '$is_admin')
        ";
        echo $query;
        $result = mysqli_query($conn, $query);
        echo ($result) ? "true" : "false";
    }
}
