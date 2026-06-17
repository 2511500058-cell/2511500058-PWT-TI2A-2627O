<?php
// Proteksi Halaman: Wajib ditaruh paling atas agar Guru/Siswa langsung ditendang keluar
if ($role != 'admin') {
    echo "<script>alert('Akses Ditolak! Halaman ini hanya untuk Admin.'); window.location.href='index.php?page=ekstra_2511500058';</script>";
    exit;
}

$kd = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500058 WHERE id_ekstra='$kd'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $nm_ekstra = mysqli_real_escape_string($koneksi, $_POST['nama_ekstra']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['ket']);
    $semester = $_POST['semester'];
    $thn_ajaran = $_POST['thn_ajaran'];

    $update = mysqli_query($koneksi, "UPDATE ekstra_2511500058 SET nama_ekstra='$nm_ekstra', ket='$keterangan', semester='$semester', thn_ajaran='$thn_ajaran' WHERE id_ekstra='$kd'");
    
    if($update) {
        echo '<div class="alert alert-success">Data berhasil diupdate!</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra_2511500058">';
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Ekstrakulikuler</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ekstra" value="<?php echo $data['nama_ekstra']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="ket" class="form-control" rows="2"><?php echo $data['ket']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Semester</label>
                                <select name="semester" class="form-control">
                                    <option value="1" <?php if($data['semester'] == '1') echo 'selected'; ?>>1</option>
                                    <option value="2" <?php if($data['semester'] == '2') echo 'selected'; ?>>2</option>
                                    <option value="3" <?php if($data['semester'] == '3') echo 'selected'; ?>>3</option>
                                    <option value="4" <?php if($data['semester'] == '4') echo 'selected'; ?>>4</option>
                                    <option value="5" <?php if($data['semester'] == '5') echo 'selected'; ?>>5</option>
                                    <option value="6" <?php if($data['semester'] == '6') echo 'selected'; ?>>6</option>
                                    <option value="7" <?php if($data['semester'] == '7') echo 'selected'; ?>>7</option>
                                    <option value="8" <?php if($data['semester'] == '8') echo 'selected'; ?>>8</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="thn_ajaran" class="form-control">
                                    <option value="2023/2024" <?php if($data['thn_ajaran'] == '2023/2024') echo 'selected'; ?>>2023/2024</option>
                                    <option value="2024/2025" <?php if($data['thn_ajaran'] == '2024/2025') echo 'selected'; ?>>2024/2025</option>
                                    <option value="2025/2026" <?php if($data['thn_ajaran'] == '2025/2026') echo 'selected'; ?>>2025/2026</option>
                                    <option value="2026/2027" <?php if($data['thn_ajaran'] == '2026/2027') echo 'selected'; ?>>2026/2027</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="index.php?page=ekstra_2511500058" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>