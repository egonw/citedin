<div id="ajaxBusy"><p><img src="pix/loading.gif"><br>Processing data...</p></div>
<?php

require_once("resources/ResourceRegistry.php");
set_time_limit(0);
ResourceRegistry::init();
$pmids = explode(",", $_GET["pmids"]);
$citedin_resources = ResourceRegistry::listResources();
//var_dump($citedin_resources);
$ohIndexTable = array();
$datapoints = array();
$datanames = array();
foreach ($citedin_resources as $resource){
	$resourceInfo = ResourceRegistry::get($resource);
	$resourceName = $resourceInfo->getResourceName();
	$data = $resourceInfo->getData($pmids[0]);
	$ohIndexTable[$resourceName] += $data->citeCount;
}

foreach (array_keys($ohIndexTable) as $resource){
	if ($ohIndexTable[$resource]>0){
		array_push($datapoints, $ohIndexTable[$resource]);
		array_push($datanames, $resource."(".$ohIndexTable[$resource].")");
        print $resource.": ".$ohIndexTable[$resource]."\n";
    }	
}

$urlimage = "http://chart.apis.google.com/chart?cht=p&chs=512x214".$range."&chtt=Citation+distribution&chd=t:".implode(",", $datapoints)."&chl=".implode("|", $datanames);

print "<img src=\"$urlimage\">";

?>
