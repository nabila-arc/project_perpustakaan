<?php
session_start();
include 'config/koneksi.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['username'] = $username;

    if (isset($_POST['remember'])) {
        setcookie('username', $username, time() + (86400 * 1), "/"); 
    }
    header("location: dashboard.php");
} else {
    echo "<script>alert('Username atau Password Salah!'); window.location='index.php';</script>";
}
?>