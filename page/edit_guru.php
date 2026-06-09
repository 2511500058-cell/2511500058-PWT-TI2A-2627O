<?php
// Tambahkan kode ini di baris paling atas file edit_guru.php
if ($role != 'admin') {
    echo "<script>alert('Akses Ditolak! Halaman ini hanya dapat diakses oleh Admin.'); window.location.href='index.php?page=guru';</script>";
    exit;
}

$kd = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE kd_guru='$kd'");
$data = mysqli_fetch_array($query);
// ... sisa kode milik Anda ke bawah tetap sama ...