<?php
session_start();

if(!isset($_SESSION['login'])){
  header("location: index.php");
  exit;
}
// koneksi dengan database
require("koneksi.php");
// menampilkan hasil dari database ke halaman
$sql = mysqli_query($koneksi, "SELECT * FROM plus_poin ORDER BY id ASC"); //sesuaikan dengan database

//logic untuk menambah plus poin
if(isset($_POST['simpan'])){
  $nim =  $_POST['nim'];
  $poin = $_POST['poin'];
  $keterangan = htmlspecialchars($_POST['keterangan']);
  $tanggal = $_POST['tanggal'];

  mysqli_query($koneksi, "INSERT INTO plus_poin (nim, poin, keterangan,tanggal) VALUES ('$nim','$poin','$keterangan','$tanggal')");//sesuaikan dengan database
  // return false;
  header("location: pluspoint.php");
  exit;
  
}


//logic untuk mengubah data plus poin yang sudah ada
if(isset($_POST['ubah'])){
  $id = $_POST['id2'];
  $nim =  $_POST['nim2'];
  $poin = $_POST['poin2'];
  $keterangan = htmlspecialchars($_POST['keterangan2']);
  $tanggal = $_POST['tanggal2'];

  $cekplus = mysqli_query($koneksi, "SELECT * FROM plus_poin WHERE id = '$id'"); //sesuaikan dengan database
  
  if(mysqli_num_rows($cekplus) > 0){
    mysqli_query($koneksi, "UPDATE plus_poin SET `nim`='$nim',`poin`='$poin',`keterangan`='$keterangan',`tanggal`='$tanggal' WHERE id = '$id' "); //sesuaikan dengan database
    header("location: pluspoint.php");
    exit;
  }else{
    echo "<script>alert('id tidak sesuai')</script>";
    return false;
  }
}  

// logic untuk pencarian
if(isset($_POST['cari'])){
  $keyword = $_POST['keyword'];
  $hasilcari = mysqli_query($koneksi, "SELECT * FROM plus_poin WHERE nim LIKE '%$keyword%' OR poin LIKE '%$keyword%' OR keterangan LIKE '%$keyword%' OR tanggal LIKE '%$keyword%'");//sesuaikan dengan database
  $sql = $hasilcari;
}

include("sidebar.php");
// exit;

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="/Nazi-Swastika.png" type="image/x-icon">
  <title>Halaman point plus</title>
  

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Plus Point</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard Mahasiswa</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="box-header">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">

                  <div class="fa fa-plus"></div> Tambah Plus Point

                </button>

                <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                  Launch Default Modal
                </button>      -->

              </div>


              <div class="card-tools">
              <form action="" method="post">
                <div class="input-group input-group-sm" style="width: 150px;">
                
                  <input type="text" name="keyword" class="form-control float-right" placeholder="Cari data">

                  <div class="input-group-append">
                    <button type="submit" name= "cari" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">

              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nim</th>
                    <th>Poin</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  
                  if (mysqli_num_rows($sql) == 0) {
                    echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
                  } else { // jika terdapat entri maka tampilkan datanya
                    $no = 1; // mewakili data dari nomor 1
                    while ($row = mysqli_fetch_assoc($sql)) { // fetch query yang sesuai ke dalam array
                      echo '
                            <tr>
                            <td>' . $no . '</td>
                            <td>' . $row['nim'] . '</td>
                            <td>' . $row['poin'] . '</td>
                            <td>' . $row['keterangan'] . '</td>
                            <td>' . $row['tanggal'] . '</td>
                            <td> 
                                <a href="edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-primary"onclick="setModalValues(' . $row['id'] . ', \'' . $row['nim'] . '\', \'' . $row['poin'] . '\', \'' . $row['keterangan'] . '\', \'' . $row['tanggal'] . '\')"
                                >
                                    <div class="fa fa-edit"></div> Edit
                                </a>
                                <a href="" class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#modal-danger" onclick="hapus(' . $row['id'] . ', true)"> 
                                    <div class="fa fa-trash"></div> Delete 
                                </a>
                            </td>
                        </tr>';
                      $no++; // mewakili data kedua dan seterusnya
                    }
                  }
                  ?>


                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah data plus point</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- modal menambah plus poin -->
            <div class="modal-body">
              <form action="" method="post">
              <label for="">NIM</label>
              <input type="number" name="nim" id="nim" class="form-control" placeholder="">

              <label for="poin">Jumlah poin:</label>
              <input type="number" name="poin" id="poin" class="form-control">

              <label for="keterangan">Keterangan :</label>
              <textarea class="form-control" name="keterangan"></textarea>

              <label for="tanggal">Tanggal :</label>
              <input type="date" name="tanggal" id="tanggal" class="form-control">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <!-- modal mengubah plus poin yang sudah ada -->
      </div>
      <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
          <div class="modal-header">
              <h4 class="modal-title">Edit data plus point</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
              <input type="hidden" name="id2" id="id2">

              <label for="">NIM</label>
              <input type="number" name="nim2" id="nim2" class="form-control">

              <label for="poin">Jumlah poin:</label>
              <input type="number" name="poin2" id="poin2" class="form-control">

              <label for="keterangan">Keterangan :</label>
              <textarea class="form-control" name="keterangan2" id="keterangan2"></textarea>

              <label for="tanggal">Tanggal :</label>
              <input type="date" name="tanggal2" id="tanggal2" class="form-control">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- modal untuk peringatan hapus data -->
      <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Peringatan!</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Seluruh data yang terdapat di baris tabel akan ikut terhapus juga!</p>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="hapus.php" method="get">
              <input type="hidden" name="id_to_delete" id="id3">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-outline-light" name="yakin">Hapus</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <script>

    // menampilkan pengiriman data dari edit kedalam form modal    
    function setModalValues(id, nim, poin, keterangan, tanggal) {
   
        document.getElementById('id2').value = id;
        document.getElementById('nim2').value = nim;
        document.getElementById('poin2').value = poin;
        document.getElementById('keterangan2').value = keterangan;
        document.getElementById('tanggal2').value = tanggal;
        
    }
</script>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <script>
    function hapus(id, hasil){
      if(hasil == true){
        document.getElementById('id3').value = id;
        $('#modal-danger').modal('hide');
        return true;

      }else{
        return false;
      }
    }

  </script>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>