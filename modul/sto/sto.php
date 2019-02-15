<?php
$aksi="modul/sto/aksi_sto.php";
switch($_GET['act']){

case "uploadsto":

echo "<h2>Upload Sto</h2>
<table><form id='forms' method='post' class='form2' action='$aksi?module=sto&act=upload' enctype='multipart/form-data'>
		<tr>
		<td>Upload File Excel</td><td><input name='userfile' type='file'><br><br>
		<input type='submit' name='submit'  width='100px' height='25px' border='0' value='Submit' />
		</td>
		</tr>		
			</table></form><br>";

break;


case "searchsto":
?>
 <script>
 
function validasi(form){

if (form.Stqty.value == ""){
    alert("Anda belum mengisi Qty.");
    form.Stqty.focus();
    return (false);
  }
}
 
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "gethut.php?q=" + str, true);
        xmlhttp.send();
    }
}


</script>
 
 <?php 
 
 echo "<h2>Input Stock Tag</h2>
		<form method='POST' class='form' action='#' onSubmit='return validasi(this)' enctype='multipart/form-data'>  <table>
			<tr>
			<td width='150'>TAG ID </td>     <td colspan='3'><input type='text' Name='StId' size='6'  onkeyup='showHint(this.value)' width='10' maxlength='5'></td></tr>
			</table><br></form>
			<span id='txtHint'></span>";
  break;


case "checksto":
 ?>
 <script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "gethitn.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
 
 
 <?php
 echo "<h2>Form Update Stock</h2>
		<form method='POST' class='form' action='?module=sto&act=checksto' onSubmit='return validasi1(this)' enctype='multipart/form-data'>  <table>
			<tr>
			<td width='150'>TAG ID </td><td colspan='3'><input type='text' Name='StId' size='4'  onkeyup='showHint(this.value)' width='10' value='$_POST[StId]' maxlength='4'></td></tr>
			<tr>
			<td>WAREHOUSE</td><td>
			<select name='StWh'>
			<option value='' selected>  </option>";
			
			


			
			$tampil=mysql_query("SELECT * FROM master_wh ORDER BY StWh ASC");
           while($w=mysql_fetch_array($tampil)){
									if ($_POST['StWh']==$w['StWh']){
										echo "<option value=$w[StWh] selected>$w[StWh]</option>";
													}
											else{
												echo "<option value=$w[StWh]>$w[StWh]</option>";
												}
										}

			
		echo "</select>&nbsp;<input type='submit' value='Check'></form>
		<form method='POST' action='$aksi?module=sto&act=update' onSubmit='return validasi(this)' enctype='multipart/form-data'>
		<input type='hidden' Name='StId' size='4'  onkeyup='showHint(this.value)' width='10' value='$_POST[StId]'>
		<input type='hidden' Name='StWh' size='4'  onkeyup='showHint(this.value)' width='10' value='$_POST[StWh]'>
		</td></tr>";
		
	$tampil=mysql_query("SELECT * FROM stoktaking WHERE StId = '$_POST[StId]' AND StWh LIKE '%$_POST[StWh]%' ");
	$row=mysql_num_rows($tampil);
	
		if ($row <= 0){echo "<tr>
			<td width='150'>QTY INPUT </td><td colspan='3'><input type='text' Name='qty' value='$w[Stqty]' size='4'></td></tr>
			</tr>
			</table><br></table><br><center><b><font size='+2' color='red'>DATA TIDAK DITEMUKAN</font></center></b>";}
		else{
		while($w=mysql_fetch_array($tampil)){
				
			echo "<tr>
			<td width='150'>QTY INPUT </td><td colspan='3'><input type='text' Name='qty' value='$w[Stqty]' width='30' maxlength='10'></td></tr>
			</tr>
			</table><br>";
				
				echo "
				TABEL INFO
				<table>
				<tr>
				<td>TAG ID</td><td><input type='text' disabled value='$w[StId]' size='10'></td>
				</tr>
				<tr>
				<td>LOCATION</td><td><input type='text' disabled value='$w[StLoc]' size='15'></td>
				</tr>
				<tr>
				<td>PART NUMBER</td><td><input type='text' disabled value='$w[StItem]' size='30'></td>
				</tr>
				<tr>
				<td>DESCRIPTION</td><td><input type='text' disabled value='$w[StDesc]' size='30'></td>
				</tr>
				<tr>
				<td>MODEL</td><td><input type='text' disabled value='$w[StCustPn]' size='20'></td>
				</tr>
				<tr>
				<td>WAREHOUSE</td><td><input type='text' disabled value='$w[StWh]' size='10'></td>
				</tr>
				<tr>
				<td>ITEM GROUP</td><td><input type='text' disabled value='$w[StGrp]' size='7'</td>
				</tr>
				<tr>
				<td>USER</td><td><input type='text' disabled value='$w[user]' size='10'</td>
				</tr>
				<tr><td colspan='4' align='center'><input type=submit value=Save>
                            <input type=reset value=Cancel></form></td></tr>
				
				</table><br><br>";
			}}

 
 
  break; 

  case "whprint":
  
 echo "<h2>Print Tag</h2>
		<form method='POST' class='form' action='modul/sto/konvert_pdf.php' target='_blank' onSubmit='return validasi1(this)' enctype='multipart/form-data'>  <table>
			<input type='hidden' name='parameter' value='StWh'>
			<table width='350' class='noborder'>
			<tr>
			<td>WAREHOUSE</td><td colspan='3'>
			<select name='valuewh' id='wh'>
			<option value='' selected> StWh </option>";
													
			$tampil=mysql_query("SELECT * FROM master_wh ORDER BY StWh ASC");
            while($w=mysql_fetch_array($tampil)){
              echo "<option value=$w[StWh]>$w[StWh]</option>";
            }
			
		echo "</select>&nbsp;</td>
			</tr>
			<tr>
			<td colspan='4'  align='center'><input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'></form></td>
			</tr>
			
			</table><br><br>";
  break;
  
  case "tagprint":
   
 echo "<h2>Print Tag</h2>
		<form method='POST' class='form' action='modul/sto/konvert_pdf.php' target='_blank' onSubmit='return validasi1(this)' enctype='multipart/form-data'>  <table>
			<table width='350' class='noborder'>
			<input type='hidden' name='parameter' value='StId'>
			<tr>
			<td width='150'>NO TAG </td>
			<td colspan='2'>
			<input type='text' name='valuetag1'  size='15' maxlength='4' placeholder='Mulai Dari' id='tag1'></td>
			<td>
			<input type='text' name='valuetag2'  size='15' maxlength='4' placeholder='Sampai Dengan' id='tag2'>
			</td></tr>
			</tr>
			<tr>
			<td colspan='4'  align='center'><input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'></form></td>
			</tr>
			
			</table><br><br>";
  break;

   case "locprint":
  
 echo "<h2>Print Tag</h2>
		<form method='POST' class='form' action='modul/sto/konvert_pdf.php' target='_blank' onSubmit='return validasi1(this)' enctype='multipart/form-data'>  <table>
			<input type='hidden' name='parameter' value='StRack'>
			<table width='350' class='noborder'>
			<tr>
			<td>Rack</td><td colspan='3'>
			<select name='valuerack' id='wh'>
			<option value='' selected> StLocation </option>";
													
			$tampil=mysql_query("SELECT * FROM leader ORDER BY StRack ASC");
            while($w=mysql_fetch_array($tampil)){
              echo "<option value=$w[StRack]>$w[StRack]</option>";
            }
			
		echo "</select>&nbsp;</td>
			</tr>
			<tr>
			<td colspan='4'  align='center'><input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'></form></td>
			</tr>
			
			</table><br><br>";
  break;
  
  
   case "partprint":
  
 echo "<h2>Print Tag</h2>
		<form method='POST' class='form' action='modul/sto/konvert_pdf.php' target='_blank' onSubmit='return validasi1(this)' enctype='multipart/form-data'>  <table>
			<input type='hidden' name='parameter' value='StItem'>
			<table width='350' class='noborder'>
			<tr>
			<td>Part Number</td><td colspan='3'><input type='text' name='valueitem' width='50px' placeholder='Sample : J1402-H0480'>
			</td>
			</tr>
			<tr>
			<td colspan='4'  align='center'><input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'></form></td>
			</tr>
			
			</table><br><br>";
  break;
  

case "printsto":

echo "<center><table class='noborder' cellspacing='0' celpadding='0'>

		<tr>
			<td align='center'><a href='media.php?module=sto&act=whprint'><img src='images/warehouse.png' width='120px' height='120px'></img></a></li></td>
			<td align='center'><a href='media.php?module=sto&act=locprint'><img src='images/rack.png' width='120px' height='120px'></img></a></li></td>
			<td align='center'><a href='media.php?module=sto&act=leaderprint'><img src='images/leader.png' width='100px' height='120px'></img></a></li></td>
			</tr>		
		<tr>
			<td align='center'>Warehouse</td>
			<td align='center'>Rack</td>
			<td align='center'>Leader</td>
		</tr>
		
		<tr>
			<td align='center'><a href='media.php?module=sto&act=tagprint'><img src='images/printtag.png' width='120px' height='120px'></img></a></li></td>
			<td align='center'><a href='media.php?module=sto&act=partprint'><img src='images/part.png' width='120px' height='120px'></img></a></li></td>
			<td align='center'><a href='media.php?module=sto&act=tagkosong'><img src='images/tagkos.png' width='120px' height='120px'></img></a></li></td>
		</tr>		
		<tr>
			<td align='center'>Tag</a></td>
			<td align='center'>Part Number</td>
			<td align='center'>Tag Kosong</td>
		</tr>

		</table></center><br>";

  break;  
  
case "inputsto":
 ?>
 <script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "gethitn.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
 <?php
 echo "<h2>Add Additional Tag</h2>
		
		<form method='POST' action='$aksi?module=sto&act=input' onSubmit='return validasi(this)' enctype='multipart/form-data'>
		<table width='350'>
				<tr>
				<td>WAREHOUSE</td><td>
				<select name='StWh'>
				<option value='' selected>-- Warehouse --</option>";
			$tampil=mysql_query("SELECT * FROM master_wh ORDER BY StWh ASC");
           while($w=mysql_fetch_array($tampil)){
									if ($_POST['StWh']==$w['StWh']){
										echo "<option value='$w[StWh]' selected>$w[StWh]</option>";
													}
											else{
												echo "<option value='$w[StWh]'>$w[StWh]</option>";
												}
										}

			
				echo "</select></td>
				</tr>
				<tr>
				<td>PART NUMBER</td><td>
				<select name='StItem' onchange='showHint(this.value)' class='item'>
				<option value='' selected>-- Part Number -- </option>";
					$part=mysql_query("SELECT * FROM part_number ORDER BY part_number ASC");
						while($we=mysql_fetch_array($part)){
												echo "<option value='$we[part_number]'>$we[part_number] --> $we[description]</option>";
												}

			
				echo "</select>
				</td>
				</tr>
				</table><br>
				 <span id='txtHint'></span>
				<br><br>";
  break; 
  
  
  case "reportsto":
 
 echo "<h2>Data Reports</h2>
		
		<form method='POST' action='modul/sto/konvert_excel.php' onSubmit='return validasi(this)' enctype='multipart/form-data'>
		<table>
				<tr>
				<tr><td colspan='4' align='center'><input type=submit value='Export Excel Stock Take Tag'>
                 </form></td></tr>
				
				</table><br><br>";
				
		
		echo "<form method='POST' action='modul/sto/konvert_excel_leader.php' onSubmit='return validasi(this)' enctype='multipart/form-data'>
		
		<h2>Form Count Sheet</h2>
		<table width='350'>
		<tr>
			<td>LEADER</td><td colspan='3'>
			<select name='leader' id='lead'>";
			
			$tampil=mysql_query("SELECT leadername  FROM leader GROUP BY leadername  ORDER BY leadername ASC");
           while($w=mysql_fetch_array($tampil)){
									if ($_POST['leadername']==$w['leadername']){
										echo "<option value='$w[leadername]' selected>$w[leadername]</option>";
													}
											else{
												echo "<option value='$w[leadername]'>$w[leadername]</option>";
												}
										}

			echo "</select></td>
			</tr>
				<tr>
				<tr><td colspan='4' align='center'>
				<input type=submit value='Export Excel Stock leader'>
                 </form></td></tr>
				
				</table><br><br>
				
				
<form method='POST' action='modul/sto/konvert_excel_qty_leader.php' onSubmit='return validasi(this)' enctype='multipart/form-data'>
	<h2>Data Count Sheet</h2>
		<table width='350'>
		<tr>
			<td>LEADER</td><td colspan='3'>
			<select name='leader' id='lead'>";
			
			$tampil=mysql_query("SELECT leadername  FROM leader GROUP BY leadername  ORDER BY leadername ASC");
           while($w=mysql_fetch_array($tampil)){
									if ($_POST['leadername']==$w['leadername']){
										echo "<option value='$w[leadername]' selected>$w[leadername]</option>";
													}
											else{
												echo "<option value='$w[leadername]'>$w[leadername]</option>";
												}
										}

			echo "</select></td>
			</tr>
				<tr>
				<tr><td colspan='4' align='center'>
				<input type=submit value='Export Excel Stock leader'>
                 </form></td></tr>
				
				</table><br><br>";
  break;

case "leaderprint":

 echo "<h2>Print Tag</h2>
		<form method='POST' class='form' action='modul/sto/konvert_pdf.php' target='_blank' onSubmit='return validasi1(this)' enctype='multipart/form-data'>  <table>
			<input type='hidden' name='parameter' value='lead'>
			<table width='350' class='noborder'>
			<tr>
			<td>LEADER</td><td colspan='3'>
			<select name='leader' id='lead'>";
			
			$tampil=mysql_query("SELECT leadername  FROM leader GROUP BY leadername  ORDER BY leadername ASC");
           while($w=mysql_fetch_array($tampil)){
									if ($_POST['leadername']==$w['leadername']){
										echo "<option value='$w[leadername]' selected>$w[leadername]</option>";
													}
											else{
												echo "<option value='$w[leadername]'>$w[leadername]</option>";
												}
										}
			echo "</select>&nbsp;</td>
			</tr>
			<tr>
			<td colspan='4'  align='center'><input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'></form></td>
			</tr>
			
			</table><br><br>";
  break;
  
  
  case "display":
?>
 <script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "getdisplay.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
 
 <?php 
 
 echo "<h2>Display Tag</h2>
		 <table>
			<tr>
			<td width='150'>TAG ID </td>     <td colspan='3'><input type='text' Name='StId' size='6'  onkeyup='showHint(this.value)' width='10' maxlength='5'></td></tr>
			</table><br>
			<span id='txtHint'></span>";
  break;
  
  
  
  
  case "tagkosong":
   
 echo "<h2>Print Tag Kosong</h2>
		<form method='POST' class='form' action='modul/sto/konvert_pdf_kosong.php' target='_blank' onSubmit='return validasi1(this)' enctype='multipart/form-data'>  <table>
			<table width='350' class='noborder'>
			<tr>
			<td width='150'>JUMLAH TAG </td>
			<td colspan='2'>
			<input type='text' name='valuetag'  size='15' maxlength='4' placeholder='JUMLAH TAG' id='tag1'></td>
			</tr>
			</tr>
			<tr>
			<td colspan='4'  align='center'><input type='submit' value='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'></form></td>
			</tr>
			
			</table><br><br>";
  break;
  
}
?>
