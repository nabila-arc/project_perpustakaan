<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_perpustakaan";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Koneksi Error: " . mysqli_connect_error());
}
?>