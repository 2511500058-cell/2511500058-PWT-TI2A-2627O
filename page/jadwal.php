<?php
// Ambil Username dan Role dari session saat login (Gunakan huruf kecil menyesuaikan index.php)
$username_ses = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$role_ses = isset($_SESSION['role']) ? $_SESSION['role'] : ''; 
?>

<style>
    @media print {
        .no-print, .main-footer, .main-header, .main-sidebar {
            display: none !important;
        }
        .content-wrapper {
            margin-left: 0 !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>

<div class="content-header no-print">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal Pelajaran</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-body">
                
                <div class="no-print">
                    <?php 
                    // Tombol Tambah Jadwal HANYA muncul untuk Admin
                    if ($role_ses == 'admin') { 
                    ?>
                        <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm mb-3">
                            <i class="fas fa-plus"></i> Tambah Jadwal Baru
                        </a>
                    <?php } ?>
                    
                    <button onclick="window.print()" class="btn btn-success btn-sm mb-3">
                        <i class="fas fa-print"></i> Cetak Jadwal
                    </button>
                </div>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Mapel</th>
                            <th>Guru Pengampu</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <?php 
                            // Kolom Aksi HANYA muncul untuk Admin
                            if ($role_ses == 'admin') { echo "<th class='no-print'>Aksi</th>"; } 
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        
                        // 1. Query Dasar (Diperbaiki menggunakan tabel jadwal_kelas dan detail_jadwal)
                        $query = "SELECT jk.id_jadwal, jk.thn_ajaran, jk.semester, 
                                         dj.hari, dj.jam_mulai, dj.jam_selesai, 
                                         k.nm_kelas, m.nm_mapel, m.kd_mapel, g.nm_guru 
                                  FROM jadwal_kelas jk 
                                  JOIN detail_jadwal dj ON jk.id_jadwal = dj.id_jadwal 
                                  JOIN kelas k ON jk.id_kelas = k.id_kelas 
                                  JOIN mapel m ON dj.kd_mapel = m.kd_mapel 
                                  JOIN guru g ON dj.kd_guru = g.kd_guru ";
                        
                        // 2. Filter Query Berdasarkan Role
                        if ($role_ses == 'guru') {
                            $query .= " WHERE dj.kd_guru = '$username_ses' "; 
                        } 
                        else if ($role_ses == 'siswa') {
                            $query .= " JOIN siswa s ON s.id_kelas = jk.id_kelas 
                                        WHERE s.nis = '$username_ses' "; 
                        }

                        // 3. Urutkan Jadwal
                        $query .= " ORDER BY FIELD(dj.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'), dj.jam_mulai ASC";
                        
                        $sql = mysqli_query($koneksi, $query);
                        
                        if ($sql && mysqli_num_rows($sql) > 0) {
                            while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><strong><?= $data['nm_kelas']; ?></strong></td>
                                <td class="text-center"><?= $data['thn_ajaran']; ?></td>
                                <td class="text-center">
                                    <span class="badge badge-info"><?= ucwords($data['semester']); ?></span>
                                </td>
                                <td>
                                    <strong><?= $data['nm_mapel']; ?></strong><br>
                                    <small class="text-muted no-print">Kode: <?= $data['kd_mapel']; ?></small>
                                </td>
                                <td><?= $data['nm_guru']; ?></td>
                                <td class="text-center">
                                    <span class="badge badge-success"><?= $data['hari']; ?></span>
                                </td>
                                <td class="text-center">
                                    <i class="far fa-clock no-print"></i> 
                                    <?= date('H:i', strtotime($data['jam_mulai'])); ?> - <?= date('H:i', strtotime($data['jam_selesai'])); ?>
                                </td>
                                <?php 
                                // Tombol Hapus HANYA muncul untuk Admin
                                if ($role_ses == 'admin') { 
                                ?>
                                    <td class="text-center no-print">
                                        <a href="index.php?page=jadwal&hapus=<?= $data['id_jadwal']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php 
                            }
                        } else {
                            $colspan = ($role_ses == 'admin') ? 9 : 8; 
                            $error_msg = !$sql ? "Error Database: " . mysqli_error($koneksi) : "Belum ada data jadwal yang tersedia.";
                            echo "<tr><td colspan='{$colspan}' class='text-center text-muted py-4'>{$error_msg}</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// Fungsi hapus diperbaiki agar menghapus dari detail_jadwal juga
if (isset($_GET['hapus']) && $role_ses == 'admin') {
    $id = $_GET['hapus'];
    
    // Hapus detail jadwal terlebih dahulu agar tidak ada sisa relasi
    $delete_detail = mysqli_query($koneksi, "DELETE FROM detail_jadwal WHERE id_jadwal='$id'");
    $delete_utama = mysqli_query($koneksi, "DELETE FROM jadwal_kelas WHERE id_jadwal='$id'");
    
    if ($delete_utama) {
        echo "<script>alert('Data Jadwal Berhasil Dihapus'); window.location.href='index.php?page=jadwal';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data jadwal. Error: " . mysqli_error($koneksi) . "'); window.location.href='index.php?page=jadwal';</script>";
    }
}
?>