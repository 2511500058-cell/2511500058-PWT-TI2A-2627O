<?php
// Tambahkan kode ini di baris paling atas file tambah_guru.php
if ($role != 'admin') {
    echo "<script>alert('Akses Ditolak! Halaman ini hanya dapat diakses oleh Admin.'); window.location.href='index.php?page=guru';</script>";
    exit;
}

if(isset($_POST['simpan'])) {
// ... sisa kode milik Anda ke bawah tetap sama ...