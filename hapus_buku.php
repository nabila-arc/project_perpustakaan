<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['username'])) { 
    header("location: index.php"); 
    exit(); 
}

// Cek apakah data dikirim via POST, jika tidak, tendang ke dashboard
if (!isset($_POST['id'])) {
    header("location: dashboard.php");
    exit();
}

$id = $_POST['id'];

// Ambil data file sampul lama untuk dihapus secara fisik
$query_file = "SELECT sampul FROM buku WHERE id='$id'";
$data_file = mysqli_query($conn, $query_file);
$row = mysqli_fetch_assoc($data_file);

if(!empty($row['sampul']) && file_exists('uploads/'.$row['sampul'])){
    unlink('uploads/'.$row['sampul']); 
}

// Proses hapus data dari database
$query = "DELETE FROM buku WHERE id='$id'";
mysqli_query($conn, $query);

header("location: dashboard.php");
?>