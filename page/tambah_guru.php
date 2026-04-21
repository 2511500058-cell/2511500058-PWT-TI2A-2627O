<?php
if(isset($_POST['simpan'])) {
    $kd_guru = $_POST['kd_guru'];
    $nama = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend_terakhir = $_POST['pend_terakhir'];
    
    $insert = mysqli_query($koneksi, "INSERT INTO guru SET 
        kd_guru='$kd_guru', nm_guru='$nama', jenkel='$jenkel', pend_terakhir='$pend_terakhir'");
    
    if($insert) {
        echo '<div class="alert alert-success">Data guru berhasil disimpan!</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus"></i> Tambah Data Guru</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>KD Guru <span class="text-danger">*</span></label>
                                <input type="text" name="kd_guru" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nm_guru" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" name="jenkel" class="form-control">
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pendidikan Terakhir</label>
                                <input type="text" name="pend_terakhir" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="index.php?page=guru" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>