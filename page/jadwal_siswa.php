<?php
if ($_SESSION['role'] != 'siswa') {
    echo "<div class='alert alert-danger'>Akses ditolak! Halaman ini hanya untuk Siswa.</div>";
    exit;
}

$nis = $_SESSION['username']; // Username siswa adalah NIS siswa (contoh: '110')

// 1. Ambil ID Kelas siswa yang sedang login dari tabel siswa
$query_siswa = mysqli_query($koneksi, "SELECT id_kelas FROM siswa WHERE nis = '$nis'");
$data_siswa = mysqli_fetch_array($query_siswa);

if(!$data_siswa) {
    echo "<div class='alert alert-warning'>Data Anda belum dihubungkan ke kelas manapun oleh Admin.</div>";
    exit;
}

$id_kelas = $data_siswa['id_kelas'];
?>

<div class="data">
    <div class="col-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calendar-check"></i> Jadwal Pelajaran Kelas Saya</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-datatable">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Wali Kelas</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Daftar Mata Pelajaran Hari Ini</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            // 2. Tampilkan jadwal pelajaran yang sesuai dengan id_kelas milik siswa
                            $query = mysqli_query($koneksi, "SELECT * FROM jadwal_kelas 
                                     JOIN guru ON jadwal_kelas.kd_guru = guru.kd_guru 
                                     WHERE jadwal_kelas.id_kelas = '$id_kelas'");
                                     
                            while($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nm_guru']; ?></td>
                                <td><?php echo ucfirst($data['semester']); ?></td>
                                <td><?php echo $data['thn_ajaran']; ?></td>
                                <td>
                                    <ul class="pl-3">
                                        <?php
                                        $id_jadwal = $data['id_jadwal'];
                                        // Ambil semua detail mapel beserta nama guru pengampunya
                                        $detail_query = mysqli_query($koneksi, "SELECT * FROM detail_jadwal 
                                                        JOIN mapel ON detail_jadwal.kd_mapel = mapel.kd_mapel
                                                        JOIN guru ON detail_jadwal.kd_guru = guru.kd_guru
                                                        WHERE id_jadwal='$id_jadwal' ORDER BY hari, jam_mulai");
                                        while($detail = mysqli_fetch_array($detail_query)) {
                                            echo "<li><strong>" . $detail['nm_mapel'] . "</strong> — Pengajar: " . $detail['nm_guru'] . " <span class='badge badge-secondary'>" . $detail['hari'] . " (" . substr($detail['jam_mulai'], 0, 5) . "-" . substr($detail['jam_selesai'], 0, 5) . ")</span></li>";
                                        }
                                        if(mysqli_num_rows($detail_query) == 0){
                                            echo "<li>Belum ada mata pelajaran diinput untuk kelas ini.</li>";
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php if(mysqli_num_rows($query) == 0){ ?>
                                <tr>
                                    <td colspan="5" class="text-center">Jadwal pelajaran untuk kelas Anda belum tersedia.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>