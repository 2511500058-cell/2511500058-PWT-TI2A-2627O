<?php
// Ambil data mapel yang akan diedit
$kd_mapel = $_GET['kd'];
$query_edit = mysqli_query($koneksi, "SELECT * FROM mapel WHERE kd_mapel = '$kd_mapel'");
$data_edit = mysqli_fetch_array($query_edit);

// Proses Update
if (isset($_POST['update'])) {
    $kd_mapel_new = $_POST['kd_mapel'];
    $nm_mapel = $_POST['nm_mapel'];
    $kkm = $_POST['kkm'];
    
    $query_update = mysqli_query($koneksi, "UPDATE mapel SET 
                    kd_mapel = '$kd_mapel_new',
                    nm_mapel = '$nm_mapel',
                    kkm = '$kkm'
                    WHERE kd_mapel = '$kd_mapel'");
    
    if ($query_update) {
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
            Data Mapel berhasil diupdate!
        </div>';
        echo '<meta http-equiv="refresh" content="1; url=index.php?page=mapel">';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
            Terjadi kesalahan: ' . mysqli_error($koneksi) . '
        </div>';
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Data Mapel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=mapel">Mapel</a></li>
                    <li class="breadcrumb-item active">Edit Mapel</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Mapel</h3>
                    </div>
                    <form method="post" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kd_mapel">Kode Mapel <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kd_mapel" name="kd_mapel" 
                                       value="<?php echo $data_edit['kd_mapel']; ?>" required maxlength="10">
                            </div>
                            <div class="form-group">
                                <label for="nm_mapel">Nama Mapel <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nm_mapel" name="nm_mapel" 
                                       value="<?php echo $data_edit['nm_mapel']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="kkm">KKM <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="kkm" name="kkm" 
                                       value="<?php echo $data_edit['kkm']; ?>" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="update" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update Data
                            </button>
                            <a href="index.php?page=mapel" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>