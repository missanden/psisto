<html>
<head>
<title></title>

<link href="style5.css" rel="stylesheet" type="text/css" />
</head>
<body>
 
<div id="header"><center><img src='images/logo.png'></center>
 <div id="content">
<?php


date_default_timezone_set("Asia/Jakarta");

include "/config/koneksi.php";


$tampil=mysql_query("SELECT * FROM leader WHERE leader.leadername NOT IN ('MADI')
 GROUP BY leader.leadername ORDER BY leadername ASC");

echo "<u><center><font size='+2'><b>PSI - STOCK TAKE INPUT TAG CONTROL</b></font></u><br><br><br>"; 
 
 
echo "<table border='1' width='100%'>
		<tr>
			<th rowspan='2'>Leader</th>
			<th rowspan='2'>Count Tag</th>
			<th colspan='4'>Sen, 24 Sep 18</th>
			<th colspan='4'>Sel, 25 Sep 18</th>
			<th colspan='4'>Rab, 26 Sep 18</th>
			<th colspan='2'>Total</th>
			
			</tr>
		<tr>
			<th>13:00</th>
			<th>%</th>
			<th>16:30</th>
			<th>%</th>
			
			<th>13:00</th>
			<th>%</th>
			<th>16:30</th>
			<th>%</th>
			
			
			<th>13:00</th>
			<th>%</th>
			<th>16:30</th>
			<th>%</th>
			
			<th>Count</th>
			<th>%</th>
			
			
		</tr>	
			";
			
while ($data = mysql_fetch_array($tampil))
		{
			
			echo "<tr>
				<td>$data[leadername]</td>";
			
			$tampil2=mysql_query("SELECT COUNT(stoktaking.StRack) AS counttag FROM stoktaking 
			INNER JOIN leader ON leader.StRack=stoktaking.StRack
			
			WHERE leader.leadername='$data[leadername]' GROUP BY leader.leadername");
				$data2 = mysql_fetch_array($tampil2);
			echo "<td>$data2[counttag]</td>";
			
			
			$tampil3=mysql_query("SELECT COUNT(stoktaking.StRack) AS counttag3 FROM stoktaking 
			INNER JOIN leader ON leader.StRack=stoktaking.StRack
			WHERE leader.leadername='$data[leadername]' AND 
			stoktaking.last_date<='2018-09-24 13:00:00' AND 
			stoktaking.last_date NOT IN ('0000-00-00 00:00:00')
			GROUP BY leader.leadername");
			$data3 = mysql_fetch_array($tampil3);
			$persen3=($data3['counttag3']/$data2['counttag'])*100;
			$persen3=number_format($persen3, 2, ',', ' ');
			
			
			
			$tampil4=mysql_query("SELECT COUNT(stoktaking.StRack) AS counttag4 FROM stoktaking 
			INNER JOIN leader ON leader.StRack=stoktaking.StRack
			WHERE leader.leadername='$data[leadername]' AND 
			stoktaking.last_date>='2018-09-24 13:00:01' AND 
			stoktaking.last_date<='2018-09-24 16:30:00' AND 
			stoktaking.last_date NOT IN ('0000-00-00 00:00:00')
			GROUP BY leader.leadername");
			$data4 = mysql_fetch_array($tampil4);
			$persen4=($data4['counttag4']/$data2['counttag'])*100;
			$persen4=number_format($persen4, 2, ',', ' ');
			
			
			$tampil5=mysql_query("SELECT COUNT(stoktaking.StRack) AS counttag5 FROM stoktaking 
			INNER JOIN leader ON leader.StRack=stoktaking.StRack
			WHERE leader.leadername='$data[leadername]' AND 
			stoktaking.last_date>='2018-09-24 16:30:01' AND 
			stoktaking.last_date<='2018-09-25 13:00:00' AND 
			stoktaking.last_date NOT IN ('0000-00-00 00:00:00')
			GROUP BY leader.leadername");
			$data5 = mysql_fetch_array($tampil5);
			$persen5=($data5['counttag5']/$data2['counttag'])*100;
			$persen5=number_format($persen5, 2, ',', ' ');
			
			
			$tampil6=mysql_query("SELECT COUNT(stoktaking.StRack) AS counttag6 FROM stoktaking 
			INNER JOIN leader ON leader.StRack=stoktaking.StRack
			WHERE leader.leadername='$data[leadername]' AND 
			stoktaking.last_date>='2018-09-25 13:00:01' AND 
			stoktaking.last_date<='2018-09-25 16:30:00' AND 
			stoktaking.last_date NOT IN ('0000-00-00 00:00:00')
			GROUP BY leader.leadername");
			$data6 = mysql_fetch_array($tampil6);
			$persen6=($data6['counttag6']/$data2['counttag'])*100;
			$persen6=number_format($persen6, 2, ',', ' ');
			
			
			
			$tampil7=mysql_query("SELECT COUNT(stoktaking.StRack) AS counttag7 FROM stoktaking 
			INNER JOIN leader ON leader.StRack=stoktaking.StRack
			WHERE leader.leadername='$data[leadername]' AND 
			stoktaking.last_date>='2018-09-25 16:30:01' AND 
			stoktaking.last_date<='2018-09-26 13:00:00' AND 
			stoktaking.last_date NOT IN ('0000-00-00 00:00:00')
			GROUP BY leader.leadername");
			$data7 = mysql_fetch_array($tampil7);
			$persen7=($data7['counttag7']/$data2['counttag'])*100;
			$persen7=number_format($persen7, 2, ',', ' ');
			
			
			$tampil8=mysql_query("SELECT COUNT(stoktaking.StRack) AS counttag8 FROM stoktaking 
			INNER JOIN leader ON leader.StRack=stoktaking.StRack
			WHERE leader.leadername='$data[leadername]' AND 
			stoktaking.last_date>='2017-09-26 13:00:01' AND 
			stoktaking.last_date<='2017-09-26 16:00:00' AND 
			stoktaking.last_date NOT IN ('0000-00-00 00:00:00')
			GROUP BY leader.leadername");
			$data8 = mysql_fetch_array($tampil8);
			$persen8=($data8['counttag8']/$data2['counttag'])*100;
			$persen8=number_format($persen8, 2, ',', ' ');
			
			$total=$data3['counttag3']+$data4['counttag4']+$data5['counttag5']+$data6['counttag6']+$data7['counttag7']+$data8['counttag8'];
			$totalpersen=($total/$data2['counttag'])*100;
			$totalpersen=number_format($totalpersen, 2, ',', ' ');
			
			echo "
			<td>$data3[counttag3]</td>
			<td>$persen3 %</td>
			<td>$data4[counttag4]</td>
			<td>$persen4 %</td>";
			
			
			echo "<td>$data5[counttag5]</td>
			<td>$persen5 %</td>
			<td>$data6[counttag6]</td>
			<td>$persen6 %</td>";
					
			echo "<td>$data7[counttag7]</td>
			<td>$persen7 %</td>
			<td>$data8[counttag8]</td>
			<td>$persen8 %</td>		
			<td>$total</td>		
			<td>$totalpersen %</td>		
					
					";
			
			
			
			
			
			echo"</tr>
			";	
		
		}	
		
	echo "</table><br><br>";	
?>
</div>
<div id="footer">
			PT Sanden Indonesia | Copyright &copy; 2015
		</div>
</div>