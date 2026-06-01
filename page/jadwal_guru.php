<?php
if ($_SESSION['role'] != 'guru') {
    echo "<div class='alert alert-danger'>Akses ditolak! Halaman ini hanya untuk Guru.</div>";
    exit;
}

$kd_guru = $_SESSION['username']; // Pada tabel user Anda, username guru diisi dengan KD Guru (contoh: '100')
?>

<div class="data">
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Jadwal Mengajar Saya</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-datatable">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Detail Mengajar (Mapel / Hari / Jam)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            // Menampilkan jadwal kelas di mana guru tersebut mengajar
                            $query = mysqli_query($koneksi, "SELECT * FROM jadwal_kelas 
                                     JOIN kelas ON jadwal_kelas.id_kelas = kelas.id_kelas
                                     WHERE jadwal_kelas.kd_guru = '$kd_guru'");
                                     
                            while($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo $data['nm_kelas']; ?></strong></td>
                                <td><?php echo ucfirst($data['semester']); ?></td>
                                <td><?php echo $data['thn_ajaran']; ?></td>
                                <td>
                                    <ul>
                                        <?php
                                        $id_jadwal = $data['id_jadwal'];
                                        // Cari detail mengajar spesifik guru ini di kelas tersebut
                                        $detail_query = mysqli_query($koneksi, "SELECT * FROM detail_jadwal 
                                                        JOIN mapel ON detail_jadwal.kd_mapel = mapel.kd_mapel 
                                                        WHERE id_jadwal='$id_jadwal' AND kd_guru='$kd_guru'");
                                        while($detail = mysqli_fetch_array($detail_query)) {
                                            echo "<li>Mata Pelajaran: <strong>" . $detail['nm_mapel'] . "</strong> (" . $detail['hari'] . " / " . substr($detail['jam_mulai'], 0, 5) . "-" . substr($detail['jam_selesai'], 0, 5) . ")</li>";
                                        }
                                        if(mysqli_num_rows($detail_query) == 0){
                                            echo "<li>Tidak ada jam mengajar tambahan di kelas ini</li>";
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php if(mysqli_num_rows($query) == 0){ ?>
                                <tr>
                                    <td colspan="5" class="text-center">Anda belum memiliki jadwal mengajar yang terdaftar.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>