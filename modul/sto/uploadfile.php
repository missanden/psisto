<?php			
include "../../config/excel_reader2.php"; 
include "../../config/koneksi.php";					
	
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);  
//membaca jumlah baris dari data excel  
$baris = $data->rowcount($sheet_index=0);
 
//nilai awal counter jumlah data yang sukses dan yang gagal diimport
 $sukses = 0;
 $gagal = 0;
 
//import data excel dari baris kedua, karena baris pertama adalah nama kolom
 for ($i=2; $i<=$baris; $i++) 
 {  


$spacy="         ";
//membaca data nip (kolom ke-1) 
 $StId = $data->val($i,1); 
 $StRack = $data->val($i,2);
 //membaca data nama depan (kolom ke-2)
 $StLoc = $data->val($i,3);
 //membaca data nama belakang (kolom ke-3)
 $StItem = $data->val($i,4);
 $StDesc = $data->val($i,5);
 $StCustPn = $data->val($i,6);
 $StWh = $data->val($i,7);
 $StUm = $data->val($i,8);
 $StGrp = $data->val($i,9);
 $Stqty = $data->val($i,10);
 
	 
	 
mysql_query("INSERT INTO stocktampung (StId,
									StRack, 
									StLoc, 
									StItem, 
									StDesc, 
									StCustPn, 
									StWh, 
									StUm, 
									StGrp, 
									Stqty
									) 
values ('$StId',
		'$StRack',
		'$StLoc',
		'$StItem',
		'$StDesc',
		'$StCustPn',
		'$StWh',
		'$StUm',
		'$StGrp',
		'$Stqty')");
		
 }
 ?>