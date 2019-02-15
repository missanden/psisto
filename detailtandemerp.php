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


 echo "<h2>Detail for $_POST[items] on $_POST[warehouse]</h2>";
	
	$tampil2=mysql_query("SELECT * FROM stoktaking 
					LEFT JOIN leader 
								ON leader.StRack=stoktaking.StRack
					 WHERE stoktaking.StWh='$_POST[warehouse]' AND stoktaking.StItem='$_POST[items]'");
	
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
		<th>Stqty</th>
		<th>StUm</th>
		<th>Leader</th>
		<th>User</th>
		<th>Last Update By</th>
		</tr>";
		
		
	while ($data = mysql_fetch_array($tampil2))
		{echo "
			<tr>
			<td>$data[StId]</td>
			<td>$data[StWh]</td>
			<td>$data[StRack]</td>
			<td>$data[StLoc]</td>
			<td>$data[StItem]</td>
			<td>$data[StDesc]</td>
			<td>$data[StCustPn]</td>
			<td>$data[StGrp]</td>
			<td>$data[StWh]</td>
			<td>$data[Stqty]</td>
			<td>$data[StUm]</td>
			<td>$data[leadername]</td>
			<td>$data[user]</td>
			<td>$data[last_update]</td>
			</tr>
			";
			}
	echo "</table>";	

?>