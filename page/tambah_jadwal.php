<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-chalkboard-teacher"></i> Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
// Mengambil nilai angka terbesar untuk rekomendasi ID berikutnya (karena tipe datanya INT)
$carikode = mysqli_query($koneksi, "SELECT MAX(id_jadwal) FROM jadwal_kelas") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode && $datakode[0] !== null) {
    $hasilkode = (int)$datakode[0] + 1;
} else {
    $hasilkode = 1;
}

$_SESSION['KODE'] = $hasilkode;

if (isset($_POST['tambah'])) {
    $kd_guru = $_POST['kd_guru'];
    $id_kelas = $_POST['id_kelas'];
    $thn_ajaran = $_POST['tahun_ajaran'];
    $semester = $_POST['semester'];

    $kd_mapel = $_POST['kd_mapel'] ?? [];
    $hari = $_POST['hari'] ?? [];
    $jam_mulai = $_POST['jam_mulai'] ?? [];
    $jam_selesai = $_POST['jam_selesai'] ?? [];

    // Menyebutkan nama kolom secara spesifik agar terhindar dari Column Count Mismatch
    $insertjadwal = mysqli_query($koneksi, "INSERT INTO jadwal_kelas (kd_guru, id_kelas, thn_ajaran, semester) 
                    VALUES ('$kd_guru', '$id_kelas', '$thn_ajaran', '$semester')");

    if (!$insertjadwal) {
        echo "Gagal insert ke tabel jadwal: " . mysqli_error($koneksi);
        die;
    }

    // Mengambil id_jadwal terakhir yang digenerate otomatis oleh AUTO_INCREMENT
    $id_jadwal_baru = mysqli_insert_id($koneksi);

    $allsuccess = true;
    for ($i = 0; $i < count($kd_mapel); $i++) {
        // Memasukkan data ke detail_jadwal sesuai dengan urutan kolom di database Anda
        $insertdetail = mysqli_query($koneksi, "INSERT INTO detail_jadwal (id_jadwal, kd_mapel, kd_guru, hari, jam_mulai, jam_selesai) 
                        VALUES ('$id_jadwal_baru', '$kd_mapel[$i]', '$kd_guru', '$hari[$i]', '$jam_mulai[$i]', '$jam_selesai[$i]')");
        
        if (!$insertdetail) {
            $allsuccess = false;
            echo "Gagal insert ke tabel detail_jadwal: " . mysqli_error($koneksi);  
        }
    }

    if ($allsuccess) {
        echo "<script>alert('Data Jadwal berhasil disimpan'); window.location.href='index.php?page=jadwal';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan detail jadwal'); window.location.href='index.php?page=tambah_jadwal';</script>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h3> Tambah Jadwal</h3>
                <form method="POST">
                    <div class="form-group">
                        <label>KD Jadwal (Otomatis Sistem)</label>
                        <input type="text" value="<?php echo $_SESSION['KODE']; ?>" class="form-control" readonly disabled>
                    </div>
                    <div class="form-group">
                        <label>Guru</label>
                        <select name="kd_guru" class="form-control" required>
                            <option value="" selected disabled>--Pilih Guru--</option>
                            <?php
                            $guru_query = mysqli_query($koneksi, "SELECT * FROM guru");
                            while ($guru = mysqli_fetch_array($guru_query)) {
                                echo "<option value='" . $guru['kd_guru'] . "'>" . $guru['nm_guru'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-control" required>
                            <option value="" selected disabled>--Pilih Kelas--</option>
                            <?php
                            $kelas_query = mysqli_query($koneksi, "SELECT * FROM kelas");
                            while ($kelas = mysqli_fetch_array($kelas_query)) {
                                echo "<option value='" . $kelas['id_kelas'] . "'>" . $kelas['nm_kelas'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Semester </label>
                        <select name="semester" class="form-control" required>
                            <option value="" selected disabled>--Pilih Semester--</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Tahun Ajaran </label>
                        <select name="tahun_ajaran" class="form-control" required>
                            <option value="" selected disabled>--Pilih Tahun Ajaran--</option>
                            <option value="2024/2025">2024/2025</option>
                            <option value="2025/2026">2025/2026</option>
                        </select>
                    </div>

                    <hr>
                    <h5> Detail Jadwal (Mata Pelajaran)</h5>
                    <div id="detail-jadwal-container">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <select name="kd_mapel[]" class="form-control" required>
                                    <option value="" selected disabled>--Pilih Mapel--</option>
                                    <?php
                                    $mapel_query = mysqli_query($koneksi, "SELECT * FROM mapel");
                                    while ($mapel = mysqli_fetch_array($mapel_query)) {
                                        echo "<option value='" . $mapel['kd_mapel'] . "'>" . $mapel['nm_mapel'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="hari[]" class="form-control" required>
                                    <option value="" selected disabled>--Pilih Hari--</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="jam_mulai[]" class="form-control" required>
                                    <option value="" selected disabled>--Jam Mulai--</option>
                                    <option value="08:00:00">08:00</option>
                                    <option value="09:00:00">09:00</option>
                                    <option value="10:00:00">10:00</option>
                                    <option value="11:00:00">11:00</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="jam_selesai[]" class="form-control" required>
                                    <option value="" selected disabled>--Jam Selesai--</option>
                                    <option value="09:00:00">09:00</option>
                                    <option value="10:00:00">10:00</option>
                                    <option value="11:00:00">11:00</option>
                                    <option value="12:00:00">12:00</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="tambahBaris()" class="btn btn-info">+ Tambah Mapel</button>
                    <br><br>
                    <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function tambahBaris() {
    let container = document.getElementById('detail-jadwal-container');
    let row = container.firstElementChild.cloneNode(true);
    row.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
    container.appendChild(row); // Menambahkan baris baru ke kontainer secara dinamis
}
</script>