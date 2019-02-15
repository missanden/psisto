 <html>
<head>
<title></title>
<script type="text/javascript" src="../nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
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
        xmlhttp.open("GET", "getdisplay.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
<div id="header"><center><img src='images/logo.png'></center>
 <div id="content">
 
 <?php 
 
 echo "<h2>Display Tag</h2>
		 <table>
			<tr>
			<td width='150'>TAG ID </td>     <td colspan='3'><input type='text' Name='StId' size='6'  onkeyup='showHint(this.value)' width='10' maxlength='5'></td></tr>
			</table><br>
			<span id='txtHint'></span>";
?>
</div>
<div id="footer">
			PT Sanden Indonesia | Copyright &copy; 2015
		</div>
</div>