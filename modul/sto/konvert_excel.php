<?php
session_start();
ob_start();

include "../../config/koneksi.php";


$tanggalan=date('d-m-Y');

$datetime=date('d-m-Y H:i:sa');

$filename="ReportStockTakeTag-".$tanggalan.".xls";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");

$tampil=mysql_query("SELECT * FROM stoktaking
							 LEFT JOIN leader 
								ON leader.StRack=stoktaking.StRack ORDER BY stoktaking.StId ASC");

echo "<center><font size=+3><b>PSI REPORT STOCK TAKE</b></font><br>
		<center><font size=-1><i>$datetime</i></font></center>

		<table border='1'>
		<tr>
		<th>No.</th>
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
		<th>First update by</th>
		<th>First update on</th>
		<th>Last update by</th>
		<th>Last update on</th>
		</tr>";

$no=1;
		
$row=mysql_num_rows($tampil);
while ($data = mysql_fetch_array($tampil))
		{echo "
			<tr>
			<td>$no</td>
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
			<td>$data[user]</td>";
			
			if($data['first_date']=='0000-00-00 00:00:00'){$firstdate="";}
			else{$firstdate=$data['first_date'];}
			
			if($data['last_date']=='0000-00-00 00:00:00'){$last_date="";}
			else{$last_date=$data['last_date'];}
			
			echo "<td>$firstdate</td>
			<td>$data[last_update]</td>
			<td>$last_date</td>
			</tr>
			";
		$no++;	
			
			}
	echo "</table>";
?>