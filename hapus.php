<?php
require 'koneksi.php';

$id =  $_GET['id'];
mysqli_query($koneksi, "DELETE FROM plus_poin WHERE id =  '$id'");
echo "<script>window.location.href = 'pluspoint.php'</script>";
exit;


?>