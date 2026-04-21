<?php
// Ambil ID kelas dari URL
$id = $_GET['id'];

// Ambil data kelas yang akan diedit
$query_edit = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id = '$id'");
$data_edit = mysqli_fetch_array($query_edit);

if (!$data_edit) {
    echo '
    <div class="alert alert-danger alert-dismissible">
        <h5><i class="icon fas fa-ban"></i> Error!</h5>
        Data kelas tidak ditemukan!
    </div>';
    echo '<meta http-equiv="refresh" content="2;url=index.php?page=kelas">';
    exit;
}

// Proses Update
if (isset($_POST['update'])) {
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);
    $kode_kelas = mysqli_real_escape_string($koneksi, $_POST['kode_kelas']);
    
    $query_update = mysqli_query($koneksi, "UPDATE kelas SET 
                    nama_kelas = '$nama_kelas',
                    kode_kelas = '$kode_kelas'
                    WHERE id = '$id'");
    
    if ($query_update) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> 
            <strong>Berhasil!</strong> Data kelas berhasil diupdate!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        echo '<meta http-equiv="refresh" content="2;url=index.php?page=kelas">';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> 
            <strong>Gagal!</strong> ' . mysqli_error($koneksi) . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
}
?>

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-warning">
                    <i class="fas fa-edit"></i> Edit Data Kelas
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=kelas">Kelas</a></li>
                    <li class="breadcrumb-item active">Edit Kelas</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i> 
                            Edit Kelas: <strong><?php echo htmlspecialchars($data_edit['nama_kelas']); ?></strong>
                        </h3>
                    </div>
                    
                    <!-- Form Edit Kelas -->
                    <form method="POST" action="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nama_kelas">Nama Kelas <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control <?php echo isset($_POST['update']) && empty($_POST['nama_kelas']) ? 'is-invalid' : ''; ?>" 
                                               id="nama_kelas" 
                                               name="nama_kelas" 
                                               value="<?php echo htmlspecialchars($data_edit['nama_kelas']); ?>"
                                               required 
                                               placeholder="Contoh: X IPA 1">
                                        <?php if(isset($_POST['update']) && empty($_POST['nama_kelas'])): ?>
                                            <div class="invalid-feedback">Nama kelas wajib diisi!</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kode_kelas">Kode Kelas <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control <?php echo isset($_POST['update']) && empty($_POST['kode_kelas']) ? 'is-invalid' : ''; ?>" 
                                               id="kode_kelas" 
                                               name="kode_kelas" 
                                               value="<?php echo htmlspecialchars($data_edit['kode_kelas']); ?>"
                                               required 
                                               maxlength="10"
                                               placeholder="Contoh: XIPA1">
                                        <?php if(isset($_POST['update']) && empty($_POST['kode_kelas'])): ?>
                                            <div class="invalid-feedback">Kode kelas wajib diisi!</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Data Saat Ini -->
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info-circle"></i> Info Data Saat Ini:</h5>
                                <p>
                                    <strong>ID:</strong> <?php echo $data_edit['id']; ?><br>
                                    <strong>Dibuat:</strong> <?php echo date('d/m/Y H:i', strtotime($data_edit['created_at'])); ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Footer Form -->
                        <div class="card-footer">
                            <button type="submit" name="update" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update Data
                            </button>
                            <a href="index.php?page=kelas" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kelas
                            </a>
                            <div class="float-right">
                                <small class="text-muted">
                                    <i class="fas fa-asterisk"></i> Wajib diisi
                                </small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Info Tambahan -->
            <div class="col-lg-4">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-lightbulb"></i> Petunjuk</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success mr-2"></i> Isi semua field yang wajib (*)</li>
                            <li><i class="fas fa-check text-success mr-2"></i> Kode kelas harus unik</li>
                            <li><i class="fas fa-check text-success mr-2"></i> Nama kelas maksimal 50 karakter</li>
                            <li><i class="fas fa-exclamation-triangle text-warning mr-2"></i> Backup data sebelum edit</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>