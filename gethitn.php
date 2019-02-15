<?php
include "config/koneksi.php";
$q = $_REQUEST["q"];


	$tampil=mysql_query("SELECT * FROM part_number WHERE part_number='$q' ");
	$row=mysql_num_rows($tampil);
	
    while($w=mysql_fetch_array($tampil)){
				echo "
				<table width='430'>
				<tr>
				<td>DESCRIPTION</td><td>
				<input type='text' name='StDesc1' disabled readonly='' value='$w[description]' size='30'>
				<input type='hidden' name='StDesc' readonly='' value='$w[description]' size='30'>
				</td>
				</tr>
				<tr>
				<td>MODEL</td><td>
				<input type='text' name='StCustPn1' disabled readonly='' value='$w[model]' size='20'>
				<input type='hidden' name='StCustPn' readonly='' value='$w[model]' size='20'>
				</td>
				</tr>
				<tr>
				<td>RACK</td><td><select name='StRack'>
				<option value='' selected>Rack  </option>";
			$tampil2=mysql_query("SELECT * FROM leader ORDER BY StRack ASC");
           while($w2=mysql_fetch_array($tampil2)){
									if ($_POST['StRack']==$w2['StRack']){
										echo "<option value='$w2[StRack]' selected>$w2[StRack]</option>";
													}
											else{
												echo "<option value='$w2[StRack]'>$w2[StRack]</option>";
												}
										}

			
				echo "</select></td>
				</tr>
				<tr>
				<td>LOCATION</td><td><input type='text' name='StLoc'  size='30'></td>
				</tr>
				<tr>
				<td>ITEM GROUP</td><td>
				<input type='text' name='StGrp1' disabled value='$w[item_group]' readonly='' size='10'>
				<input type='hidden' name='StGrp' value='$w[item_group]' readonly='' size='10'>
				</td>
				</tr>
				<tr>
				<td width='150'>QTY INPUT </td><td colspan='3'><input type='text' name='Stqty' size='10'>
				<input type='text' name='StUm' value='$w[unit]' readonly='' size='3'>
				</td>
				</tr>
				
				<tr><td colspan='4' align='center'><input type=submit value=Save>
                            <input type=reset value=Cancel></form></td></tr>
				
				</table>";
			}

?>