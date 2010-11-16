<?
include 'resources/connectdb.inc';

require_once("resources/ResourceRegistry.php");
require 'tweet.php';
require_once "Mail.php";

set_time_limit(0);
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();
$pmids = explode(",", $argv[1]);
$publications = count($pmids);
$bitlyUrl = $argv[2];
$email = $argv[3];
$twitter = $argv[4];

//$pmids = array("1234567", "7654321");
foreach ($pmids as $pmid){
	$sqlUpdate = "INSERT INTO InCiIUpdate (pmid, UpdateDate) VALUES ($pmid, CURDATE());";
	mysql_query($sqlUpdate);
	echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
	if (mysql_error($link)=="") {
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
	}}
}

	$sqlProfile = "SELECT r.Resource, r.freq from InCiIUpdate u, InCiIResources r where u.PMID IN (".$argv[1].") AND u.IUId=r.IUId;";
	$result = mysql_query($sqlProfile);
	$profile = array();
	$InCiIScore = 0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	    if (!(array_key_exists($row["Resource"], $profile))) $profile[$row["Resource"]]  = 0; 
	    $profile[$row["Resource"]] += $row["freq"];
	    $InCiIScore += $row["freq"];
	      
	}
	$resourceCount = count(array_keys($profile));
    $averageCited = round($InCiIScore/$resourceCount,2);

if($twitter!=""){
$tweet = "@$twitter Collection:$bitlyUrl contained $publications pubmed citation that were on average cited $averageCited in $resourceCount resources.";
$retarr = post_tweet(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET,
                           $tweet, $access_token, $access_token_secret,
                           true, true);

					 
}
if ($email !=""){
					 $from = "CitedIn <donotreply@citedin.org>";
					 $to = $email;
					 $subject = "Your CitedIn Internet Citation Score";
					 $body = "Collection:$bitlyUrl contained $publications pubmed citation that were on average cited $averageCited in $resourceCount resources.";

					 $host = "smtp.maastrichtuniversity.nl";
					 $username = "andra.waagmeester";
					 $password = "";

					 $headers = array ('From' => $from,
					   'To' => $to,
					   'Subject' => $subject);
					 $smtp = Mail::factory('smtp',
					   array ('host' => $host,
					     'auth' => false,
					     'username' => $username,
					     'password' => $password));

					 $mail = $smtp->send($to, $headers, $body);

					 if (PEAR::isError($mail)) {
					   echo("<p>" . $mail->getMessage() . "</p>");
					  } else {
					   echo("<p>Message successfully sent!</p>");
					  }
}
