<html>
<head>
<title></title>

<link href="style5.css" rel="stylesheet" type="text/css" />
</head>
<body>
 
<div id="header"><center><img src='images/logo.png'></center>
 <div id="content">
 
<?php

include "config/koneksi.php";

$date=date('d-m-Y H:i:sa');

$total_qty_erp=0;
$total_amount_erp=0;
$total_qty_take=0;
$total_amount_take=0;
$total_qty_var=0;
$total_amount_var=0;




echo "<center><font size='+2'><b>PSI STOKE TAKE MARET 2016 RESULT</b></font><br>
		$date <br>
	
<form method='POST'  action='export_excel_result.php'> 
<input type='submit' value='CONVERT TO EXCEL THIS'></form><br><br>	
	

	<table border='1' cellspacing='0' cellpadding='0' width='95%'>
	<tr align='center'>
	<th rowspan='2'>Description</th>
	<td colspan='2' bgcolor='#dc29f1'><font color='white'><b>ERP</b></font></td>
	<td colspan='2' bgcolor='#0b915a'><font color='white'><b>Stoke Take Result</b></font></td>
	<td colspan='3' bgcolor='#f5a44d'><font color='white'><b>Variance</b></font></th>
	<th rowspan='2'>Detail</th>
	</tr>
	
	<tr align='center'>
	<td bgcolor='#dc29f1'><font color='white'><b>Qty</b></font></th>
	<td bgcolor='#dc29f1'><font color='white'><b>Amount</b></font></th>
	<td bgcolor='#0b915a'><font color='white'><b>Qty</b></font></th>
	<td bgcolor='#0b915a'><font color='white'><b>Amount</b></font></th>
	<td bgcolor='#f5a44d'><font color='white'><b>Qty</b></font></th>
	<td bgcolor='#f5a44d'><font color='white'><b>Amount</b></font></th>
	<td bgcolor='#f5a44d'><font color='white'><b>%</b></font></td>
	</tr>";
	
	
	
//=================================VIEW RESULT======================================	
$tampil=mysql_query("SELECT * FROM master_wh WHERE group_wh NOT IN ('-') GROUP BY group_wh ASC");
while ($data = mysql_fetch_array($tampil)){


//===========================RESULT ERP==========================================
$sql1 = "SELECT SUM(data_erp.qty) AS qty_erp_result,
		SUM(data_erp.qty * data_erp.price) AS amount_erp_result
		
 FROM data_erp INNER JOIN master_wh ON data_erp.warehouse=master_wh.StWh
  
 WHERE master_wh.group_wh IN ('$data[group_wh]')";

$result1 = mysql_query($sql1);

while($row1 = mysql_fetch_array($result1)){

    $qty_erp_result = $row1['qty_erp_result'];
    $amount_erp_result = $row1['amount_erp_result'];

}



//===========================================RESULT STOKE TAKE========================

$sql6 = "SELECT SUM(stoktaking.stqty) AS qty_take_result,
	SUM(stoktaking.stqty * data_erp.price) AS amount_take_result
	
 FROM data_erp INNER JOIN stoktaking ON data_erp.items=stoktaking.StItem 
		INNER JOIN master_wh ON stoktaking.StWh=master_wh.StWh
 
 WHERE master_wh.group_wh IN ('$data[group_wh]')";

$result6 = mysql_query($sql6);

while($row6 = mysql_fetch_array($result6)){

    $qty_take_result = $row6['qty_take_result'];
    $amount_take_result = $row6['amount_take_result'];

}

$varqtyresult=$qty_take_result-$qty_erp_result;
$varamountresult=$amount_take_result-$amount_erp_result;

if($amount_take_result==0){$persentase_result="";} else{
$persentase_result=($amount_take_result/$amount_erp_result)*100;
}

//====================================view result=======================================	
echo "<tr align='right'>
	<td align='left'>#$data[group_wh]</td>
	
	<td bgcolor='#fce5ff'>". number_format($qty_erp_result, 2)."</td>
	<td bgcolor='#fce5ff'>". number_format($amount_erp_result, 2)."</td>
	<td bgcolor='#e2fff3'>". number_format($qty_take_result, 2)."</td>
	<td bgcolor='#e2fff3'>". number_format($amount_take_result, 2)."</td>
	<td bgcolor='#fcdbb7'>". number_format($varqtyresult, 2)."</td>
	<td bgcolor='#fcdbb7'>". number_format($varamountresult, 2)."</td>
	<td bgcolor='#fcdbb7'>". round((100-$persentase_result)*(-1), 2)  ." %</td>
	<td>";
	
	echo "<form action='detail_result.php' target='_blank' method='POST'>
	<input type='hidden' name='wh' value='$data[group_wh]'>
	<input type='image' src='images/detail.png'  width='72' height='24'>
	</form>
	
	</td>
	</tr>";	
	
	$total_qty_erp=$total_qty_erp+$qty_erp_result;
	$total_amount_erp=$total_amount_erp+$amount_erp_result;
	$total_qty_take=$total_qty_take+$qty_take_result;
	$total_amount_take=$total_amount_take+$amount_take_result;
	$total_qty_var=$total_qty_var+$varqtyresult;
	$total_amount_var=$total_amount_var+$varamountresult;
}
	
	if($total_amount_take==0){$totalpersentase_result="";} else{
	$totalpersentase_result=($total_amount_take/$total_amount_erp)*100;
	//$totalpersentase_result=$totalpersentase_result-100);
	}
	

	
	echo "<tr align='right' bgcolor='#c2c9ce'>
	<td align='left'><b>Total</b></td>
	
	<td><b>". number_format($total_qty_erp, 2)  ."</b></td>
	<td><b>". number_format($total_amount_erp, 2)  ."</b></td>
	<td><b>". number_format($total_qty_take, 2)  ."</b></td>
	<td><b>". number_format($total_amount_take, 2)  ."</b></td>
	<td><b>". number_format($total_qty_var, 2)  ."</b></td>
	<td><b>". number_format($total_amount_var, 2)  ."</b></td>
	<td><b>". round((100-$totalpersentase_result)*(-1), 2)  ." %</b></td>
	<td>";
	
	echo "<form action='detail_result.php' target='_blank' method='POST'>
	<input type='hidden' name='wh' value='all'>
	<input type='image' src='images/detail.png'  width='72' height='24'>
	</form></td>
	</tr>";
		
	$netaccurasi=(100-$totalpersentase_result)*(-1);
	if($netaccurasi>0){$netaccurasi=100-$netaccurasi;}
	else if ($netaccurasi<0){$netaccurasi=100+$netaccurasi;}
	else {$netaccurasi=0;}
	//$netaccurasi=
	
	echo "<tr>
	<td>Nett Amount</td>
	<td colspan='10' align='center'><font color='red'><b><i>". number_format($total_amount_var, 2)  ."</b></i></td>
	</tr>
	
	<tr>
	<td>Nett Var %</td>
	<td colspan='10' align='center'><font color='red'><b><i>". round((100-$totalpersentase_result)*(-1), 2)  ."%</b></i></td>
	</tr>
	
	
	<tr>
	<td>Nett Accuracy</td>
	<td colspan='10' align='center'><font color='red'><b><i>". round($netaccurasi, 2)  ."%</b></i></td>
	</tr>
	
	</table><br><br>";
	
	

echo "<center><font size='+2'>
	<table border='1' cellspacing='0' cellpadding='0' width='95%'>
	<tr align='center'>
	<th rowspan='2'>Warehouse</th>
	<td colspan='2' bgcolor='#dc29f1'><font color='white'><b>ERP</b></font></td>
	<td colspan='2' bgcolor='#0b915a'><font color='white'><b>Stoke Take Result</b></font></td>
	<td colspan='3' bgcolor='#f5a44d'><font color='white'><b>Variance</b></font></th>
	</tr>
	
	<tr align='center'>
	<td bgcolor='#dc29f1'><font color='white'><b>Qty</b></font></th>
	<td bgcolor='#dc29f1'><font color='white'><b>Amount</b></font></th>
	<td bgcolor='#0b915a'><font color='white'><b>Qty</b></font></th>
	<td bgcolor='#0b915a'><font color='white'><b>Amount</b></font></th>
	<td bgcolor='#f5a44d'><font color='white'><b>Qty</b></font></th>
	<td bgcolor='#f5a44d'><font color='white'><b>Amount</b></font></th>
	<td bgcolor='#f5a44d'><font color='white'><b>%</b></font></td>
	</tr>";
	

//===========================view date per warehouse=====================
//$tampil=mysql_query("SELECT * FROM master_wh WHERE group_wh NOT IN ('-') ORDER BY StWh ASC");
$tampil=mysql_query("SELECT * FROM master_wh ORDER BY StWh ASC");
while ($data = mysql_fetch_array($tampil)){
	
//erp data per warehouse======================================================	
$sql1 = "SELECT SUM(data_erp.qty) AS qty_erp_wh,
		SUM(data_erp.qty * data_erp.price) AS amount_wh_erp
 FROM data_erp WHERE data_erp.warehouse IN ('$data[StWh]')";

$result1 = mysql_query($sql1);

while($row1 = mysql_fetch_array($result1)){

    $qty_erp_wh = $row1['qty_erp_wh'];
    $amount_wh_erp = $row1['amount_wh_erp'];

}


//real data stock count======================================================
$sql6 = "SELECT SUM(stoktaking.stqty) AS qty_take_wh,
	SUM(stoktaking.stqty * data_erp.price) AS amount_take_wh
	
 FROM data_erp INNER JOIN stoktaking ON data_erp.items=stoktaking.StItem 
 
 WHERE stoktaking.StWh IN ('$data[StWh]')";

$result6 = mysql_query($sql6);

while($row6 = mysql_fetch_array($result6)){

    $qty_take_wh = $row6['qty_take_wh'];
    $amount_take_wh = $row6['amount_take_wh'];

}


$varqtywh=$qty_take_wh-$qty_erp_wh;
$varamountwh=$amount_take_wh-$amount_wh_erp;

if($amount_take_wh==0){$persentase_wh="";} else{
$persentase_wh=($amount_take_wh/$amount_wh_erp)*100;
}


	if($persentase_wh>0){$persentase_wh=100-$persentase_wh;}
	else if ($persentase_wh<0){$persentase_wh=100+$persentase_wh;}
	else {$persentase_wh=0;}

//view=========================================================================
	
	echo "<tr align='right'>
		<td align='left'>$data[StWh]</td>
		<td bgcolor='#fce5ff'>". number_format($qty_erp_wh, 2)  ."</td>
		<td bgcolor='#fce5ff'>". number_format($amount_wh_erp, 2)  ."</td>
		<td bgcolor='#e2fff3'>". number_format($qty_take_wh, 2)  ."</td>
		<td bgcolor='#e2fff3'>". number_format($amount_take_wh, 2)  ."</td>
		<td bgcolor='#fcdbb7'>". number_format($varqtywh, 2)  ."</td>
		<td bgcolor='#fcdbb7'>". number_format($varamountwh, 2)  ."</td>
		<td bgcolor='#fcdbb7'>". round($persentase_wh*(-1), 2)  ." %</td>
		</tr>";
	
	
}	
	
	
	echo "</table><br>";	
?>
</div>
<div id="footer">
			PT Sanden Indonesia | Copyright &copy; 2015
		</div>
</div>