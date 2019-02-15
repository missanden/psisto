<?php
session_start();
include "../../config/koneksi.php";
include "../../config/excel_reader2.php"; 


$module=$_GET['module'];
$act=$_GET['act'];


if ($module=='sto' AND $act=='update'){
 
 $date=date('Y-m-d H:i:sa');
 
 if(empty($_POST['user']) and empty($_POST['user_last'])){
mysql_query("UPDATE stoktaking SET Stqty= '$_POST[Stqty]',
								user='$_SESSION[s_user]',
								remarkinputer= '$_POST[remarkinputer]',
								first_date='$date',
								last_date='$date'
							  WHERE StId ='$_POST[StId]'");
 }
 
else {
	mysql_query("UPDATE stoktaking SET Stqty= '$_POST[Stqty]',
								last_update='$_SESSION[s_user]',
								remarkinputer= '$_POST[remarkinputer]',
								last_date='$date'
							  WHERE StId ='$_POST[StId]'");
	
} 
echo "<script>window.alert('Update QTY Berhasil'); window.location=('../../media.php?module=".$module."&act=searchsto')</script>";							  
}


else if ($module=='sto' AND $act=='upload'){
	
	
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
 
 header('location:../../loopdata.php');	
}


else if ($module=='sto' AND $act=='input'){
 
$query=mysql_query("SELECT * FROM stoktaking ORDER BY StId DESC LIMIT 0,1");
$w=mysql_fetch_array($query);

$StId=$w['StId']+1;
$length=strlen($StId);

if($length==1){$StId="000".$StId;}
else if($length==2){$StId="00".$StId;}
else if($length==3){$StId="0".$StId;} 
else if($length==4){$StId=$StId;} 

 

mysql_query("INSERT INTO stoktaking(StId,
									StRack, 
									StLoc, 
									StItem, 
									StDesc, 
									StCustPn, 
									StWh, 
									StUm, 
									StGrp, 
									Stqty, 
									useradd
									) 
					                VALUES
									('$StId',
					                  '$_POST[StRack]',
					                  '$_POST[StLoc]',
					                  '$_POST[StItem]',
					                  '$_POST[StDesc]',
					                  '$_POST[StCustPn]',
					                  '$_POST[StWh]',
					                  '$_POST[StUm]',
					                  '$_POST[StGrp]',
					                  '$_POST[Stqty]',
					                  '$_SESSION[s_user]')");


echo "<script>window.alert('Input Stock Berhasil No. Tag : $StId'); window.location=('../../media.php?module=".$module."&act=inputsto')</script>";						  
}

?>
