<?php
session_start();
include 'config/koneksi.php';
if (!isset($_SESSION['username'])) { header("location: index.php"); exit(); }

$id = $_POST['id'];
$judul = $_POST['judul'];
$kategori = $_POST['kategori'];
$penulis = $_POST['penulis'];
$tahun = $_POST['tahun_terbit'];
$stok = $_POST['stok'];
$sampul_lama = $_POST['sampul_lama'];

if($_FILES['sampul']['name'] != "") {
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
            
            if(!empty($sampul_lama) && file_exists('uploads/'.$sampul_lama)){
                unlink('uploads/'.$sampul_lama);
            }
            
            $query = "UPDATE buku SET judul_buku='$judul', kategori='$kategori', penulis='$penulis', tahun_terbit='$tahun', stok='$stok', sampul='$nama_file_baru' WHERE id='$id'";
        }else{
            echo "<script>alert('Ukuran file maksimal 2MB!'); window.history.back();</script>";
            exit();
        }
    }else{
        echo "<script>alert('Ekstensi file hanya boleh JPG/PNG!'); window.history.back();</script>";
        exit();
    }
} else {
    $query = "UPDATE buku SET judul_buku='$judul', kategori='$kategori', penulis='$penulis', tahun_terbit='$tahun', stok='$stok' WHERE id='$id'";
}

mysqli_query($conn, $query);
header("location: dashboard.php");
?>