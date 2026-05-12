<?php
$kd = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE kd_guru='$kd'");
$data = mysqli_fetch_array($query);


if (isset($_POST['update'])) {
    $nama_guru = mysqli_real_escape_string($koneksi, $_POST['nm_guru']);
    $jenkel = $_POST['jenkel'];
    $pend_terakhir = $_POST['pend_terakhir'];

    $update = mysqli_query($koneksi, "UPDATE guru SET nm_guru='$nama_guru', jenkel='$jenkel', pend_terakhir='$pend_terakhir'
    WHERE kd_guru='$kd'");

    
    if($update) {
        echo '<div class="alert alert-success">Data berhasil diupdate!</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Guru</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nm_guru" value="<?php echo $data['nm_guru']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenkel" class="form-control">
                                    <option value="Laki-laki" <?php if($data['jenkel'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php if($data['jenkel'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Pendidikan Terakhir</label>
                                <textarea name="pend_terakhir" class="form-control" rows="2"><?php echo $data['pend_terakhir']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="index.php?page=guru" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>