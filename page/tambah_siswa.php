<?php
if(isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nm_siswa'];
    $jenkel = $_POST['jenkel'];
    $id_kelas = $_POST['id_kelas'];

    $querySiswa = mysqli_query($koneksi, "INSERT INTO siswa VALUES ('$nis', '$nama', '$jenkel', '$id_kelas')");
    $queryUser = mysqli_query($koneksi, "INSERT INTO tbl_users (username, password, role) VALUES ('$nis', '1234', 'siswa')");
    
    
    $insert = mysqli_query($koneksi, "INSERT INTO siswa SET 
        nis='$nis', nm_siswa='$nama', jenkel='$jenkel', id_kelas='$id_kelas'");
    
    if ($querySiswa && $queryUser) {
        echo "<script>alert('Data Siswa & User berhasil disimpan'); window.location.href='index.php?page=siswa';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus"></i> Tambah Data Siswa</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>NIS <span class="text-danger">*</span></label>
                                <input type="text" name="nis" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nm_siswa" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenkel" class="form-control">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ID Kelas</label>
                                <input type="text" name="id_kelas" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="index.php?page=siswa" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>