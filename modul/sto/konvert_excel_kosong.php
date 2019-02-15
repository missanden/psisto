<?php
session_start();
ob_start();

include "../../config/koneksi.php";


$tanggalan=date('d-m-Y');

$datetime=date('d-m-Y H:i:sa');

$filename="ReportStockKosong-".$tanggalan.".xls";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");

$tampil=mysql_query("SELECT * FROM stoktaking
							 LEFT JOIN leader 
								ON leader.StRack=stoktaking.StRack 
						WHERE stoktaking.USER='' ORDER BY stoktaking.StId ASC");

echo "<center><font size=+3><b>PSI REPORT STOCK TAKE</b></font><br>
		<center><font size=-1><i>$datetime</i></font></center>

		<table border='1'>
		<tr>
		<th>StId</th>
		<th>StRack</th>
		<th>StLoc</th>
		<th>StItem</th>
		<th>StDesc</th>
		<th>StCustPn</th>
		<th>StWh</th>
		<th>StUm</th>
		<th>StGrp</th>
		<th>StWh</th>
		<th>Stqty</th>
		<th>Leader</th>
		<th>USER</th>
		</tr>";

$row=mysql_num_rows($tampil);
while ($data = mysql_fetch_array($tampil))
		{echo "
			<tr>
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
			<td>$data[Stqty]</td>
			<td>$data[leadername]</td>
			<td>$data[user]</td>
			</tr>";
			}
	echo "</table>";
?>