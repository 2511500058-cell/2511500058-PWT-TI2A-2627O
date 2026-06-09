<?php
// 1. Cek status session agar tidak muncul pesan error "session had already been started"
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sesuaikan path ini jika file koneksi ada di folder luar
include "../config/koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Jadwal Pelajaran</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <style>
        body { padding: 30px; background-color: #fff !important; color: #000 !important; font-family: sans-serif; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table, .table th, .table td { border: 1px solid black; }
        .table th, .table td { padding: 8px; text-align: center; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="text-center mb-4" style="text-align: center;">
        <h2>SISTEM INFORMASI AKADEMIK SEKOLAH</h2>
        <h3>JADWAL PELAJARAN KESELURUHAN</h3>
        <hr style="border-top: 3px double #000;">
    </div>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th width="5%">No</th>
                <th>Kelas</th>
                <th>Tahun Ajaran</th>
                <th>Semester</th>
                <th>Mata Pelajaran</th>
                <th>Guru Pengampu</th>
                <th>Hari</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            // 2. Menggunakan Query JOIN yang persis sama dengan jadwal.php
            $query = "SELECT j.*, k.nm_kelas, m.nm_mapel, g.nm_guru 
                      FROM jadwal j 
                      JOIN kelas k ON j.id_kelas = k.id_kelas 
                      JOIN mapel m ON j.kd_mapel = m.kd_mapel 
                      JOIN guru g ON j.kd_guru = g.kd_guru 
                      ORDER BY k.nm_kelas ASC, FIELD(j.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'), j.jam_mulai ASC";
            
            $sql = mysqli_query($koneksi, $query);
            
            // 3. Menampilkan data dengan looping
            if ($sql && mysqli_num_rows($sql) > 0) {
                while($data = mysqli_fetch_array($sql)) {
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td><strong>".$data['nm_kelas']."</strong></td>";
                    echo "<td>".$data['thn_ajaran']."</td>";
                    echo "<td>".ucwords($data['semester'])."</td>";
                    echo "<td>".$data['nm_mapel']."</td>";
                    echo "<td>".$data['nm_guru']."</td>";
                    echo "<td>".$data['hari']."</td>";
                    echo "<td>".substr($data['jam_mulai'], 0, 5)." - ".substr($data['jam_selesai'], 0, 5)."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Belum ada data jadwal yang tersedia.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="row mt-5" style="display: flex; justify-content: flex-end; margin-top: 50px;">
        <div style="text-align: center; width: 250px;">
            <p>Mengetahui,</p>
            <p>Kepala Sekolah</p>
            <br><br><br>
            <p><strong>_____________________</strong></p>
        </div>
    </div>

    <div class="text-center mt-4 no-print" style="text-align: center; margin-top: 30px;">
        <button onclick="window.print()" class="btn btn-primary" style="padding: 10px 20px; cursor: pointer;">Cetak</button>
        <button onclick="window.close()" class="btn btn-secondary" style="padding: 10px 20px; cursor: pointer;">Tutup</button>
    </div>

    <script>
        // Memicu fungsi cetak otomatis saat halaman dimuat
        window.onload = function() { window.print(); }
    </script>
</body>
</html>