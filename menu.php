<?PHP
session_start();
?>
<html>
<head>
<title></title>
<script type="text/javascript" src="../nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
</script>
<link href="style1.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header"><center><img src='images/logo.png'></center>
  <div id="content">
  
<?php  
ECHO "<h3>You are login as: ".$_SESSION['s_user']."<br><b><a href='logout.php'>Logout</a></b></h3>";
?>
<br>
<br>

<?php

if ($_SESSION['s_user']=='terasaki' or $_SESSION['s_user']=='iwan' or $_SESSION['s_user']=='deby'){}
else {
echo "<center>
<table class='noborder' cellspacing='0' celpadding='0'>
		<tr>";
			if ($_SESSION['s_user']=='dimas' or $_SESSION['s_user']=='deni' or $_SESSION['s_user']=='rini' or $_SESSION['s_user']=='bayu')  
			{
			echo "<td align='center'><a href='media.php?module=sto&act=uploadsto'><img src='images/database.png' width='100px' height='100px'></img></a></li></td>";
			echo "<td align='center'><a href='media.php?module=sto&act=printsto'><img src='images/printer.png' width='100px' height='100px'></img></a></li></td>";}
			echo "<td align='center'><a href='media.php?module=sto&act=searchsto'><img src='images/input.png' width='100px' height='100px'></img></a></li></td>";
			
			if ($_SESSION['s_user']=='dimas' or $_SESSION['s_user']=='deni' or $_SESSION['s_user']=='rini' or $_SESSION['s_user']=='bayu')  
			{
			echo "<td align='center'><a href='media.php?module=sto&act=inputsto' target='_blank'><img src='images/tag.png' width='100px' height='100px'></img></a></li></td>";
			}
			
			echo "<td align='center'><a href='modul/sto/konvert_excel_kosong.php' target='_blank'><img src='images/tagkosong.png' width='100px' height='100px'></img></a></li></td>
		</tr>		


		<tr>";
		if ($_SESSION['s_user']=='dimas' or $_SESSION['s_user']=='deni' or $_SESSION['s_user']=='rini' or $_SESSION['s_user']=='bayu')  
		{
		ECHO "<td align='center'>Upload Tag</td><td align='center'>Print Tag</td>";}
			ECHO "<td align='center'>Input Stock Tag</td>";
			if ($_SESSION['s_user']=='dimas' or $_SESSION['s_user']=='deni' or $_SESSION['s_user']=='rini' or $_SESSION['s_user']=='bayu')  
			{
				
			echo "
			<td align='center'>Add Additional Tag</td>";}
			
			echo "<td align='center'>Outstanding Tag</td>
		</tr>

</table></center><br>";}
		
//=========================================menu bawah===============================================================		

echo "<center>
<table class='noborder' cellspacing='0' celpadding='0'>
		<tr>";
			if ($_SESSION['s_user']=='dimas' or $_SESSION['s_user']=='deni' or $_SESSION['s_user']=='rini' or $_SESSION['s_user']=='terasaki' or $_SESSION['s_user']=='iwan' or $_SESSION['s_user']=='deby' or $_SESSION['s_user']=='bayu')  
			{echo "<td align='center'><a href='media.php?module=sto&act=reportsto' target='_blank'><img src='images/report.png' width='100px' height='100px'></img></a></li></td>
		<td align='center'><a href='/psisto/tandemerp.php'><img src='images/erpvreal.png' width='100px' height='100px'></img></a></li></td>
		<td align='center'><a href='/psisto/leadertag.php'><img src='images/tagcontrol.png' width='100px' height='100px'></img></a></li></td>
		<td align='center'><a href='/psisto/result2.php'><img src='images/tagdate.png' width='100px' height='100px'></img></a></li></td>";
		}
			
			
			
			
			
		echo "</tr><tr>";
		if ($_SESSION['s_user']=='dimas' or $_SESSION['s_user']=='deni' or $_SESSION['s_user']=='rini' or $_SESSION['s_user']=='terasaki' or $_SESSION['s_user']=='iwan' or $_SESSION['s_user']=='deby' or $_SESSION['s_user']=='bayu')  
			{
		ECHO "<td align='center'>Data Report</td>
		<td align='center'>ERP V Stoke Count</td>
		<td align='center'>Daily Cntr. Tag</td>
		<td align='center'>Result per Cut Off</td>";
		}
		
			
		echo "</tr>

		</table></center><br>";		
		
?>

  </div>
		<div id="footer">
			Copyright &copy; 2015. All rights reserved.
		</div>
</div>
</body>
</html>