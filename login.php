<?php
session_start();
@include('config.php');

if (isset($_POST['login'])) {
    $passwordEntered = sha1($DB_PASSWORD . md5($_POST['password']) . $SITE_KEY);
    $usernameEntered = $_POST['username'];

    $query = "SELECT UserId FROM Users WHERE Username = '$usernameEntered' AND Password = '$passwordEntered'";
    if ($response = @mysqli_query($dbc, $query)) {
        if ($row = mysqli_fetch_array($response)) {
            $_SESSION['user_name'] = $usernameEntered;
            header("location:index.php");
            exit();
        }
        header("location:index.php?login=failed");
        exit();
    }
    header("location:index.php?login=error");
    exit();
}
else if (isset($_POST['register'])) {
    $passwordEntered = sha1($DB_PASSWORD . md5($_POST['password']) . $SITE_KEY);
    $usernameEntered = $_POST['username'];
    $nameEntered = $_POST['name'];

    $query = "INSERT INTO Users (Username, Password, Name) VALUES ('$usernameEntered', '$passwordEntered', '$nameEntered')";

    if (@mysqli_query($dbc, $query)) {
        $_SESSION['user_name'] = $usernameEntered;
        header("location:index.php");
        exit();
    }
    header("location:index.php?login=exists");
    exit();
}
echo "test";