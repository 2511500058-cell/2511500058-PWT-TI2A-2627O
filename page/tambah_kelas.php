<?php
if(isset($_POST['simpan'])) {
    $id_kelas_new = $_POST['id_kelas'];
    $nm_kelas_new = $_POST['nm_kelas'];
    
    $insert = mysqli_query($koneksi, "INSERT INTO kelas SET 
        id_kelas='$id_kelas_new', nm_kelas='$nm_kelas_new'");
    
    if($insert) {
        echo '<div class="alert alert-success">Data kelas berhasil disimpan!</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus"></i> Tambah Kelas</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ID Kelas <span class="text-danger">*</span></label>
                                <input type="text" name="id_kelas" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama Kelas <span class="text-danger">*</span></label>
                                <input type="text" name="nm_kelas" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-primary">
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