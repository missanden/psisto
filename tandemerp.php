<html>
<head>
<title></title>
<script type="text/javascript" src="../nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
</script>
<link href="style5.css" rel="stylesheet" type="text/css" />
</head>
<body>
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
        xmlhttp.open("GET", "getdisplayerp.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
<div id="header"><center><img src='images/logo.png'></center>
 <div id="content">
 
<?php

include "config/koneksi.php";


 echo "<h2>ERP TANDEM</h2>
		 <table>
			<tr>
			<td width='150'>WAREHOUSE </td>     <td colspan='3'>
			<select name='warehouse' onchange='showHint(this.value)'>
			<option value='' selected> CHOOSE  </option>
			<option value='all' selected> ALL  </option>";
			$tampil=mysql_query("SELECT warehouse FROM data_erp GROUP BY warehouse ORDER BY warehouse ASC");
			$row=mysql_num_rows($tampil);
			
			while($w=mysql_fetch_array($tampil)){
									
												echo "<option value='$w[warehouse]'>$w[warehouse]</option>";
												
										}

			echo"</select></td></tr>
			</table><br>
			<span id='txtHint'></span>";

?>
</div>
<div id="footer">
			PT Sanden Indonesia | Copyright &copy; 2015
		</div>
</div>