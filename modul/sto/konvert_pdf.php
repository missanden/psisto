<?php
session_start();
ob_start();
?>
<link href="../../style2.css" rel="stylesheet" type="text/css">
<?php 
include "../../config/koneksi.php";
	
	
	
if ($_POST['parameter']=='StId'){
	

	 $tampil=mysql_query("SELECT * FROM stoktaking
							 LEFT JOIN leader 
								ON leader.StRack=stoktaking.StRack 
						WHERE stoktaking.StId BETWEEN '$_POST[valuetag1]' AND '$_POST[valuetag2]' ORDER BY StId ASC");
}

else if ($_POST['parameter']=='StWh')
{
	 $tampil=mysql_query("SELECT * FROM stoktaking
							 INNER JOIN leader 
								ON leader.StRack=stoktaking.StRack 
							WHERE stoktaking.StWh = '$_POST[valuewh]' ORDER BY StId ASC");
}	

else if ($_POST['parameter']=='StRack')
{
	 $tampil=mysql_query("SELECT * FROM stoktaking
							 INNER JOIN leader 
								ON leader.StRack=stoktaking.StRack 
						WHERE stoktaking.StRack = '$_POST[valuerack]' ORDER BY StId ASC");
				
}



else if ($_POST['parameter']=='StItem')
{
	 $tampil=mysql_query("SELECT * FROM stoktaking
							 INNER JOIN leader 
								ON leader.StRack=stoktaking.StRack 
						WHERE stoktaking.StItem LIKE '%$_POST[valueitem]%' ORDER BY StId ASC");
}

else if ($_POST['parameter']=='lead')
{
	 $tampil=mysql_query("SELECT * FROM stoktaking
							 LEFT JOIN leader 
								ON leader.StRack=stoktaking.StRack
	 WHERE leader.leadername LIKE '%$_POST[leader]%' ORDER BY StId ASC");
}		

$row=mysql_num_rows($tampil);
while ($data = mysql_fetch_array($tampil))
		{echo "<page><b>Date : 24&nbsp;&nbsp;/&nbsp;&nbsp;25&nbsp;&nbsp;/&nbsp;&nbsp;26&nbsp;&nbsp;/&nbsp;&nbsp;27&nbsp;&nbsp;SEP-18</b>
		<table border='1' cellspacing='0' celpadding='0'>
		<tr>
		<td colspan='4' align='center' width='370' class='big'><u><b>STOCK TAKE TAG</b></u>  <br>NO. TAG : <b>".$data['StId']."</b></td>
		</tr>
		<tr>
		<td colspan='2'>&nbsp;&nbsp;&nbsp;PART NO.</td><td>&nbsp;&nbsp;&nbsp; QUANTITY</td><td align='center'>UM</td>
		</tr>
		<tr>
		<td colspan='2' align='center' width='170' height='75'><b><p class='part'>".$data['StItem']."</p><br></b>&nbsp;&nbsp;&nbsp;".$data['StCustPn']."</td>
		<td align='center' class='big'><b></b></td><td align='center' class='big'><b>".$data['StUm']."</b></td>
		</tr>
		<tr>
		<td colspan='3'>&nbsp;&nbsp;&nbsp;PART DESCRIPTION</td><td colspan='1' align='center'>&nbsp;&nbsp;&nbsp;GROUP</td>
		</tr>
		<tr>
		<td colspan='3' height='20' class='small'>&nbsp;&nbsp;&nbsp;".$data['StDesc']."<br></td><td colspan='1' align='center'>&nbsp;&nbsp;&nbsp;<b>".$data['StGrp']."</b></td>
		</tr>
		<tr>
		<td colspan='3'>&nbsp;&nbsp;&nbsp;LOCATION (RACK)</td><td colspan='1' align='center' class='small'>&nbsp;&nbsp;&nbsp;WAREHOUSE</td>
		</tr>
		<tr>
		<td colspan='3' align='center' class='big' height='40'>&nbsp;&nbsp;&nbsp;<b>".$data['StRack']." (".$data['StLoc'].")</b></td><td width='40' colspan='1' align='center' class='middle'>&nbsp;&nbsp;&nbsp;<b>".$data['StWh']."</b></td>
		</tr>
		<tr>
		<td colspan='4' align='center' height='125'>NOTES / REMARKS*<br><br>".$data['remarkinputer']."<br><br><br><i><h6>*QTY / BOX (X) JUMLAH BOX</h6></i></td>
		</tr>
		<tr>
		<td colspan='4' align='center'>&nbsp;&nbsp;&nbsp;CHECK SIGN**</td>
		</tr>
		<tr>
		<td height='75'>&nbsp;</td><td height='75'>&nbsp;</td><td height='75' valign='bottom' align='center'>&nbsp;".$data['leadername']."</td><td height='75'>&nbsp;</td>
		</tr>
		<tr>
		<td width='25%' align='center'>COUNTER</td><td width='25%' align='center'>VERIFIER</td><td width='25%' align='center'>LEADER</td><td width='25%' align='center'>AUDITOR</td>
		</tr>
		</table><i>**Nama Jelas & Ttd / Paraf</i></page>";
			}

$filename="reportsrtock.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
	$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
	require_once(dirname(__FILE__).'/../../html2pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P','A6','en', false, 'ISO-8859-15',array(0, 0, 0, 2));
		$html2pdf->setDefaultFont('helvetica');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
?>