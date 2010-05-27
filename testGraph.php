<html> 
<head> 
</head>
<body>
<?php
require_once("resources/ResourceRegistry.php");
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();
print "<table><thead><tr><td></td>";
foreach ($citedin_resources as $resource){
	print "<th scope=\"col\">$resource</th>";
}
$pmid = "15489334";
print "</tr></thead><tbody><tr><th scope=\"row\"></th>";
print "<tr><th scope=\"row\">$pmid</th>";
$datapoints = array();
$datanames = array();
foreach ($citedin_resources as $resource) {
	$resourceObject = ResourceRegistry::get($resource);
	$data = $resourceObject->getData($pmid);
	if (($data->getCiteCount()>0) AND (is_int($data->getCiteCount()))) {
	 array_push($datapoints, $data->getCiteCount());
	 array_push($datanames, $resource);
	}
     print "<td>".$data->getCiteCount()."</td>";    	
}

print "</tr></table>";
$urlimage = "http://chart.apis.google.com/chart?cht=p&chs=512x214&chtt=Citation+distribution&chd=t:".implode(",", $datapoints)."&chl=".implode("|",$datanames);
print "<img src = \"$urlimage\">";
print $urlimage;
?>