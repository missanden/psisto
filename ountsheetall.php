<?php


date_default_timezone_set("Asia/Jakarta");

$server = "localhost";
$username = "root";
$password = "PSIak5352016";
$database = "stok_db_mar17";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");



$tanggalan=date('d-m-Y');

$datetime=date('d-m-Y H:i:sa');

$filename="CountSheetInventoryList-".$tanggalan.".xls";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");

$tampil=mysql_query("SELECT * FROM stoktaking
							 LEFT JOIN leader 
								ON leader.StRack=stoktaking.StRack ORDER BY StId ASC");

echo "<center><font size=+3><b>FORM COUNT SHEET INVENTORY LIST</b></font><br>
LEADER : $_POST[leader]
<center><font size=-1><i>$datetime</i></font></center>
		<table border='1' width='800'>
		<tr>
		<th rowspan='2'>No.</th>
		<th rowspan='2'>Leader</th>
		<th rowspan='2'>StId</th>
		<th rowspan='2'>StRack</th>
		<th rowspan='2'>StLoc</th>
		<th rowspan='2'>StItem</th>
		<th rowspan='2'>StDesc</th>
		<th rowspan='2'>StCustPn</th>
		<th rowspan='2'>StWh</th>
		<th rowspan='2'>StUm</th>
		<th rowspan='2'>StGrp</th>
		<th rowspan='2'>StWh</th>
		<th colspan='3'>Count QTY</th>
		</tr>
		<tr>
		<th>Counter</th>
		<th>Verifier</th>
		<th>Final</th>
		</tr>";

		
$no=1;		
$row=mysql_num_rows($tampil);
while ($data = mysql_fetch_array($tampil))
		{echo "
			<tr>
			<td>$no</td>
			<td>$data[leadername]</td>
			<td>$data[StId]</td>
			<td>$data[StRack]</td>
			<td>$data[StLoc]</td>
			<td>$data[StItem]</td>
			<td>$data[StDesc]</td>
			<td>$data[StCustPn]</td>
			<td>$data[StWh]</td>
			<td>$data[StUm]</td>
			<td>$data[StGrp]</td>
			<td>$data[StWh]</td>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			";
			
		$no++;		
			}
	echo "</table>";

?>