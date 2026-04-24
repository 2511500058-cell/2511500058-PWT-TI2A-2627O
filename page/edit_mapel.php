<?php
$kd_mapel = $_GET['kd']; 
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mapel WHERE kd_mapel='$kd_mapel'"));

if(isset($_POST['update'])) {
    $kd_mapel_new = $_POST['kd_mapel'];
    $nm = $_POST['nm_mapel'];
    $kkm = $_POST['kkm'];
    
    $update = mysqli_query($koneksi, "UPDATE mapel SET 
        kd_mapel='$kd_mapel_new', nm_mapel='$nm', kkm='$kkm' 
        WHERE kd_mapel='$kd_mapel'");
    
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
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Data Mapel</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>KD Mapel</label>
                                <input type="text" name="kd_mapel" value="<?php echo $data['kd_mapel']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama Mapel <span class="text-danger">*</span></label>
                                <input type="text" name="nm_mapel" value="<?php echo $data['nm_mapel']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>KKM</label>
                                <input type="number" name="kkm" value="<?php echo $data['kkm']; ?>" class="form-control" required>
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