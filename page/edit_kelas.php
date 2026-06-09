<?php
$kd = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas='$kd'");
$data = mysqli_fetch_array($query);
 

if (isset($_POST['update'])) {
    $nm = $_POST['nm_kelas'];

    $update = mysqli_query($koneksi, "UPDATE kelas SET nm_kelas='$nm'
    WHERE id_kelas='$kd'");

    
    if($update) {
        echo '<div class="alert alert-success">Data berhasil diupdate!</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
    }
}
?>

<?php
if ($role != 'admin') {
    echo "<script>alert('Akses Ditolak! Halaman ini hanya untuk Admin.'); window.location.href='index.php?page=kelas';</script>";
    exit;
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Kelas</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nm_kelas" value="<?php echo $data['nm_kelas']; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="index.php?page=kelas" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>