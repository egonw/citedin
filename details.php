<html> 
<head> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<link type="text/css" href="development-bundle/themes/custom-theme/ui.all.css" rel="stylesheet">
<script type="text/javascript" src="highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="highslide/highslide.css" />
<script type="text/javascript" src="development-bundle/ui/ui.core.js"></script>
<script type="text/javascript" src="development-bundle/ui/ui.tabs.js"></script>
<script type="text/javascript" src="js/jquery.tinysort.min.js"></script>
<script type="text/javascript" src="js/jquery.corner.js"></script>
<script src="js/jquery.dataTables.js">

</script> 
<style type="text/css">
table{width:100%} </style> 
 
<script> 
<?php
$pmid=$_GET["pmid"];
$db = $_GET["db"];
$fields = $_GET["fields"];

print "
$(document).ready(function(){ 
$('#the_table').dataTable({ 
	\"bJQueryUI\": true,
'sAjaxSource':\"testDetails.php?db=$db&pmid=$pmid&fields=$fields\"
}); 
}); ";
?>
</script> 
</head> 
<body>
<div style="width:500px;margin:auto;"> 
<table id="the_table"> 
<thead>
<tr>
<?php
$fields = explode(",", $_GET["fields"]);
foreach ($fields as $field){
	print "<th>$field</th>\n";
}
?> 
</tr> 
</thead> 
<tbody> 
</tbody> 
</table> 
</div> 

</body> 
</html