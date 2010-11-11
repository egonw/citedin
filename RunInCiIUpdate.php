<?
include 'resources/connectdb.inc';

require_once("resources/ResourceRegistry.php");
require 'tweet.php';

set_time_limit(0);
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();
$pmids = explode(",", $argv[1]);
$bitlyUrl = $argv[2];
//$pmids = array("1234567", "7654321");
foreach ($pmids as $pmid){
	$sqlUpdate = "INSERT INTO InCiIUpdate (pmid, UpdateDate) VALUES ($pmid, CURDATE());";
	mysql_query($sqlUpdate);
	$lastUpdateId = mysql_insert_id();
    foreach ($citedin_resources as $resource){
		$resourceInfo = ResourceRegistry::get($resource);
		print $resource;
		$resourceName = $resourceInfo->getResourceName();
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

	$sqlProfile = "SELECT r.Resource, r.freq from InCiIUpdate u, InCiIResources r where u.PMID IN (".$argv[1].") AND u.IUId=r.IUId;";
	$result = mysql_query($sqlProfile);
	$profile = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	    if (!(array_key_exists($row["Resource"], $profile))) $profile[$row["Resource"]]  = 0; 
	    $profile[$row["Resource"]] += $row["freq"];
	    $InCiIScore += $row["freq"];
	      
	}
	$resourceCount = count(array_keys($profile));



$tweet = "@andrawaag Your query: $bitlyUrl resulted in a InCiI-score of $InCiIScore on $resourceCount resources";
$retarr = post_tweet(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET,
                           $tweet, $access_token, $access_token_secret,
                           true, true);
