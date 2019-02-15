<html>
<head>
<title></title>
<?php

include "config/koneksi.php";
$q = $_POST['q'];


$tanggalan=date('d-m-Y');

$datetime=date('d-m-Y H:i:sa');


$filename="exceltandemerp.xls";
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");


if($q=='all'){
	$tampil=mysql_query("SELECT * FROM data_erp");
}

else{
$tampil=mysql_query("SELECT * FROM data_erp 
					 WHERE data_erp.warehouse='$q'");
}


echo "<center><font size=+3><b>Data ERP vs STO</b></font><br>
<center><font size=-1><i>$datetime</i></font></center>

<table border='1' width='100%'>
		<tr>
			<th>WRHS</th>
			<th>ITEM GROUP</th>
			<th>ITEMS</th>
			<th>DESCRIPTION</th>
			<th>HARGA</th>
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
							
				echo "</td>
				<td>$amountcount</td>
				<td>$variant</td>
				<td>$amountvariant</td>
				</tr>";		
			}
	echo "</table><br>";
?>