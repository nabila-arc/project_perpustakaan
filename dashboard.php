<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #4287ee 0%, #93ecfc 40%, #fcc1db 75%, #a86d39 100%);
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
        .table-responsive::-webkit-scrollbar { height: 8px; }
        .table-responsive::-webkit-scrollbar-thumb { background-color: #4E89AE; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="glass-card">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                <h2 style="color: #0A192F; font-weight: bold; margin: 0;">Data Buku Perpustakaan</h2>
                <div class="d-flex align-items-center gap-2">
                    <a href="tambah_buku.php" class="btn btn-success btn-sm">Tambah Buku</a>
                    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle table-nowrap" style="min-width: 800px;">
                    <thead class="table-dark">
                        <tr>
                            <th>Sampul</th>
                            <th>Judul Buku</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM buku ORDER BY id DESC";
                        $data = mysqli_query($conn,$query);
                        
                        if (mysqli_num_rows($data) > 0) {
                            while ($row = mysqli_fetch_assoc($data)) {
                                $status = ($row['stok'] > 0) ? "<span class='badge bg-success'>Tersedia</span>" : "<span class='badge bg-warning text-dark'>Dipinjam</span>";
                        ?>
                        <tr>
                            <td>
                                <?php if(!empty($row['sampul']) && file_exists('uploads/'.$row['sampul'])): ?>
                                    <img src="uploads/<?php echo $row['sampul']; ?>" width="60" class="rounded shadow-sm" alt="Sampul">
                                <?php else: ?>
                                    <span class="badge bg-secondary">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold"><?php echo isset($row['judul_buku']) ?$row['judul_buku'] : (isset($row['judul']) ?$row['judul'] : '-'); ?></td>
                            <td><?php echo isset($row['kategori']) ?$row['kategori'] : '-'; ?></td>
                            <td><?php echo isset($row['penulis']) ?$row['penulis'] : '-'; ?></td>
                            <td><?php echo isset($row['tahun_terbit']) ?$row['tahun_terbit'] : '-'; ?></td>
                            <td><?php echo $status; ?> <br><small class="text-muted">(Sisa: <?php echo $row['stok']; ?>)</small></td>
                            <td>
                                <!-- Tombol Edit -->
                                <form action="edit_buku.php" method="POST" class="d-inline-block">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-primary mb-1">Edit</button>
                                </form>

                                <!-- Tombol Hapus -->
                                <form action="hapus_buku.php" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin hapus buku ini?');">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger mb-1">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php 
                            } 
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Belum ada data buku.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>