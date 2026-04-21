<?php
$kd_guru = $_GET['kd'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM guru WHERE kd_guru='$kd_guru'"));

if(isset($_POST['update'])) {
    $kd_guru_new = $_POST['kd_guru'];
    $nm = $_POST['nm_guru'];
    $jk = $_POST['jenkel'];
    $pt = $_POST['pend_terakhir'];
    
    $update = mysqli_query($koneksi, "UPDATE guru SET 
        kd_guru='$kd_guru_new', nama='$nm', jenkel='$jk', pend_terakhir='$pt' 
        WHERE kd_guru='$kd_guru'");
    
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
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Data Guru</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>KD Guru <span class="text-danger">*</span></label>
                                <input type="text" name="kd_guru" value="<?php echo $data['kd_guru']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama" value="<?php echo $data['nm_guru']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" name="nip" value="<?php echo $data['jenkel']; ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pendidikan Terakhir</label>
                                <textarea name="alamat" class="form-control" rows="2"><?php echo $data['pend_terakhir']; ?></textarea>
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