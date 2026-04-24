<?php
$nis = $_GET['kd'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'"));

if(isset($_POST['update'])) {
    $nis = $_POST['nis'];
    $nm = $_POST['nm_siswa'];
    $jk = $_POST['jenkel'];
    $id = $_POST['id_kelas'];
    
    $update = mysqli_query($koneksi, "UPDATE siswa SET 
        nis='$nis', nm_siswa='$nm', jenkel='$jk', id_kelas='$id' 
        WHERE nis='$nis'");
    
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
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Data Siswa</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>NIS <span class="text-danger">*</span></label>
                                <input type="text" name="nis" value="<?php echo $data['nis']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nm_siswa" value="<?php echo $data['nm_siswa']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenkel" class="form-control">
                                    <option value="L" <?php if($data['jenkel'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                                    <option value="P" <?php if($data['jenkel'] == 'P') echo 'selected'; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ID Kelas</label>
                                <input type="text" name="id_kelas" value="<?php echo $data['id_kelas']; ?>" class="form-control">
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