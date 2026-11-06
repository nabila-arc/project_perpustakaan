<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['username'])) { header("location: index.php"); exit(); }

$judul = $_POST['judul'];
$kategori = $_POST['kategori'];
$penulis = $_POST['penulis'];
$tahun = $_POST['tahun_terbit'];
$stok = $_POST['stok'];

$nama_file = $_FILES['sampul']['name'];
$ukuran_file = $_FILES['sampul']['size'];
$tmp_file = $_FILES['sampul']['tmp_name'];

$ekstensi_diperbolehkan = array('png','jpg','jpeg');
$x = explode('.', $nama_file);
$ekstensi = strtolower(end($x));

if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
    if($ukuran_file < 2097152){ 
        $nama_file_baru = uniqid().'-'.$nama_file;
        move_uploaded_file($tmp_file, 'uploads/'.$nama_file_baru);
        
        $query = "INSERT INTO buku (judul_buku, kategori, penulis, tahun_terbit, stok, sampul) VALUES ('$judul', '$kategori', '$penulis', '$tahun', '$stok', '$nama_file_baru')";
        mysqli_query($conn, $query);
        
        header("location: dashboard.php");
    }else{
        echo "<script>alert('Ukuran file maksimal 2MB!'); window.history.back();</script>";
    }
}else{
    echo "<script>alert('Ekstensi file hanya boleh JPG/PNG!'); window.history.back();</script>";
}
?>