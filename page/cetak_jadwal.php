<?php
session_start();
include "config/koneksi.php";

// Proteksi: Hanya Admin yang bisa cetak
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    echo "<script>alert('Akses Ditolak! Hanya Admin yang dapat mencetak.'); window.close();</script>";
    exit;
}

if(isset($_GET['id'])) {
    $id_jadwal = $_GET['id'];
    // Query mengambil data utama jadwal beserta guru utama dan nama kelas
    $query = mysqli_query($koneksi, "SELECT * FROM jadwal_kelas 
            JOIN guru ON jadwal_kelas.kd_guru = guru.kd_guru 
            JOIN kelas ON jadwal_kelas.id_kelas = kelas.id_kelas
            WHERE id_jadwal = '$id_jadwal'");
    $data = mysqli_fetch_array($query);
    
    if(!$data) { 
        echo "Jadwal tidak ditemukan."; 
        exit; 
    }
} else {
    echo "ID Jadwal tidak ditentukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Jadwal - <?php echo $data['nm_kelas']; ?></title>
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>
        body { padding: 30px; background-color: #fff !important; color: #000 !important; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="text-center mb-4">
        <h2>SISTEM INFORMASI AKADEMIK SEKOLAH</h2>
        <h3>JADWAL PELAJARAN KELAS</h3>
        <hr style="border-top: 3px double #000;">
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <table>
                <tr><td><strong>Kelas</strong></td><td> : <?php echo $data['nm_kelas']; ?></td></tr>
                <tr><td><strong>Tahun Ajaran</strong></td><td> : <?php echo $data['thn_ajaran']; ?></td></tr>
            </table>
        </div>
        <div class="col-6 text-right">
            <table>
                <tr><td><strong>Semester</strong></td><td> : <?php echo ucfirst($data['semester']); ?></td></tr>
                <tr><td><strong>Wali / Guru Kelas</strong></td><td> : <?php echo $data['nm_guru']; ?></td></tr>
            </table>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr class="text-center">
                <th width="5%">No</th>
                <th>Mata Pelajaran</th>
                <th>Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            // Query mengambil detail mata pelajaran di dalam jadwal tersebut
            $detail_query = mysqli_query($koneksi, "SELECT * FROM detail_jadwal 
                            JOIN mapel ON detail_jadwal .kd_mapel = mapel. kd_mapel 
                            WHERE id_jadwal='$id_jadwal' ORDER BY hari, jam_mulai");
            while($detail = mysqli_fetch_array($detail_query)) {
                echo "<tr class='text-center'>";
                echo "<td>".$no++."</td>";
                echo "<td>".$detail['nm_mapel']."</td>";
                echo "<td>".$detail['hari']."</td>";
                echo "<td>".substr($detail['jam_mulai'], 0, 5)."</td>";
                echo "<td>".substr($detail['jam_selesai'], 0, 5)."</td>";
                echo "</tr>";
            }
            if(mysqli_num_rows($detail_query) == 0) {
                echo "<tr><td colspan='5' class='text-center'>Belum ada detail mata pelajaran.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="row mt-5">
        <div class="col-8"></div>
        <div class="col-4 text-center">
            <p>Mengetahui,</p>
            <p>Kepala Sekolah</p>
            <br><br><br>
            <p><strong>_____________________</strong></p>
        </div>
    </div>

    <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Cetak</button>
        <button onclick="window.close()" class="btn btn-secondary">Tutup</button>
    </div>

    <script>
        // Memicu fungsi cetak bawaan browser otomatis saat halaman dimuat
        window.onload = function() { window.print(); }
    </script>
</body>
</html>