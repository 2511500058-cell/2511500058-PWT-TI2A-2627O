<?php
// Proteksi backend: Hanya admin yang boleh mengeksekusi query hapus
if (isset($_GET['hapus'])) {
    if ($role == 'admin') {
        $id = $_GET['hapus'];
        $delete = mysqli_query($koneksi, "DELETE FROM mapel WHERE kd_mapel='$id'");
        if ($delete) {
            echo "<script>alert('Data Berhasil Dihapus'); window.location.href='index.php?page=mapel';</script>";
        }
    } else {
        echo '<div class="alert alert-danger">Akses Ditolak! Anda tidak memiliki izin untuk menghapus data.</div>';
    }
}
?>

<div class="data">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Data Mapel</h3>
                <div class="card-tools">
                    <?php if ($role == 'admin'): ?>
                    <a href="index.php?page=tambah_mapel" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Mapel
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>KD Mapel</th>
                                <th>Nama Mapel</th>
                                <th>KKM</th>
                                <?php if ($role == 'admin'): ?>
                                <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM mapel ORDER BY nm_mapel");
                            while($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo $data['kd_mapel']; ?></strong></td>
                                <td><?php echo $data['nm_mapel']; ?></td>
                                <td><?php echo $data['kkm']; ?></td>
                                
                                <?php if ($role == 'admin'): ?>
                                <td>
                                    <a href="index.php?page=edit_mapel&id=<?php echo $data['kd_mapel']; ?>" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?page=mapel&hapus=<?php echo $data['kd_mapel']; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Yakin hapus?')"
                                       title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>