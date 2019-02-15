<link href="style2.css" rel="stylesheet" type="text/css">
<?php

include "config/koneksi.php";
$q = $_REQUEST["q"];

if($q=='all'){
	$tampil=mysql_query("SELECT *
FROM part_number
INNER JOIN data_erp ON part_number.part_number = data_erp.items");
}

else{
$tampil=mysql_query("SELECT *
FROM part_number
INNER JOIN data_erp ON part_number.part_number = data_erp.items
 WHERE data_erp.warehouse='$q'");
}


echo "<table><td><form method='POST' target='_blank' action='exceltandem2.php'> 
<input type='hidden' value='$q' name='q'>
<input type='submit' value='CONVERT TO EXCEL'></form></td>";



echo "<td><form method='POST' target='_blank' action='exceltandem.php'> 
<input type='hidden' value='$q' name='q'>
<input type='submit' value='DETAIL TO SYSTEM'></form></td></table><br>";

echo "<form method='POST'  action='excelreportthis.php'> 
<input type='hidden' value='$q' name='q'>
<input type='submit' value='CONVERT TO EXCEL THIS'></form>";

echo "<table border=1>
		<tr>
			<th width='10%'>WRHS</th>
			<th width='30%'>ITEMS</th>
			<th width='30%'>DESCRIPTION</th>
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
							echo "<form method='POST' target='_blank' action='detailtandemerp.php'>  
										<input type='hidden' value='$data[warehouse]' name='warehouse'>
										<input type='hidden' value='$data[items]' name='items'>
										<input type='submit' class='detail' value='$sun'></form>";
							
					
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