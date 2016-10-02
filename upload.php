<?php
session_start();
@include('config.php');

if (!isset($_SESSION['user_name'])) {
    header("location:index.php");
}
if (isset($_POST['url'])) {
    $query = "INSERT INTO Posts (Url, Username, Tags) VALUES ('" . $_POST['url'] . "', '" . $_SESSION['user_name'] . "', '" . $_POST['tags'] . "')";
    $response = mysqli_query($dbc, $query) or die("There was some problem in connecting to the database, please try again later");

    header("location:index.php");
    exit();
}