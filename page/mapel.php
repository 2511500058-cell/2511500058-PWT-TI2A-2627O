<?php
if (isset($_GET['action']) == "hapus") {
    $kd_mapel = $_GET['kd'];
    mysqli_query($koneksi, "DELETE FROM mapel WHERE kd_mapel='$kd_mapel'");
    echo '<div class="alert alert-success">Data berhasil dihapus!</div>';
}
?>

<div class="data">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Data Mata Pelajaran</h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_mapel" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Mata Pelajaran
                    </a>
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
                                <th>Aksi</th>
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
                                
                                <td>
                                    <a href="index.php?page=edit_mapel&kd=<?php echo $data['kd_mapel']; ?>" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?page=mapel&action=hapus&kd=<?php echo $data['kd_mapel']; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Yakin hapus?')"
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