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


$tampil=mysql_query("SELECT * FROM stoktaking LEFT JOIN data_erp
		ON stoktaking.StItem=data_erp.items");


echo "<center><font size=+3><b>Data STO</b></font><br>
<center><font size=-1><i>$datetime</i></font></center>

<table border='1' width='100%'>
		<tr>
			<th>No. Tag</th>
			<th>WRHS</th>
			<th>ITEM GROUP</th>
			<th>ITEMS</th>
			<th>DESCRIPTION</th>
			<th>Stum</th>
			<th>QTY STO</th>
			<th>Items ERP</th>
			
			
		</tr>";


while ($data = mysql_fetch_array($tampil))
		{echo "<tr>
				<td>$data[StId]</td>
				<td>$data[StWh]</td>
				<td>$data[StGrp]</td>
				<td>$data[StItem]</td>
				<td>$data[StDesc]</td>
				<td>$data[StUm]</td>
				<td>$data[Stqty]</td>
				<td>$data[items]</td>
				</tr>";		
			}
			
			
	echo "</table><br>";
?>