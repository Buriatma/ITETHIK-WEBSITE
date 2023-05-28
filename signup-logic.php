<?php
require '../config/database.php';


if (isset($_POST['submit'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$username) {
        $_SESSION['signup'] = "Please enter your User Name";
    } else if (!$email) {
        $_SESSION['signup'] = "Please enter a valid Email";
    } else if (strlen($password) < 8) {
        $_SESSION['signup'] = "Password must be more than 8 Characters";
    } else {
        $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $user_check_result = mysqli_query($connection, $user_check_query);

        if (mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['signup'] = "Username or Email already exist";
        }
    }

    if (isset($_SESSION['signup'])) {
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        $insert_user_query = "INSERT INTO users SET username='$username' , email='$email' , password='$hashed_password'";

        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['signup-success'] = "Registration successfull , Please proceed to login";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}