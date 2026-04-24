<?php
if (isset($_GET['action']) == "hapus") {
    $nis = $_GET['kd'];
    mysqli_query($koneksi, "DELETE FROM siswa WHERE nis='$nis'");
    echo '<div class="alert alert-success">Data berhasil dihapus!</div>';
}
?>

<div class="data">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Data Siswa</h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_siswa" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Siswa
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>ID Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nis");
                            while($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo $data['nis']; ?></strong></td>
                                <td><?php echo $data['nm_siswa']; ?></td>
                                <td><?php echo $data['jenkel']; ?></td>
                                <td><?php echo $data['id_kelas']; ?></td>
                                
                                <td>
                                    <a href="index.php?page=edit_siswa&kd=<?php echo $data['nis']; ?>" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?page=siswa&action=hapus&kd=<?php echo $data['nis']; ?>" 
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