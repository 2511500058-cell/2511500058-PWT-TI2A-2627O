<?php
// Proteksi Halaman: Wajib ditaruh paling atas agar Guru/Siswa langsung ditendang keluar
if ($role != 'admin') {
    echo "<script>alert('Akses Ditolak! Halaman ini hanya untuk Admin.'); window.location.href='index.php?page=mapel';</script>";
    exit;
}

$kd = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM mapel WHERE kd_mapel='$kd'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $mapel = mysqli_real_escape_string($koneksi, $_POST['nm_mapel']);
    $kkm = $_POST['kkm'];

    $update = mysqli_query($koneksi, "UPDATE mapel SET nm_mapel='$mapel', kkm='$kkm' WHERE kd_mapel='$kd'");
    
    if($update) {
        echo '<div class="alert alert-success">Data berhasil diupdate!</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=mapel">';
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Mapel</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nm_mapel" value="<?php echo $data['nm_mapel']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>KKM</label>
                                <textarea name="kkm" class="form-control" rows="2"><?php echo $data['kkm']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="index.php?page=mapel" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>