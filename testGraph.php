
<?php
require_once("resources/ResourceRegistry.php");
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();

$pmid = $_GET["pmid"];
$datapoints = array();
$datanames = array();
$max=0;
$noResources = 0;
$wikiIndex =0;
foreach ($citedin_resources as $resource) {
	$resourceObject = ResourceRegistry::get($resource);
	$data = $resourceObject->getData($pmid);
	if (($data->getCiteCount()>0) AND (is_int($data->getCiteCount()))) {
		$noResources++;
		switch ($resourceObject->getResourceType()){
			case "Wiki":
				$wikiIndex++;
				break;
			case "Database":
				$databaseIndex++;
				break;
			case "API":
				$apiIndex++;
				break;
			case "Published data":
				$suplmIndex++;
				break;
		}
	 array_push($datapoints, $data->getCiteCount());
	if ($data->getCiteCount() > $max) $max = $data->getCiteCount();
	 array_push($datanames, $resource." (".$data->getCiteCount().")");
	}
	   	
}

if ($max >100) $range = "&chds=0,$max";
$urlimage = "http://chart.apis.google.com/chart?cht=p&chs=512x214$range&chtt=Citation+distribution&chd=t:".trim(implode(",", $datapoints))."&chl=".implode("|",$datanames);
print "<img src = \"$urlimage\">";
print "<hr>";
print "OPD index: $noResources<br>";
print "Wiki index:$wikiIndex<br>";
print "Database index: $databaseIndex<br>";
print "Webservice index: $apiIndex<br>";
print "Supplementary data index: $suplmIndex";
?>