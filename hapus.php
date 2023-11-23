<?php
require 'koneksi.php';



if(isset($_GET['yakin'])){
$id =  $_GET['id_to_delete'];
mysqli_query($koneksi, "DELETE FROM plus_poin WHERE id =  '$id'");
echo "<script>window.location.href = 'pluspoint.php'</script>";
exit;
}else{
    return false;
}


?>