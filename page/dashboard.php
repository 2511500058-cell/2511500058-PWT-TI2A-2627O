<?php
$total_guru = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM guru"));
$total_siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa"));
$total_kelas = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kelas"));
$total_mapel = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM mapel"));
$total_ekstrakulikuler = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ekstra_2511500058"));
?>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $total_guru; ?></h3>
                <p>Total Guru</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="index.php?page=guru" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $total_siswa; ?></h3>
                <p>Total Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <a href="index.php?page=siswa" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo $total_kelas; ?></h3>
                <p>Total Kelas</p>
            </div>
            <div class="icon">
                <i class="fas fa-building"></i>
            </div>
            <a href="index.php?page=kelas" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo $total_mapel; ?></h3>
                <p>Total Mapel</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="index.php?page=mapel" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="col-lg-3 col-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo $total_ekstrakulikuler; ?></h3>
                <p>Total Ekstrakulikuler</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="index.php?page=ekstra_2511500058" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Selamat Datang, <?php echo ucfirst($_SESSION['username']); ?>!</h3>
            </div>
            <div class="card-body">
                <p>Pilih menu dari sidebar kiri untuk mengelola data sekolah.</p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-box bg-gradient-info">
                            <span class="info-box-icon"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Manajemen Data</span>
                                <span class="info-box-number"><?php echo $total_guru + $total_siswa + $total_kelas + $total_ekstrakulikuler; ?> Items</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>