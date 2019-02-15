<?php
$aksi="modul/sto/aksi_sto.php";
switch($_GET['act']){
  
  case "searchsto":
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
 echo "<h2>Form Input Stock</h2>
		<form method='POST' action='$aksi?module=sto&act=update' onSubmit='return validasi(this)' enctype='multipart/form-data'>
          <table>
			<tr>
			<td width='150'>TAG ID </td>     <td colspan='3'><input type='text' Name='StId' size='4'  onkeyup='showHint(this.value)'></td></tr>
			<tr>
			<td>WAREHOUSE</td><td>
			<select name='StWh'>
			<option value='' selected> StWh </option>";
													
			$tampil=mysql_query("SELECT * FROM master_wh ORDER BY StWh ASC");
            while($w=mysql_fetch_array($tampil)){
              echo "<option value=$w[StWh]>$w[StWh]</option>";
            }
			
		echo "</select></td></tr>
			<tr>
			<td width='150'>QTY INPUT </td>     <td colspan='3'><input type='text' Name='qty' size='4'></td></tr>
			</tr>
			</table><br>
		  
		  
		  <span id='txtHint'></span>
		  ";
 
 
 
 
  break;	
  
}
?>
