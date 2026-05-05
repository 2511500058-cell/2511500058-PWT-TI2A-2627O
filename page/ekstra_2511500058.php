<?php
if (isset($_GET['action']) == "hapus") {
    $id_ekstra = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM ekstra_2511500058 WHERE id_ekstra='$id_ekstra'");
    echo '<div class="alert alert-success">Data berhasil dihapus!</div>';
}
?>

<div class="data">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Data Ekstrakulikuler</h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_ekstra_2511500058" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Ekstrakulikuler
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Ekstrakulikuler</th>
                                <th>Nama Ekstrakulikuler</th>
                                <th>Keterangan</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500058 ORDER BY nama_ekstra");
                            while($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo $data['id_ekstra']; ?></strong></td>
                                <td><?php echo $data['nama_ekstra']; ?></td>
                                <td><?php echo $data['ket']; ?></td>     
                                <td><?php echo $data['semester']; ?></td>
                                <td><?php echo $data['thn_ajaran']; ?></td>
                                <td>
                                    <a href="index.php?page=edit_ekstra_2511500058&id=<?php echo $data['id_ekstra']; ?>" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?page=ekstra_2511500058&action=hapus&id=<?php echo $data['id_ekstra']; ?>" 
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