<?php
if(isset($_POST['simpan'])) {
    $id_ekstra = $_POST['id_ekstra'];
    $nama_ekstra = $_POST['nama_ekstra'];
    $keterangan = $_POST['ket'];
    $semester = $_POST['semester'];
    $thn_ajaran = $_POST['thn_ajaran'];

    $queryekstra = mysqli_query($koneksi, "INSERT INTO ekstra_2511500058 VALUES ('$id_ekstra', '$nama_ekstra', '$keterangan', '$semester', '$thn_ajaran')");

    if ($queryekstra) {
        echo "<script>alert('Data Ekstrakulikuler berhasil disimpan'); window.location.href='index.php?page=ekstra_2511500058';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus"></i> Tambah Ekstrakulikuler</h3>
            </div>
            <form method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ID Ekstrakulikuler <span class="text-danger">*</span></label>
                                <input type="text" name="id_ekstra" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nama Ekstrakulikuler <span class="text-danger">*</span></label>
                                <input type="text" name="nama_ekstra" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="ket" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
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
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="simpan" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="index.php?page=ekstra_2511500058" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>