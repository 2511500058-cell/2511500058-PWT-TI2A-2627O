<?php
if (isset($_GET['action']) == "hapus") {
    $kd_guru = $_GET['kd'];
    mysqli_query($koneksi, "DELETE FROM guru WHERE kd_guru='$kd_guru'");
    echo '<div class="alert alert-success">Data berhasil dihapus!</div>';
}
?>

<div class="data">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Data Guru</h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_guru" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Guru
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>KD Guru</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Pendidikan Terakhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nm_guru");
                            while($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo $data['kd_guru']; ?></strong></td>
                                <td><?php echo $data['nm_guru']; ?></td>
                                <td><?php echo $data['jenkel']; ?></td>
                                <td><?php echo $data['pend_terakhir']; ?></td>
                                
                                <td>
                                    <a href="index.php?page=edit_guru&kd=<?php echo $data['kd_guru']; ?>" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?page=guru&action=hapus&kd=<?php echo $data['kd_guru']; ?>" 
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