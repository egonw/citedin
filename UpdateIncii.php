
<?
include 'resources/connectdb.inc';

require_once("resources/ResourceRegistry.php");
set_time_limit(0);
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();

$pmids = explode(",", $_POST["pmids"]);
print "Your requested InCiI-scoure is currently being calculated. It will appear once it is calculated. The result can also be sent to you: 
<FORM action = \"RequestMail.php\" method =\"post\">
<input name=\"pmids\" type=\"hidden\" value=\"".$_POST["pmids"]."\">
<input name=\"Email\" id=\"Email\" type=\"text\" size=\"75\"/><input type=\"submit\"></form>";


foreach ($pmids as $pmid){
	$sqlUpdate = "INSERT INTO InCiIUpdate (pmid, UpdateDate) VALUES ($pmid, CURDATE());";
	mysql_query($sqlUpdate);
	$lastUpdateId = mysql_insert_id();
    foreach ($citedin_resources as $resource){
		$resourceInfo = ResourceRegistry::get($resource);
		$resourceName = $resourceInfo->getResourceName();
		$resourceData = $resourceInfo->getData($pmid);
		$resourceCount = $resourceData->getCiteCount();
		$sqlResource = "INSERT INTO InCiIResource (IUId, Resource, freq) VALUES ($lastUpdateId, \"$resourceName\", $resourceCount);";
		print $sqlResource;
		$result = mysql_query($sqlResource);
		if (!$result) {
		    die('Invalid query: ' . mysql_error());
	}
}
?>
