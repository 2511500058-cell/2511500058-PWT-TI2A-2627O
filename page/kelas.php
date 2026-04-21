<?php
if (isset($_GET['action']) && $_GET['action'] == "hapus") {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM kelas WHERE id='$id'");
    echo '<div class="alert alert-success">Data kelas berhasil dihapus!</div>';
}
?>

<div class="row">
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-building"></i> Data Kelas</h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_kelas" class="btn btn-sm btn-success">
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
                                <th>ID</th>
                                <th>Nama Kelas</th>
                                <th>Kode Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas");
                            while($row = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['id']; ?></td>
                                <td><strong><?php echo $row['nama_kelas']; ?></strong></td>
                                <td><span class="badge badge-primary"><?php echo $row['kode_kelas']; ?></span></td>
                                <td>
                                    <a href="index.php?page=edit_kelas&id=<?php echo $row['id']; ?>" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?page=kelas&action=hapus&id=<?php echo $row['id']; ?>" 
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