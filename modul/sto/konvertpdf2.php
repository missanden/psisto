<?php
session_start();
ob_start();
?>
<link href="../../style2.css" rel="stylesheet" type="text/css">
<?php 
include "../../config/koneksi.php";

	 $tampil=mysql_query("SELECT * FROM stoktaking WHERE StId between  '0125' and '0126'");
	
 
$row=mysql_num_rows($tampil);
while ($data = mysql_fetch_array($tampil))
		{echo "<page><b>Date : 26&nbsp;&nbsp;/&nbsp;&nbsp;27&nbsp;&nbsp;/&nbsp;&nbsp;28&nbsp;&nbsp;/&nbsp;&nbsp;29&nbsp;&nbsp;Okt 15</b>
		<table border='1' cellspacing='0' celpadding='0'>
		<tr>
		<td colspan='4' align='right' width='370' class='middle'><b>STOCK TAKE TAG</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| NO. TAG : <b>".$data['StId']."&nbsp;&nbsp;&nbsp;</b></td>
		</tr>
		<tr>
		<td colspan='2'>&nbsp;&nbsp;&nbsp;PART NO.</td><td>&nbsp;&nbsp;&nbsp; QUANTITY</td><td align='center'>UM</td>
		</tr>
		<tr>
		<td colspan='2' align='center' width='170'>&nbsp;&nbsp;&nbsp;<b><h3>".$data['StItem']."</h3></b>&nbsp;&nbsp;&nbsp;".$data['StCustPn']."</td>
		<td align='center' class='big'><b></b></td><td align='center' class='big'><b>".$data['StUm']."</b></td>
		</tr>
		<tr>
		<td colspan='3'>&nbsp;&nbsp;&nbsp;PART DESCRIPTION</td><td colspan='1' align='center'>&nbsp;&nbsp;&nbsp;GROUP</td>
		</tr>
		<tr>
		<td colspan='3' height='20' class='small'>&nbsp;&nbsp;&nbsp;".$data['StDesc']."<br></td><td colspan='1' align='center'>&nbsp;&nbsp;&nbsp;".$data['StGrp']."</td>
		</tr>
		<tr>
		<td colspan='2'>&nbsp;&nbsp;&nbsp;LOCATION</td><td colspan='2' align='center'>&nbsp;&nbsp;&nbsp;WAREHOUSE</td>
		</tr>
		<tr>
		<td colspan='2' align='center' class='middle' height='50'>&nbsp;&nbsp;&nbsp;<b>".$data['StLoc']."</b></td><td width='50' colspan='2' align='center' class='middle'>&nbsp;&nbsp;&nbsp;<b>".$data['StWh']."</b></td>
		</tr>
		<tr>
		<td colspan='4' align='center' height='125'>NOTES / REMARKS*<br><br><br><br><br><br><i><h6>*QTY / BOX (X) JUMLAH BOX</h6></i></td>
		</tr>
		<tr>
		<td colspan='4' align='center'>&nbsp;&nbsp;&nbsp;CHECK SIGN**</td>
		</tr>
		<tr>
		<td height='75'>&nbsp;</td><td height='75'>&nbsp;</td><td height='75'>&nbsp;</td><td height='75'>&nbsp;</td>
		</tr>
		<tr>
		<td width='25%' align='center'>COUNTER</td><td width='25%' align='center'>VERIFIER</td><td width='25%' align='center'>LEADER</td><td width='25%' align='center'>INPUTER</td>
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
		$html2pdf = new HTML2PDF('P','A6','en', false, 'ISO-8859-15',array(1, 0, 0, 2));
		$html2pdf->setDefaultFont('helvetica');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
?>