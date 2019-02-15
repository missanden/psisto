<?php
session_start();
include "config/koneksi.php";


$userid = $_POST['userid'];
$pass     = $_POST['password'];



$login=mysql_query("SELECT * FROM user
WHERE user.userid='$userid' AND user.pass='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila no_employee dan password ditemukan
if ($ketemu > 0){
	
  $_SESSION['s_user']     	= $r['userid'];
 header('location:menu.php');
 
}
else{
	
	echo "<script>window.alert('User or Password Failed.'); window.location=('index.php')</script>";

	
}

?>
