<?
// Nama File : popup.php
?>
<html>
<head>
	<title>Sistem Antrian Elektronik</title>
	<script>
	var waktu = 500; // 0.5 Detik

	nilai = null;
	function tutup(){
		nilai = setTimeout("self.close()",waktu);
	}
	</script>

</head>
<body topmargin="0" bottommargin="0" leftmargin=0 rightmargin=0 bgcolor="#FFFFFF" alink=blue vlink=blue link=blue onload="tutup();self.focus()">
<table border="1" cellpadding="0" cellspacing="0" width="180" align=center>
	<tr height="27" style="height:20.25pt">
		<td width="180" style="width: 150pt; font-size: 12.0pt; font-family: Arial, sans-serif; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; border-left: 1.0pt solid windowtext; border-right: 1.0pt solid windowtext; border-top: 1.0pt solid windowtext; border-bottom: medium none; padding-left: 1px; padding-right: 1px; padding-top: 1px">
		<b>SELAMAT DATANG</b><p>No. Antri Anda :</td>
	</tr>
	<tr height="54" style="height: 40.5pt">
		<td height="54" width="200" style="height: 40.5pt; width: 150pt; color: windowtext; font-size: 24.0pt; font-family: 'Arial Black', sans-serif; text-align: center; vertical-align: middle; white-space: normal; font-weight: 400; font-style: normal; text-decoration: none; border: 1.0pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
		</td>
	</tr>
	<tr height="6" style="height: 4.5pt">
		<td width="180" style="height: 56px; width: 150pt; font-family: Arial, sans-serif; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; border-left: 1.0pt solid windowtext; border-right: 1.0pt solid windowtext; border-top: medium none; border-bottom: medium none; padding-left: 1px; padding-right: 1px; padding-top: 1px">
		&nbsp;&quot;Service Advisor Kami&nbsp;&nbsp;&nbsp; Segera Melayani Anda&quot;</td>
	</tr>
	<tr height="9" style="height: 6.75pt">
		<td width="180" style="width: 150pt; font-family: Arial, sans-serif; text-align: center; vertical-align: middle; white-space: normal; color: black; font-size: 9.0pt; font-weight: 400; font-style: normal; text-decoration: none; border-left: 1.0pt solid windowtext; border-right: 1.0pt solid windowtext; border-top: medium none; border-bottom: medium none; padding-left: 1px; padding-right: 1px; padding-top: 1px">
		&nbsp;<p><b>HONDA CIKARANG</b></p>
		Telp. 021-897 4142 / 43&nbsp;</td>
	</tr>
	<tr height="20" style="height:20.25pt">
		<td width="180" style="height: 45px; width: 150pt; font-size: 9.0pt; font-family: Arial, sans-serif; text-align: center; vertical-align: middle; white-space: normal; color: black; font-weight: 400; font-style: normal; text-decoration: none; border-left: 1.0pt solid windowtext; border-right: 1.0pt solid windowtext; border-top: medium none; border-bottom: 1.0pt solid windowtext; padding-left: 1px; padding-right: 1px; padding-top: 1px">
		Tgl/Jam : <p>&nbsp;</td>
	</tr>
</table>
<script language=javascript>
window.print();
</script>
</body>
</html>