<html>
<head>
<title></title>
<script type="text/javascript" src="../nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
 
<?php

include "config/koneksi.php";

$wh = $_POST['wh'];


$tanggalan=date('d-m-Y');

$datetime=date('d-m-Y H:i:sa');

setlocale(LC_MONETARY,"en_US");

/*
$filename="exceltandemerp_$datetime.xls";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");
*/

if($wh=='all'){
	$tampil=mysql_query("SELECT *
FROM part_number
INNER JOIN data_erp ON part_number.part_number = data_erp.items
LEFT JOIN stoktaking ON stoktaking.StItem = data_erp.items
AND stoktaking.StWh = data_erp.warehouse ORDER BY stoktaking.StID ASC");
}

else{
$tampil=mysql_query("SELECT *
FROM part_number
INNER JOIN data_erp ON part_number.part_number = data_erp.items
LEFT JOIN stoktaking ON stoktaking.StItem = data_erp.items
AND stoktaking.StWh = data_erp.warehouse
INNER JOIN master_wh ON data_erp.warehouse=master_wh.StWh
		WHERE master_wh.group_wh='$wh' ORDER BY stoktaking.StID ASC");
}


echo "<center><font size=+3><b>Data ERP vs STO $wh</b></font><br>
<center><font size=-1><i>$datetime</i></font></center>

<table border='1' width='100%'>
		<tr>
			
			<th>WRHS</th>
			<th>ITEM GROUP</th>
			<th>ITEMS</th>
			<th>DESCRIPTION</th>
			<th>PRICE</th>
			<th>UoM</th>
			<th>QTY ERP</th>
			<th>AMOUNT ERP</th>
			<th>QTY STO</th>
			<th>AMOUNT STO</th>
			<th>QTY VAR</th>
			<th>AMOUNT VAR</th>
			
		</tr>";


while ($data = mysql_fetch_array($tampil))
		{echo "<tr>
				
				<td>$data[warehouse]</td>
				<td>$data[group]</td>
				<td>$data[items]</td>
				<td>$data[itemdescription]</td>
				<td>$data[price]</td>
				<td>$data[unit]</td>
				<td align='center'>$data[qty]</td>
				<td>".$data['qty']*$data['price']."</td>
				<td align='center'>";
				
				$tampil2=mysql_query("SELECT SUM(Stqty) AS sun FROM stoktaking 
					 WHERE stoktaking.StWh='$data[warehouse]' AND stoktaking.StItem='$data[items]'");
				
						while ($data2 = mysql_fetch_array($tampil2))
								$sun=$data2['sun'];
								$san=$sun;
								$amountcount=$data['price']*$san;
							
									echo "$sun";
							$variant=$sun-$data['qty'];
							$amountvariant=$variant*$data['price'];
						
					if($variant=='0'){$color="black";}
					else{$color="red";}
					
					
					
				echo "</td>
				<td>$amountcount</td>
				<td><font color='$color'>$variant</font></td>
				<td>$amountvariant</td>
				</tr>";		
			}
	echo "</table><br>";
?>