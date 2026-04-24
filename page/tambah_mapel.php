<?php
if (isset($_POST['simpan'])) {
    $kd_mapel = $_POST['kd_mapel'];
    $nm_mapel = $_POST['nm_mapel'];
    $kkm = $_POST['kkm'];
    
    // PERBAIKAN: Gunakan mysqli_num_rows
    $cek = mysqli_query($koneksi, "SELECT * FROM mapel WHERE kd_mapel = '$kd_mapel'");
    if (mysqli_num_rows($cek) > 0) {
        echo '<div class="alert alert-danger">Kode Mapel sudah ada!</div>';
    } else {
        // PERBAIKAN: Simpan ke variabel $query
        $query = mysqli_query($koneksi, "INSERT INTO mapel (kd_mapel, nm_mapel, kkm) VALUES ('$kd_mapel', '$nm_mapel', '$kkm')");
        
        if ($query) {
            echo '<div class="alert alert-success">Data berhasil disimpan!</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=mapel">';
        }
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus"></i> Tambah Data Mapel</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>KD Mapel <span class="text-danger">*</span></label>
                                <input type="text" name="kd_mapel" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama Mapel <span class="text-danger">*</span></label>
                                <input type="text" name="nm_mapel" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>KKM</label>
                                <input type="number" name="kkm" class="form-control" required>
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