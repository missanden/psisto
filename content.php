<?php
include "config/koneksi.php";

if ($_GET['module']=='sto'){
  include "modul/sto/sto.php";
}
else if ($_GET['module']=='update'){
  include "modul/sto/update.php";
}


// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
