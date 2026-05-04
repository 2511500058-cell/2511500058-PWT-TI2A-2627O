<?php

  if(!isset($_SESSION["username"])) {
      header("location:login.php");
      exit();
  }

  if(isset($_POST['ganti'])) {
      $username = $_SESSION['username'];
      $PasswordBaru = $_POST['PasswordBaru'];

      if(empty($PasswordBaru)) {
          $error = "Password baru tidak boleh kosong!";
      } else {
         
          $update = mysqli_query($koneksi, "UPDATE tbl_users SET password = '$PasswordBaru' WHERE username = '$username'");
          
          if($update) {
              echo "<script>alert('Password berhasil diubah! Silakan lanjutkan.'); window.location.href='index.php';</script>";
          } else {
              $error = "Gagal merubah password!";
          }
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ganti Password</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-warning">
    <div class="card-header text-center">
      <h2><b>Wajib</b> Ganti Password</h2>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Karena Anda menggunakan password default, demi keamanan silakan ganti password Anda.</p>
      
      <?php if(isset($error)) { echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="password" name="PasswordBaru" class="form-control" placeholder="Masukkan Password Baru" required>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="ganti" class="btn btn-warning btn-block">Ganti Password & Lanjutkan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>