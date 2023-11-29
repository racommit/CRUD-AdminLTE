<?php
require("koneksi.php");

if (!empty($_POST))
{
 
$nama = $_POST['nama'];
$username = $_POST['username'];
$email = $_POST['email'];
$hp = $_POST['hp'];
$password = $_POST['pass'];
$gambar = upload();

// cek apakah gambar berhasil atau tidak
if(!$gambar){
  echo "<script>alert('data gagal ditambah yang disebabkan oleh gambar')</script>";
  return false;
}

$sql = mysqli_query ($koneksi,"INSERT INTO tb_user (nama, username, password, no_hp, email, gambar) VALUES ('".$nama."','".$username."','".$password."','".$hp."','".$email."','".$gambar."')");

if (!$sql) 
 {
    die ('Invalid query: '.mysqli_error($conn));
} 
else {
    echo("<script> window.location.href = 'index.php'; </script>");
}

}

function upload(){
  $name = $_FILES['gambar']['name'];
  $tmpName = $_FILES['gambar']['tmp_name'];
  $error = $_FILES['gambar']['error'];
  $size = $_FILES['gambar']['size'];

  if($error == 4){
    echo("<script>alert('Gambar belum ditambahkan')</script>");
    return false;
  }

  $ekstensiValid = ['jpg','jpeg','png'];
  $ekstensiFile = explode('.',$name);
  $ekstensiFile = strtolower(end($ekstensiFile));

  if(!in_array($ekstensiFile,$ekstensiValid)){
    echo("<script>alert('Yang anda upload bukan gambar')</script>");
    return false;
  }


  if($size > 2000000){
    echo("<script>alert('Ukuran gambar terlalu besar')</script>");
    return false;
  }
  $namaFileBaru = uniqid();
  $namaFileBaru .= ".";
  $namaFileBaru .= $ekstensiFile;
  move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
  return $namaFileBaru;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-plus"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="No HP" name="hp">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="file" class="form-control" placeholder="Gambar" name="gambar">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-file"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="pass2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.html" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
