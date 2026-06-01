<?php
// Mengambil nilai angka terbesar untuk rekomendasi ID berikutnya (karena tipe datanya INT)
$carikode = mysqli_query($koneksi, "SELECT MAX(id_jadwal) FROM jadwal_kelas") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode && $datakode[0] !== null) {
    $hasilkode = (int)$datakode[0] + 1;
} else {
    $hasilkode = 1;
}

if (isset($_POST['tambah'])) {
    $kd_guru = $_POST['kd_guru']; // Wali Kelas
    $id_kelas = $_POST['id_kelas']; // Kelas yang dijadwalkan
    $thn_ajaran = $_POST['tahun_ajaran'];
    $semester = $_POST['semester'];

    $kd_mapel = $_POST['kd_mapel'] ?? [];
    $kd_guru_mapel = $_POST['kd_guru_mapel'] ?? []; // Menangkap input Guru Pengajar per Mapel
    $hari = $_POST['hari'] ?? [];
    $jam_mulai = $_POST['jam_mulai'] ?? [];
    $jam_selesai = $_POST['jam_selesai'] ?? [];

    // 1. Simpan ke data induk jadwal kelas
    $insert_utama = mysqli_query($koneksi, "INSERT INTO jadwal_kelas (id_jadwal, kd_guru, id_kelas, thn_ajaran, semester) VALUES ('$hasilkode', '$kd_guru', '$id_kelas', '$thn_ajaran', '$semester')");
    
    if ($insert_utama) {
        // 2. Loop untuk menyimpan detail mata pelajaran ke tabel detail_jadwal
        for ($i = 0; $i < count($kd_mapel); $i++) {
            $mapel = $kd_mapel[$i];
            $guru_mpl = $kd_guru_mapel[$i];
            $hr = $hari[$i];
            $mulai = $jam_mulai[$i];
            $selesai = $jam_selesai[$i];
            
            mysqli_query($koneksi, "INSERT INTO detail_jadwal (id_jadwal, kd_mapel, kd_guru, hari, jam_mulai, jam_selesai) VALUES ('$hasilkode', '$mapel', '$guru_mpl', '$hr', '$mulai', '$selesai')");
        }
        echo "<script>alert('Jadwal Kelas dan Siswa Berhasil Disimpan!'); window.location.href='index.php?page=jadwal';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data jadwal.');</script>";
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-calendar-plus"></i> Buat Jadwal Kelas / Siswa</h1>
            </div>
        </div>
    </div>
</div>

<div class="data">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <form action="" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Pilih Kelas (Target Siswa)</label>
                            <select name="id_kelas" class="form-control" required>
                                <option value="" selected disabled>-- Pilih Kelas --</option>
                                <?php 
                                $qk = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nm_kelas");
                                while($dk = mysqli_fetch_array($qk)){
                                    echo "<option value='".$dk['id_kelas']."'>".$dk['nm_kelas']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Wali Kelas</label>
                            <select name="kd_guru" class="form-control" required>
                                <option value="" selected disabled>-- Pilih Wali --</option>
                                <?php 
                                $qg = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nm_guru");
                                while($dg = mysqli_fetch_array($qg)){
                                    echo "<option value='".$dg['kd_guru']."'>".$dg['nm_guru']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="form-control" placeholder="Contoh: 2025/2026" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Semester</label>
                            <select name="semester" class="form-control" required>
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <h5><i class="fas fa-list"></i> Detail Jadwal Pelajaran</h5>
                    <p class="text-muted text-sm">Tentukan mata pelajaran beserta guru pengampunya masing-masing.</p>
                    
                    <div id="detail-jadwal-container">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <select name="kd_mapel[]" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Mapel --</option>
                                    <?php 
                                    $qm = mysqli_query($koneksi, "SELECT * FROM mapel ORDER BY nm_mapel");
                                    while($dm = mysqli_fetch_array($qm)){
                                        echo "<option value='".$dm['kd_mapel']."'>".$dm['nm_mapel']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="kd_guru_mapel[]" class="form-control" required>
                                    <option value="" selected disabled>-- Guru Pengajar --</option>
                                    <?php 
                                    $qg2 = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nm_guru");
                                    while($dg2 = mysqli_fetch_array($qg2)){
                                        echo "<option value='".$dg2['kd_guru']."'>".$dg2['nm_guru']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="hari[]" class="form-control" required>
                                    <option value="" selected disabled>-- Hari --</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="time" name="jam_mulai[]" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <input type="time" name="jam_selesai[]" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" onclick="tambahBaris()" class="btn btn-info btn-sm mt-2">
                        <i class="fas fa-plus"></i> Tambah Baris Mapel
                    </button>
                </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" name="tambah" value="Simpan Jadwal">
                    <a href="index.php?page=jadwal" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function tambahBaris() {
    let container = document.getElementById('detail-jadwal-container');
    let row = container.firstElementChild.cloneNode(true);
    // Reset pilihan select dan input jam pada baris baru hasil clone
    row.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
    row.querySelectorAll('input').forEach(input => input.value = '');
    container.appendChild(row);
}
</script>