<?php
if (isset($_GET['action']) == "hapus") {
    $id_kelas = $_GET['kd'];
    mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas ='$id_kelas'");
    echo '<div class="alert alert-success">Data berhasil dihapus!</div>';
}
?>

<div class="data">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Data Kelas</h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_kelas" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Kelas
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Kelas</th>
                                <th>Nama Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nm_kelas");
                            while($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo $data['id_kelas']; ?></strong></td>
                                <td><?php echo $data['nm_kelas']; ?></td>
                                <td>
                                    <a href="index.php?page=edit_kelas&kd=<?php echo $data['id_kelas']; ?>" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?page=kelas&action=hapus&kd=<?php echo $data['id_kelas']; ?>" 
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