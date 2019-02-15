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

$tampil=mysql_query("SELECT * FROM data_erp ");
	
	echo "<table border='1'>
		<tr>
		<th>StId</th>
		<th>StWh</th>
		<th>StRack</th>
		<th>StLoc</th>
		<th>StItem</th>
		<th>StDesc</th>
		<th>StCustPn</th>
		<th>StGrp</th>
		<th>StWh</th>
		<th>Stqty count</th>
		<th>Stqty erp</th>
		<th>var</th>
		<th>StUm</th>
		<th>amount count</th>
		<th>Leader</th>
		<th>User</th>
		<th>Last Update By</th>
		</tr>";
		
		
	while ($data = mysql_fetch_array($tampil))
		{
			$tampil2=mysql_query("SELECT * FROM stoktaking 
					LEFT JOIN leader 
								ON leader.StRack=stoktaking.StRack
					 WHERE stoktaking.StWh='$data[warehouse]' AND stoktaking.StItem='$data[items]'");
			
		while ($data2 = mysql_fetch_array($tampil2))
		{
			if($data2['Stqty']==$data['qty'])
			{}
			else{
			
			$varian=$data2['Stqty']-$data['qty'];	
			$amountcount=$data2['Stqty']*$data['price'];	
				
			echo "<tr>
			<td>$data2[StId]</td>
			<td>$data2[StWh]</td>
			<td>$data2[StRack]</td>
			<td>$data2[StLoc]</td>
			<td>$data2[StItem]</td>
			<td>$data2[StDesc]</td>
			<td>$data2[StCustPn]</td>
			<td>$data2[StGrp]</td>
			<td>$data2[StWh]</td>
			<td>$data2[Stqty]</td>
			<td>$data[qty]</td>
			<td>$varian</td>
			<td>$data2[StUm]</td>
			<td>$amountcount</td>
			<td>$data2[leadername]</td>
			<td>$data2[user]</td>
			<td>$data2[last_update]</td>
			</tr>
			";
			}
			
			}
			}
	echo "</table>";	

?>