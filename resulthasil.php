<html>
<head>
<title></title>

<link href="style6.css" rel="stylesheet" type="text/css" />
</head>
<body>
 
<div id="header"><center><img src='images/logo.png'></center>
 <div id="content">
 
<?php

include "config/koneksi.php";




$total_qty_erp=0;
$total_amount_erp=0;
$total_qty_take=0;
$total_amount_take=0;
$total_qty_var=0;
$total_amount_var=0;
$total_excess_var=0;
$total_short_var=0;
$total_gross_var=0;

$date=$_POST['year']."-".$_POST['month']."-".$_POST['date']." ".$_POST['hour'];
$date2=$_POST['date']."-".$_POST['month']."-".$_POST['year']." ".$_POST['hour'];




echo "<center><font size='+2'><b>PSI - STOCK TAKE MARCH 2017 RESULT</b></font><br>
		Cut Off $date2 <br>
	
<form method='POST'  action='resulthasil.php'> 
<b>Date </b><select name='date'>
				<option value='01'>01</option>
				<option value='02'>02</option>
				<option value='03'>03</option>
				<option value='04'>04</option>
				<option value='05'>05</option>
				<option value='06'>06</option>
				<option value='07'>07</option>
				<option value='08'>08</option>
				<option value='09'>09</option>
				<option value='10'>10</option>
				<option value='11'>11</option>
				<option value='12'>12</option>
				<option value='13'>13</option>
				<option value='14'>14</option>
				<option value='15'>15</option>
				<option value='16'>16</option>
				<option value='17'>17</option>
				<option value='18'>18</option>
				<option value='19'>19</option>
				<option value='20'>20</option>
				<option value='21'>21</option>
				<option value='22'>22</option>
				<option value='23'>23</option>
				<option value='24'>24</option>
				<option value='25'>25</option>
				<option value='26'>26</option>
				<option value='27'>27</option>
				<option value='28'>28</option>
				<option value='29'>29</option>
				<option value='30'>30</option>
				<option value='31'>31</option>
			</select>Month
			<select name='month'>
				<option value='01'>Januari</option>
				<option value='02'>Februari</option>
				<option value='03'>Maret</option>
				<option value='04'>April</option>
				<option value='05'>Mei</option>
				<option value='06'>Juni</option>
				<option value='07'>Juli</option>
				<option value='08'>Agustus</option>
				<option value='09'>Sepetember</option>
				<option value='10'>Oktober</option>
				<option value='11'>November</option>
				<option value='12'>Desember</option>
			</select>Year
			<select name='year'>
				<option value='2017'>2017</option>
				<option value='2018'>2018</option>
				<option value='2019'>2019</option>
				</select>
			
			
			<b>Time</b>
			<select name='hour'>
				<option value='07:00:00'>07:00</option>
				<option value='08:00:00'>08:00</option>
				<option value='09:00:00'>09:00</option>
				<option value='10:00:00'>10:00</option>
				<option value='11:00:00'>11:00</option>
				<option value='12:00:00'>12:00</option>
				<option value='13:00:00'>13:00</option>
				<option value='14:00:00'>14:00</option>
				<option value='15:00:00'>15:00</option>
				<option value='16:00:00'>16:00</option>
				<option value='17:00:00'>17:00</option>
				
			</select>
			

<input type='submit' value='Search'></form><br><br>	
	

	<table border='1' cellspacing='0' cellpadding='0' width='95%'>
	<tr align='center'>
	<th rowspan='2'>Description</th>
	<td colspan='2' bgcolor='#dc29f1'><font color='white'><b>ERP</b></font></td>
	<td colspan='2' bgcolor='#0b915a'><font color='white'><b>Stoke Take Result</b></font></td>
	<td colspan='3' bgcolor='#f5a44d'><font color='white'><b>Variance</b></font></th>
	<th rowspan='2'>Stock Accuracy</th>
	<th rowspan='2'>Excess Var</th>
	<th rowspan='2'>Short Var</th>
	<th rowspan='2'>Gross Var</th>
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
/*
//============================================cara 1
$amount_take_result=0;
$qty_take_result=0;

$sql6 = "SELECT *
 FROM stoktaking INNER JOIN master_wh ON stoktaking.StWh=master_wh.StWh
 WHERE master_wh.group_wh IN ('$data[group_wh]')";
$result6 = mysql_query($sql6);

while($row6 = mysql_fetch_array($result6)){

$qty_take_result1 = $row6['Stqty'];


			$tampil2=mysql_query("SELECT * FROM data_erp 
					 WHERE data_erp.warehouse='$row6[StWh]' AND data_erp.items='$row6[StItem]'");
				
						while ($data2 = mysql_fetch_array($tampil2)){
						
							
							
								$amountcount=$data2['price']*$row6['Stqty'];
						}

$amount_take_result=$amountcount+$amount_take_result;	
$qty_take_result=$qty_take_result+$qty_take_result1;

}

*/

$amount_take_result=0;
$qty_take_result=0;
$excesvariance=0;
$shortvariance=0;
$gross=0;

$tampilan=mysql_query("SELECT * FROM data_erp INNER JOIN master_wh ON data_erp.warehouse=master_wh.StWh
		WHERE master_wh.group_wh='$data[group_wh]'");

while ($data3 = mysql_fetch_array($tampilan))
		{
			$tampil2=mysql_query("SELECT SUM(Stqty) AS sun FROM stoktaking 
					 WHERE stoktaking.StWh='$data3[warehouse]' AND stoktaking.StItem='$data3[items]' AND
					 stoktaking.last_date <= '$date'");
				
						while ($data2 = mysql_fetch_array($tampil2)){
								$sun=$data2['sun'];
								$san=$sun;
								$amountcount=$data3['price']*$san;
								
								$variant=$sun-$data3['qty'];
								$amountvariant=$variant*$data3['price'];
								
						if($amountvariant<0)
							{
							$excesvariance1=0;
							$shortvariance1=$amountvariant;
							$gross1=abs($amountvariant);
							}
						else {
							$excesvariance1=$amountvariant;
							$shortvariance1=0;
							$gross1=abs($amountvariant);
						}
						
						}
						
			$amount_take_result=$amountcount+$amount_take_result;	
			$qty_take_result=$qty_take_result+$sun;
			
			$excesvariance=$excesvariance+$excesvariance1;
			$shortvariance=$shortvariance+$shortvariance1;
			$gross=$gross+$gross1;
	
				
			
		}
		
//===========================================================================================


$varqtyresult=$qty_take_result-$qty_erp_result;
$varamountresult=$amount_take_result-$amount_erp_result;

if($amount_take_result==0){$persentase_result="";} else{
$persentase_result=($amount_take_result/$amount_erp_result)*100;
}


$persen=(100-$persentase_result)*(-1);
$accuracystock=100-abs($persen);

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
	<td bgcolor=''>". round($accuracystock, 2)  ." %</td>
	<td bgcolor=''>". number_format($excesvariance, 2)."</td>
	<td bgcolor=''>". number_format($shortvariance, 2)."</td>
	<td bgcolor=''>". number_format($gross, 2)."</td>
	
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
	
	$total_excess_var=$total_excess_var+$excesvariance;
	$total_short_var=$total_short_var+$shortvariance;
	$total_gross_var=$total_gross_var+$gross;
	
}
	
	if($total_amount_take==0){$totalpersentase_result="";} else{
	$totalpersentase_result=($total_amount_take/$total_amount_erp)*100;
	//$totalpersentase_result=$totalpersentase_result-100);
	}
	
$persen=(100-$totalpersentase_result)*(-1);
$totalaccuracystock=100-abs($persen);
	
	echo "<tr align='right' bgcolor='#c2c9ce'>
	<td align='left'><b>Total</b></td>
	
	<td><b>". number_format($total_qty_erp, 2)  ."</b></td>
	<td><b>". number_format($total_amount_erp, 2)  ."</b></td>
	<td><b>". number_format($total_qty_take, 2)  ."</b></td>
	<td><b>". number_format($total_amount_take, 2)  ."</b></td>
	<td><b>". number_format($total_qty_var, 2)  ."</b></td>
	<td><b>". number_format($total_amount_var, 2)  ."</b></td>
	<td><b>". round((100-$totalpersentase_result)*(-1), 2)  ." %</b></td>
	<td><b>". round($totalaccuracystock, 2)  ." %</b></td>
	<td><b>". number_format($total_excess_var, 2)  ."</b></td>
	<td><b>". number_format($total_short_var, 2)  ."</b></td>
	<td><b>". number_format($total_gross_var, 2)  ."</b></td>
	
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
	<td colspan='13' align='center'><font color='red'><b><i>". number_format($total_amount_var, 2)  ."</b></i></td>
	</tr>
	
	<tr>
	<td>Nett Var %</td>
	<td colspan='13' align='center'><font color='red'><b><i>". round((100-$totalpersentase_result)*(-1), 2)  ."%</b></i></td>
	</tr>
	
	
	<tr>
	<td>Nett Accuracy</td>
	<td colspan='13' align='center'><font color='red'><b><i>". round($netaccurasi, 2)  ."%</b></i></td>
	</tr>
	
	</table><br><br>";
	
	

echo "<center><font size='+2'>
	<table border='1' cellspacing='0' cellpadding='0' width='95%'>
	<tr align='center'>
	<th rowspan='2'>Warehouse</th>
	<td colspan='2' bgcolor='#dc29f1'><font color='white'><b>ERP</b></font></td>
	<td colspan='2' bgcolor='#0b915a'><font color='white'><b>Stoke Take Result</b></font></td>
	<td colspan='3' bgcolor='#f5a44d'><font color='white'><b>Variance</b></font></th>
	<th rowspan='2'>Stock Accuracy</th>
	<th rowspan='2'>Excess Var</th>
	<th rowspan='2'>Short Var</th>
	<th rowspan='2'>Gross Var</th>
	
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
/*
$sql6 = "SELECT SUM(stoktaking.stqty) AS qty_take_wh,
	SUM(stoktaking.stqty * data_erp.price) AS amount_take_wh
	
 FROM data_erp INNER JOIN stoktaking ON data_erp.items=stoktaking.StItem 
 
 WHERE stoktaking.StWh IN ('$data[StWh]')";

$result6 = mysql_query($sql6);

while($row6 = mysql_fetch_array($result6)){

    $qty_take_wh = $row6['qty_take_wh'];
    $amount_take_wh = $row6['amount_take_wh'];

}

*/

$qty_take_wh=0;
$amount_take_wh=0;

$excesvariancewh=0;
$shortvariancewh=0;
$grosswh=0;




$sql6=mysql_query("SELECT * FROM data_erp INNER JOIN master_wh ON data_erp.warehouse=master_wh.StWh
		WHERE master_wh.StWh='$data[StWh]'");

while ($data33 = mysql_fetch_array($sql6))
		{
			$tampil22=mysql_query("SELECT SUM(Stqty) AS sun FROM stoktaking 
					 WHERE stoktaking.StWh='$data33[warehouse]' AND stoktaking.StItem='$data33[items]' AND
					 stoktaking.last_date <= '$date'");
				
						while ($data22 = mysql_fetch_array($tampil22)){
								$sun=$data22['sun'];
								$san=$sun;
								$amountcount=$data33['price']*$san;
						//=============================================
						
						
						$variant33=$sun-$data33['qty'];
						$amountvariant33=$variant33*$data33['price'];
								
						if($amountvariant33<0)
							{
							$excesvariance3=0;
							$shortvariance3=$amountvariant33;
							$gross3=abs($amountvariant33);
							}
						else {
							$excesvariance3=$amountvariant33;
							$shortvariance3=0;
							$gross3=abs($amountvariant33);
						}
						
						}
						
			
			
			$excesvariancewh=$excesvariancewh+$excesvariance3;
			$shortvariancewh=$shortvariancewh+$shortvariance3;
			$grosswh=$grosswh+$gross3;
						
						
			$amount_take_wh=$amountcount+$amount_take_wh;	
			$qty_take_wh=$qty_take_wh+$sun;
		}

//=======================================================
$varqtywh=$qty_take_wh-$qty_erp_wh;
$varamountwh=$amount_take_wh-$amount_wh_erp;

if($amount_take_wh==0){$persentase_wh="";} else{
$persentase_wh=($amount_take_wh/$amount_wh_erp)*100;
}


	if($persentase_wh>0){$persentase_wh=100-$persentase_wh;}
	else if ($persentase_wh<0){$persentase_wh=100+$persentase_wh;}
	else {$persentase_wh=0;}

//view=========================================================================
if($persentase_wh=='0'){
	$accuracywh=0;
	
}
else{
$accuracywh=100-abs($persentase_wh);
	}
	
	echo "<tr align='right'>
		<td align='left'>$data[StWh]</td>
		<td bgcolor='#fce5ff'>". number_format($qty_erp_wh, 2)  ."</td>
		<td bgcolor='#fce5ff'>". number_format($amount_wh_erp, 2)  ."</td>
		<td bgcolor='#e2fff3'>". number_format($qty_take_wh, 2)  ."</td>
		<td bgcolor='#e2fff3'>". number_format($amount_take_wh, 2)  ."</td>
		<td bgcolor='#fcdbb7'>". number_format($varqtywh, 2)  ."</td>
		<td bgcolor='#fcdbb7'>". number_format($varamountwh, 2)  ."</td>
		<td bgcolor='#fcdbb7'>". round($persentase_wh*(-1), 2)  ." %</td>
		<td bgcolor=''>". round($accuracywh, 2)  ." %</td>
		<td bgcolor=''>". number_format($excesvariancewh, 2)  ."</td>
		<td bgcolor=''>". number_format($shortvariancewh, 2)  ."</td>
		<td bgcolor=''>". number_format($grosswh, 2)  ."</td>
		
		</tr>";
	
	
}	
	
	
	echo "</table><br>";	
?>
</div>
<div id="footer">
			PT Sanden Indonesia | Copyright &copy; 2015
		</div>
</div>