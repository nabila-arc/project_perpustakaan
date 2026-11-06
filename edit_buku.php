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
$query = "SELECT * FROM buku WHERE id='$id'";
$data = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg,  #4287ee 0%, #93ecfc 40%, #fcc1db 75%, #a86d39  100%);
            background-attachment: fixed; 
            background-size: cover;
            min-height: 100vh; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .glass-card { 
            background: rgba(255, 255, 255, 0.95); 
            border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.2); 
            padding: 25px;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 glass-card">
            <h3 class="mb-4" style="color: #0A192F; font-weight: bold;">Edit Data Buku</h3>
            <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="sampul_lama" value="<?php echo $row['sampul']; ?>">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" value="<?php echo isset($row['judul_buku']) ? $row['judul_buku'] : (isset($row['judul']) ? $row['judul'] : ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Kategori</label>
                    <input type="text" name="kategori" class="form-control" value="<?php echo isset($row['kategori']) ? $row['kategori'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="<?php echo isset($row['penulis']) ? $row['penulis'] : ''; ?>" required>
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <label class="form-label fw-bold">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control" value="<?php echo isset($row['tahun_terbit']) ? $row['tahun_terbit'] : ''; ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-bold">Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?php echo isset($row['stok']) ? $row['stok'] : ''; ?>" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Ganti Sampul (Opsional)</label><br>
                    <?php if(!empty($row['sampul']) && file_exists('uploads/'.$row['sampul'])): ?>
                        <img src="uploads/<?php echo $row['sampul']; ?>" width="80" class="mb-2 rounded shadow-sm">
                    <?php endif; ?>
                    <input type="file" name="sampul" class="form-control" accept=".jpg,.png,.jpeg">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="dashboard.php" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4" style="background-color: #4E89AE; border:none;">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>