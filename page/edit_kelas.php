<?php
$id_kelas = $_GET['kd'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas ='$id_kelas'"));

if(isset($_POST['update'])) {
    $id_kelas = $_POST['id_kelas'];
    $nm_kelas = $_POST['nm_kelas'];
    
    $update = mysqli_query($koneksi, "UPDATE kelas SET 
        id_kelas='$id_kelas', nm_kelas='$nm_kelas' 
        WHERE id_kelas='$id_kelas'");
    
    if($update) {
        echo '<div class="alert alert-success">Data berhasil diupdate!</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Data Kelas</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ID Kelas <span class="text-danger">*</span></label>
                                <input type="text" name="id_kelas" value="<?php echo $data['id_kelas']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama Kelas <span class="text-danger">*</span></label>
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