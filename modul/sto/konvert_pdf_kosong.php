<?php
session_start();
ob_start();
?>
<link href="../../style2.css" rel="stylesheet" type="text/css">
<?php 
$x = 1; 
while($x <= $_POST['valuetag'])	

		{echo "<page><b>Date : 26&nbsp;&nbsp;/&nbsp;&nbsp;27&nbsp;&nbsp;/&nbsp;&nbsp;28&nbsp;&nbsp;/&nbsp;&nbsp;29&nbsp;&nbsp;SEP-16</b>
		<table border='1' cellspacing='0' celpadding='0'>
		<tr>
		<td colspan='4' align='center' width='370' class='big'><u><b>STOCK TAKE TAG</b></u>  <br>NO. TAG : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
		<td colspan='2'>&nbsp;&nbsp;&nbsp;PART NO.</td><td>&nbsp;&nbsp;&nbsp; QUANTITY</td><td align='center'>UM</td>
		</tr>
		<tr>
		<td colspan='2' align='center' width='170' height='75'></td>
		<td align='center' class='big'><b></b></td><td align='center' class='big'></td>
		</tr>
		<tr>
		<td colspan='3'>&nbsp;&nbsp;&nbsp;PART DESCRIPTION</td><td colspan='1' align='center'>&nbsp;&nbsp;&nbsp;GROUP</td>
		</tr>
		<tr>
		<td colspan='3' height='20' class='small'>&nbsp;&nbsp;&nbsp;<br></td><td colspan='1' align='center'>&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
		<td colspan='3'>&nbsp;&nbsp;&nbsp;LOCATION</td><td colspan='1' align='center' class='small'>&nbsp;&nbsp;&nbsp;WAREHOUSE</td>
		</tr>
		<tr>
		<td colspan='3' align='center' class='big' height='40'>&nbsp;&nbsp;&nbsp;</td><td width='40' colspan='1' align='center' class='middle'>&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
		<td colspan='4' align='center' height='125'>NOTES / REMARKS*<br><br><br><br><br><i><h6>*QTY / BOX (X) JUMLAH BOX</h6></i></td>
		</tr>
		<tr>
		<td colspan='4' align='center'>&nbsp;&nbsp;&nbsp;CHECK SIGN**</td>
		</tr>
		<tr>
		<td height='75'>&nbsp;</td><td height='75'>&nbsp;</td><td height='75' valign='bottom' align='center'>&nbsp;</td><td height='75'>&nbsp;</td>
		</tr>
		<tr>
		<td width='25%' align='center'>COUNTER</td><td width='25%' align='center'>VERIFIER</td><td width='25%' align='center'>LEADER</td><td width='25%' align='center'>AUDITOR</td>
		</tr>
		</table><i>**Nama Jelas & Ttd / Paraf</i></page>";
		
$x++;		
			}
		
$filename="reportsrtockkosong.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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