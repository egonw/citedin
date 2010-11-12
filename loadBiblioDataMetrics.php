<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>
			Citedin: Internet Citation Index (InCiI)
        </title>

        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <link type="text/css" href="development-bundle/themes/custom-theme/ui.all.css" rel="stylesheet">
        <script type="text/javascript" src="highslide/highslide-with-html.js"></script>
        <link rel="stylesheet" type="text/css" href="highslide/highslide.css" />
        <script type="text/javascript" src="development-bundle/ui/ui.core.js"></script>
        <script type="text/javascript" src="development-bundle/ui/ui.tabs.js"></script>
        <script type="text/javascript" src="js/jquery.tinysort.min.js"></script>
        <script type="text/javascript" src="js/jquery.corner.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $("#tabs").tabs();
            });
        </script>


</head>
		<body>
		<div id="tabs">
            <ul>
                <li>
                    <a href="#fragment-1"><span>CitedIn Internet Citation Index (CInCi)</span></a>
                </li>
			</ul>
		<div id="fragment-1">
           
				
<h2>Internet Citation Index (InCiI)</h2>
The Internet Citation Index or InCiI is a vector containing the number of resources citing a publication and for a each resource the number of times one or a set of publications is cited in the specific resource. 
<p>
  

<?php
include 'resources/connectdb.inc';
$pmids = explode(",", $_GET["pmids"]);
$queryUrl = "http://www.citedin.org/loadBiblioDataMetrics.php?pmids=".$_GET["pmids"];
$bitlyUrl = file_get_contents( "http://api.bit.ly/v3/shorten?login=citedin&apiKey=R_f5897d878d1f52b72a57bdd3e380c4a2&longUrl=$queryUrl&format=txt");
$sql = "SELECT * from InCiIUpdate where pmid IN (".$_GET["pmids"].")";
$result = mysql_query($sql);
$incache = mysql_num_rows($result);
$notincache =  count($pmids) - $incache;

if ($notincache > 0){
	   $notallInCache = TRUE;
    }


if ($notallInCache){

	print "The requested InCiI score is not in our cache, which means that it either not yet calculated, or the last calculation is out-of-date. You can initiate a InCiI score calculation by completing the following form. Calculating a InCiI-score requires a federated search procedure. Different online resource are consulted. To prevent overloading these resource, we actively dose the requests. If you like to calculate the InCiI-score, you can initiate a calculation by filling the following form. An email will be sent, once the InCiI score is updated. <hr>
	<FORM action = \"UpdateIncii.php\" method =\"post\">
	<input name=\"pmids\" type=\"hidden\" value=\"".$_GET["pmids"]."\">
	<input name=\"incache\" type=\"hidden\" value=\"$incache\">
	<input name=\"bitlyUrl\" type=\"hidden\" value=\"$bitlyUrl\">
	<input name=\"notincache\" type=\"hidden\" value=\"$notincache\">
	<input type=\"submit\" value=\"Start InCiI-score calculation\"></form>";
}
else {
	$sqlProfile = "SELECT r.Resource, r.freq from InCiIUpdate u, InCiIResources r where u.PMID IN (".$_GET["pmids"].") AND u.IUId=r.IUId;";
	$result = mysql_query($sqlProfile);
	$profile = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	    if (!(array_key_exists($row["Resource"], $profile))) $profile[$row["Resource"]]  = 0; 
	    $profile[$row["Resource"]] += $row["freq"];
	    $InCiIScore += $row["freq"];
	      
	}
	
print "InCiI Score: $InCiIScore <br>";

    
	$url = "http://chart.apis.google.com/chart?cht=p3&chtt=InCiI+Profile&chs=320x100&chd=t:".implode(",",array_values($profile))."&chl=".implode("|", array_keys($profile));
	print "<IMG SRC=\"$url\">";
}
	
		
?>
</div>
</div>
</body>
</html>	
