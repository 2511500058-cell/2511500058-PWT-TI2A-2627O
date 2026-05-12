<?php
$kd = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$kd'");
$data = mysqli_fetch_array($query);


if (isset($_POST['update'])) {
    $nm_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
    $jenkel = $_POST['jenis_kelamin'];
    $id_kelas = $_POST['id_kelas'];

    $update = mysqli_query($koneksi, "UPDATE siswa SET nm_siswa='$nm_siswa', jenkel='$jenkel', id_kelas='$id_kelas' 
    WHERE nis='$kd'");

    if($update) {
        echo '<div class="alert alert-success">Data berhasil diupdate!</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Siswa</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama_siswa" value="<?php echo $data['nm_siswa']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="Laki-laki" <?php if($data['jenkel'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php if($data['jenkel'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ID Kelas</label>
                                <input type="text" name="id_kelas" value="<?php echo $data['id_kelas']; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="index.php?page=siswa" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>