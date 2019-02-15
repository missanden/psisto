<?php

include "config/koneksi.php";
$q = $_POST["q"];

if($q=='all'){
	$tampil=mysql_query("SELECT *
FROM part_number
INNER JOIN data_erp ON part_number.part_number = data_erp.items
LEFT JOIN stoktaking ON stoktaking.StItem = data_erp.items
AND stoktaking.StWh = data_erp.warehouse");
}

else{
$tampil=mysql_query("SELECT *
FROM part_number
INNER JOIN data_erp ON part_number.part_number = data_erp.items
LEFT JOIN stoktaking ON stoktaking.StItem = data_erp.items
AND stoktaking.StWh = data_erp.warehouse
					 WHERE data_erp.warehouse='$q'");
}

$filename="excelreportthis.xls";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");
		

echo "<table>
		<tr>
			<th width='20%'>WRHS</th>
			<th width='50%'>ITEMS</th>
			<th width='50%'>DESCRIPTION</th>
			<th width='10%'>STOCK ERP</th>
			<th width='10%'>STOCK COUNT</th>
			<th width='10%'>TOTAL TAG</th>
			<th width='10%'>VARIANS</th>
		</tr>";	
	
while ($data = mysql_fetch_array($tampil))
		{echo "<tr>
				<td>$data[warehouse]</td>
				<td>$data[items]</td>
				<td>$data[itemdescription]</td>
				<td>$data[qty]</td>
				<td align='center'>";
				
				$tampil2=mysql_query("SELECT SUM(Stqty) AS sun FROM stoktaking 
					 WHERE stoktaking.StWh='$data[warehouse]' AND stoktaking.StItem='$data[items]'");
				
						while ($data2 = mysql_fetch_array($tampil2))
								$sun=$data2['sun'];
								$san=$sun;
								$amountcount=$data['price']*$san;
							echo "$sun";
							
					
				$tampilan=mysql_query("SELECT  * FROM stoktaking 
				WHERE stoktaking.StWh='$data[warehouse]' AND stoktaking.StItem='$data[items]'
				AND stoktaking.user not in ('')");
				$tagisi=mysql_num_rows($tampilan);
				

				$tampilanfull=mysql_query("SELECT  * FROM stoktaking 
				WHERE stoktaking.StWh='$data[warehouse]' AND stoktaking.StItem='$data[items]'");
				$tagfull=mysql_num_rows($tampilanfull);
				
					$variant=$sun-$data['qty'];
					
					if($variant=='0'){$color="black";}
					else{$color="red";}
				
					
				
				
							
				echo "</td>
				<td align='center'>$tagisi of ($tagfull)</td>
				<td align='center'><font color='$color'>".$variant."</font></td>
				</tr>";		
			}
	echo "</table><br>";
?>