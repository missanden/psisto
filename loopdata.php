<?PHP
include "/config/koneksi.php";	

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");

echo "<table border='1' cellspacing='0' cellpadding='0'>";

$tampil=mysql_query("SELECT * FROM stocktampung order by StId");
$row=mysql_num_rows($tampil);
while($data=mysql_fetch_array($tampil)){

$x = 1; 
$no=1;
while($x <= $data['Stqty']){ 	
	
	$query=mysql_query("SELECT * FROM stoktaking ORDER BY StId DESC");
$w=mysql_fetch_array($query);
$row=mysql_num_rows($query);

$StId=$row+1;
$length=strlen($StId);

if($length==1){$StId="000".$StId;}
else if($length==2){$StId="00".$StId;}
else if($length==3){$StId="0".$StId;} 
else if($length==4){$StId=$StId;} 
	
	/*
	echo "<tr>
			<td>$no</td>
			<td>$data[StRack]</td>
			<td>$data[StLoc]</td>
			<td>$data[StItem]</td>
			<td>$data[StDesc]</td>
			<td>$data[StCustPn]</td>
			<td>$data[StWh]</td>
			<td>$data[StUm]</td>
			<td>$data[StGrp]</td>
			<td>$data[Stqty]</td>
			</tr>";*/
			
			
	
mysql_query("INSERT INTO stoktaking(StId,
									StRack,
									StLoc,
									StItem,
									StDesc,
									StCustPn,
									StUm,
									StGrp,
									StWh,
									Stqty
									) 
					                VALUES
							( '$StId',
					                  '$data[StRack]',
					                  '$data[StLoc]',
					                  '$data[StItem]',
					                  '$data[StDesc]',
					                  '$data[StCustPn]',
					                  '$data[StUm]',
					                  '$data[StGrp]',
					                  '$data[StWh]',
					                  '0'
									  )");		
$x++;

}
$no++;
}

mysql_query("DELETE FROM stocktampung");
		
 
echo "<script>window.alert('Upload data berhasil'); window.location=('../../psisto/media.php?module=sto&act=uploadsto')</script>";	



?>

