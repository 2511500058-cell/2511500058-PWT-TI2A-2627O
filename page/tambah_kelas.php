<?php
if(isset($_POST['simpan'])) {
    $nama_kelas = $_POST['nama_kelas'];
    $kode_kelas = $_POST['kode_kelas'];
    
    $insert = mysqli_query($koneksi, "INSERT INTO kelas SET 
        nama_kelas='$nama_kelas', kode_kelas='$kode_kelas'");
    
    if($insert) {
        echo '<div class="alert alert-success">Data kelas berhasil disimpan!</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
    }
}
?>

<div class="row">
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus"></i> Tambah Data Kelas</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kode Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="kode_kelas" class="form-control" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="index.php?page=kelas" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>