<html>
<head>
<title>Login Application - PSI Stock Take</title>
<script language="javascript">
function validasi(form){
  if (form.	userid.value == ""){
    alert("Anda belum memilih  Username.");
    form.userid.focus();
    return (false);
  }
     
  if (form.password.value == ""){
    alert("Anda belum mengisikan Password.");
    form.password.focus();
    return (false);
  }
  return (true);
}
</script>
<br>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body OnLoad="document.login.username.focus();">
<div id="header"><center><img src='images/logo.png'></center>
  <div id="content">
	<h2>Login</h2>
    <img src="images/logo-login.png" width="97" height="95" hspace="10" align="left">

<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
<table>
<tr><td>Username</td><td><?php 
include "config/koneksi.php";

echo "<select name='userid' width='30'>
			<option value='' selected> Username </option>";
													
				$tampil=mysql_query("SELECT * FROM user order by userid asc ");
            while($w=mysql_fetch_array($tampil)){
              echo "<option value=$w[0]>$w[0]</option>";
            }
			
													echo "</select>";
?>													</td></tr>
<tr><td>Password</td><td>  <input type="password" name="password"></td></tr>
<tr><td colspan="2"><input type="submit" value="Login"></td></tr>
</table>
</form>
<p>&nbsp;</p>
  </div>
	<div id="footer">
			Copyright &copy; 2015. All rights reserved.
	</div>
</div>
</body>
</html>
