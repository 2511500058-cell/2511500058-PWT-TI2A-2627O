<?php
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    // Menghapus data detail terlebih dahulu, baru data utama jadwal
    $delete_detail = mysqli_query($koneksi, "DELETE FROM detail_jadwal WHERE id_jadwal='$id'");
    $delete_utama = mysqli_query($koneksi, "DELETE FROM jadwal_kelas WHERE id_jadwal='$id'");
    
    if ($delete_utama) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location.href='index.php?page=jadwal';</script>";
    }
}
?>

<div class="data">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Data Jadwal</h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_jadwal" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Jadwal
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>KD Jadwal</th>
                                <th>Guru</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Detail Mapel</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            // Join ke tabel guru dan kelas sekaligus agar semua teks terbaca sempurna
                            $query = mysqli_query($koneksi, "SELECT * FROM jadwal_kelas 
                            JOIN guru ON jadwal_kelas. kd_guru = guru. kd_guru 
                            JOIN kelas ON jadwal_kelas. id_kelas = kelas. id_kelas");
                            while($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo $data['id_jadwal']; ?></strong></td>
                                <td><?php echo $data['nm_guru']; ?></td>
                                <td><?php echo $data['nm_kelas']; ?></td>
                                <td><?php echo ucfirst($data['semester']); ?></td>
                                <td><?php echo $data['thn_ajaran']; ?></td>
                                <td>

                                    <ul>
                                    <?php
                                    $id_jadwal = $data['id_jadwal'];
                                    $detail_query = mysqli_query($koneksi, "SELECT * FROM detail_jadwal 
                                    JOIN mapel ON detail_jadwal. kd_mapel = mapel. kd_mapel 
                                    WHERE id_jadwal='$id_jadwal'");
                                    while($detail = mysqli_fetch_array($detail_query)) {
                                    echo "<li>" . $detail['nm_mapel'] . " (" . $detail['hari'] . " / " . substr($detail['jam_mulai'], 0, 5) . "-" . substr($detail['jam_selesai'], 0, 5) . ")</li>";
                                    }
                                    ?>
                                    </ul>
                                </td>
                                <td>
                                    <a href="cetak_jadwal.php?id=<?php echo $data['id_jadwal']; ?>" 
                                       target="_blank" 
                                       class="btn btn-success btn-sm" 
                                       title="Cetak Jadwal">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <a href="index.php?page=jadwal&hapus=<?php echo $data['id_jadwal']; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Yakin hapus jadwal ini?')"
                                       title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>