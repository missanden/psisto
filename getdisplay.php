<link href="style2.css" rel="stylesheet" type="text/css">
<?php

include "config/koneksi.php";
$q = $_REQUEST["q"];

$tampil=mysql_query("SELECT * FROM stoktaking
							 LEFT JOIN leader 
								ON leader.StRack=stoktaking.StRack WHERE stoktaking.StId='$q' ");
	$row=mysql_num_rows($tampil);

$row=mysql_num_rows($tampil);
while ($data = mysql_fetch_array($tampil))
		{echo "
		<table border='1' cellspacing='0' celpadding='0'>
		<tr>
		<td colspan='4' align='center' width='370' class='big'><u><b>STOCK TAKE TAG</b></u>  <br>NO. TAG : <b>".$data['StId']."</b></td>
		</tr>
		<tr>
		<td colspan='2' bgcolor='#6c6c6c'>&nbsp;&nbsp;&nbsp;PART NO.</td><td bgcolor='#6c6c6c'>QUANTITY</td><td align='center' bgcolor='#6c6c6c'>UM</td>
		</tr>
		<tr>
		<td colspan='2' width='170' height='75'><font size='+1'><b>".$data['StItem']."</font><br></b>".$data['StCustPn']."</td>
		<td align='center' class='big'><font color='red' size='+2'><b>$data[Stqty]</b></font></td><td align='center' class='big'><b>".$data['StUm']."</b></td>
		</tr>
		<tr>
		<td colspan='3' bgcolor='#6c6c6c'>&nbsp;&nbsp;&nbsp;PART DESCRIPTION</td><td colspan='1' align='center' bgcolor='#6c6c6c'>&nbsp;&nbsp;&nbsp;GROUP</td>
		</tr>
		<tr>
		<td colspan='3' height='20' class='small'>&nbsp;&nbsp;&nbsp;".$data['StDesc']."<br></td><td colspan='1' align='center'>&nbsp;&nbsp;&nbsp;<b>".$data['StGrp']."</b></td>
		</tr>
		<tr>
		<td colspan='3' bgcolor='#6c6c6c'>&nbsp;&nbsp;&nbsp;LOCATION</td><td colspan='1' align='center' class='small' bgcolor='#6c6c6c'>&nbsp;&nbsp;&nbsp;WAREHOUSE</td>
		</tr>
		<tr>
		<td colspan='3' align='center' class='big' height='40'>&nbsp;&nbsp;&nbsp;<b>".$data['StLoc']."</b></td><td width='40' colspan='1' align='center' class='middle'>&nbsp;&nbsp;&nbsp;<b>".$data['StWh']."</b></td>
		</tr>
		<tr bgcolor='#6c6c6c'>
		<td colspan='4' align='center'>NOTES / REMARKS*</td>
		</tr>
		<tr>
		<td colspan='4' align='center' height='50'><br><b>$data[remarkinputer]</b></td>
		</tr>
		</tr>
		<tr bgcolor='#6c6c6c'>
		<td colspan='2' align='center'>LEADER</td><td colspan='2' align='center'>INPUTER</td>
		</tr>
		<tr>
		<td colspan='2' valign='bottom' align='center'>&nbsp;".$data['leadername']."</td>";
		
		if($data['last_update']=='')
		{$user=$data['user'];}
		else{$user=$data['last_update'];}
		
		echo "<td colspan='2' valign='bottom' align='center'>&nbsp;$user</td>
		</table><br><br>";
			}

?>