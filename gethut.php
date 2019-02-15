<?php
$aksi="modul/sto/aksi_sto.php";
include "config/koneksi.php";
$q = $_REQUEST["q"];


	$tampil=mysql_query("SELECT * FROM stoktaking
							 LEFT JOIN leader 
								ON leader.StRack=stoktaking.StRack WHERE stoktaking.StId='$q' ");
	$row=mysql_num_rows($tampil);
	if ($row <= 0){echo "<center><b><font size='+2' color='red'>DATA TIDAK DITEMUKAN</font></center></b>";}
	else{
    while($w=mysql_fetch_array($tampil)){
				echo "
				<form method='POST' class='form' action='$aksi?module=sto&act=update' onSubmit='return validasi(this)' enctype='multipart/form-data'> 
				<input type='hidden' Name='StId' size='6' value='$q' onkeyup='showHint(this.value)' width='10' maxlength='5'>
				TABEL INFO
				<table width='420'>
				<tr>
				<td width='180'>QTY INPUT </td><td colspan='3'><input type='text' name='Stqty' value='$w[Stqty]' size='10' maxlength='7'>&nbsp;&nbsp;$w[StUm]</td></tr>
				</tr>
				<td>WAREHOUSE</td><td><input type='text' name='StWh' value='$w[StWh]' size='10'></td>
				</tr>
				<tr>
				<td>LOCATION</td><td><input type='text' name='StLoc' disabled readonly='' value='$w[StLoc]' size='10'></td>
				</tr>
				<tr>
				<td>PART NUMBER</td><td><input type='text' name='StItem' disabled readonly='' value='$w[StItem]' size='30'></td>
				</tr>
				<tr>
				<td>DESCRIPTION</td><td><input type='text' name='StDesc' disabled readonly='' value='$w[StDesc]' size='40'></td>
				</tr>
				<tr>
				<td>MODEL</td><td><input type='text' name='StCustPn' disabled readonly='' value='$w[StCustPn]' size='30'></td>
				</tr>
				<tr>
				<tr>
				<td>ITEM GROUP</td><td><input type='text' name='StGrp' disabled readonly='' value='$w[StGrp]' size='10'></td>
				</tr>";
				
				if($w['user']==''){
				
				echo "
				<tr>
				<td width='150'>USER </td><td colspan='3'>
				<input type='text' name='user1' disabled readonly='' value='$w[user]' size='10'>
				<input type='hidden' name='user' readonly='' value='$w[user]' size='10'>
				</td></tr>
				</tr>";
				}
				
				else {
				echo "
				<tr>
				<td width='150'>USER </td><td colspan='3'>
				<input type='text' name='user1' disabled readonly='' value='$w[user]' size='10'>
				<input type='hidden' name='user' value='$w[user]' size='10'>
				<br>$w[first_date]</td></tr>
				</tr>
				<tr>
				<td width='150'>LAST UPDATE BY</td><td colspan='3'>
				<input type='text' name='user_last1' disabled readonly='' value='$w[last_update]' size='10'>
				<input type='hidden' name='user_last'  readonly='' value='$w[last_update]' size='10'>
				<br>$w[last_date]</td></tr>
				</tr>
				";	
					
				}
				
				echo "
				<tr>
				<td><font color='red'><b>**REMARK</b></font></td><td>
				<font color='red' size='-2'><i><b>**ISI APABILA TULISAN QTY TIDAK JELAS</b></i></font><br>
				<textarea name='remarkinputer' cols='30'>$w[remarkinputer]</textarea></td>
				</tr>
				<tr><td colspan='4' align='center'><input type=submit value=Save>
                            <input type=reset value=Cancel></form></td></tr>
				
				</table><br><br>";
			}}

?>