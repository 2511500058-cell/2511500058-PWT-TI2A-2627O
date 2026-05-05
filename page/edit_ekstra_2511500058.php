<?php
$id_ekstra = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ekstra_2511500058 WHERE id_ekstra= '$id_ekstra'"));

if(isset($_POST['update'])) {
    $id_ekstra = $_POST['id_ekstra'];
    $nama_ekstra = $_POST['nama_ekstra'];
    $keterangan = $_POST['ket'];
    $semester= $_POST['semester'];
    $tahun_ajaran = $_POST['thn_ajaran'];
    
    $update = mysqli_query($koneksi, "UPDATE ekstra_2511500058 SET 
        id_ekstra='$id_ekstra', nama_ekstra='$nama_ekstra', ket='$keterangan', semester='$semester', thn_ajaran='$tahun_ajaran' 
        WHERE id_ekstra='$id_ekstra'");
    
    if($update) {
        echo '<div class="alert alert-success">Data berhasil diupdate!</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra_2511500058">';
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Ekstrakulikuler</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ID Ekstrakulikuler <span class="text-danger">*</span></label>
                                <input type="text" name="id_ekstra" value="<?php echo $data['id_ekstra']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ekstra" value="<?php echo $data['nama_ekstra']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="ket" class="form-control" rows="2"><?php echo $data['ket']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Semester</label>
                                <select name="semester" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="thn_ajaran" class="form-control">
                                    <option value="2023/2024">2023/2024</option>
                                    <option value="2024/2025">2024/2025</option>
                                    <option value="2025/2026">2025/2026</option>
                                    <option value="2026/2027">2026/2027</option>
                                </select>
                            </div>
                        </div>
                <div class="card-footer">
                    <button type="submit" name="update" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="index.php?page=ekstra_2511500058" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>