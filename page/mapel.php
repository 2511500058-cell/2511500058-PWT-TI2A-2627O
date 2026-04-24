<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Mapel</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM mapel WHERE kd_mapel = '$kd'");
        if ($query) {
            echo '<div class="alert alert-success alert-dismissible">Data Berhasil Dihapus!</div>';
            // Perbaikan: Redirect ke halaman mapel, bukan edit_mapel
            echo '<meta http-equiv="refresh" content="1; url=index.php?page=mapel">';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_mapel" class="btn btn-primary btn-sm mb-3">Tambah Data</a>
                <table class="table table-striped table-bordered">
                    <thead> <tr>
                            <th>No</th>
                            <th>Kd Mapel</th>
                            <th>Nama Mapel</th>
                            <th>KKM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "SELECT * FROM mapel");
                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                        ?>
                        <tr>
                            <td><?= $no; ?></td> <td><?= $result['kd_mapel']; ?></td>
                            <td><?= $result['nm_mapel']; ?></td>
                            <td><?= $result['kkm']; ?></td>
                            <td>
                                <a href="index.php?page=mapel&action=hapus&kd=<?= $result['kd_mapel'] ?>" onclick="return confirm('Yakin ingin menghapus?')">
                                    <span class="badge badge-danger">Hapus</span>
                                </a>
                                <a href="index.php?page=edit_mapel&kd=<?= $result['kd_mapel'] ?>">
                                    <span class="badge badge-warning">Edit</span>
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