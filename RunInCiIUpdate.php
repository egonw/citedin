<?
include 'resources/connectdb.inc';

require_once("resources/ResourceRegistry.php");
set_time_limit(0);
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();
$pmids = explode(",", $_GET["pmids"]);

foreach ($pmids as $pmid){
	$sqlUpdate = "INSERT INTO InCiIUpdate (pmid, UpdateDate) VALUES ($pmid, CURDATE());";
	mysql_query($sqlUpdate);
	$lastUpdateId = mysql_insert_id();
    foreach ($citedin_resources as $resource){
		$resourceInfo = ResourceRegistry::get($resource);
		$resourceName = $resourceInfo->getResourceName();
		print $resource."<BR>";
		$resourceData = $resourceInfo->getData($pmid);
		$resourceCount = $resourceData->getCiteCount();
		if ($resourceCount > 0) {
		$sqlResource = "INSERT INTO InCiIResources (IUId, Resource, freq) VALUES ($lastUpdateId, \"$resource\", \"$resourceCount\");";
		print $sqlResource;
		$result = mysql_query($sqlResource);
		if (!$result) {
		    die('Invalid query: ' . mysql_error());
		}
	}
	}
}