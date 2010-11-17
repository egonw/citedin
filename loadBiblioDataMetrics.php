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
			 <link type="text/css" href="citedin.css" rel="stylesheet" />

		        <script type="text/javascript">
		            hs.graphicsDir = 'highslide/graphics/';
		            hs.outlineType = 'rounded-white';
		            hs.wrapperClassName = 'draggable-header';
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

	print "The requested InCiI score is not in our cache, which means that it either not yet calculated, or the last calculation is out-of-date. You can initiate a InCiI score calculation by completing the following form. Calculating a InCiI-score requires a federated search procedure. Different online resource are consulted. To prevent overloading these resource, we actively dose the requests. If you like to calculate the InCiI-score, you can initiate a calculation by filling the following form. An email or Twitter message will be sent, once the score is updated. <hr>
	<FORM action = \"UpdateIncii.php\" method =\"post\">
	<input name=\"pmids\" type=\"hidden\" value=\"".$_GET["pmids"]."\">
	<input name=\"incache\" type=\"hidden\" value=\"$incache\">
	<input name=\"bitlyUrl\" type=\"hidden\" value=\"$bitlyUrl\">
	<input name=\"notincache\" type=\"hidden\" value=\"$notincache\">
	Email: <input name=\"email\" id=\"Email\" type=\"text\" size=\"75\"/><br>
	Twitter: <input name=\"twitter\" id=\"Twitter\" type=\"text\" size=\"75\"/><br>
	<input type=\"submit\" value=\"Start CInCi-score calculation\"></form>";
}
else {
	$sqlProfile = "SELECT u.updateDate, r.Resource, r.freq from InCiIUpdate u, InCiIResources r where u.PMID IN (".$_GET["pmids"].") AND u.IUId=r.IUId;";
	$result = mysql_query($sqlProfile);
	$profile = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	    if (!(array_key_exists($row["Resource"], $profile))) $profile[$row["Resource"]]  = 0; 
	    $profile[$row["Resource"]] += $row["freq"];
	    $InCiIScore += $row["freq"];

	}
	
print "InCiI Score: $InCiIScore <br>";

    $resultArrays = array();
    $values = array_values($profile);
    $keys =  array_keys($profile);
    for ($i=0; $i<count($values);$i++){
	    array_push($resultArrays, $keys[$i]."+(".$values[$i].")");
    }
 
    var_dump($resultArrays);
  
    
	$url = "http://chart.apis.google.com/chart?cht=p3&chtt=InCiI+Profile&chs=512x214&chd=t:".implode(",",$resultArrays)."&chl=".implode("|", array_keys($profile));
	print "<IMG SRC=\"$url\">";
	
	$timeUrl = "http://chart.apis.google.com/chart?chs=440x220&cht=lxy&chco=3072F3,FF0000&chd=t:10,20,40,80,90,95,99|20,30,40,50,60,70,80|-1|5,10,22,35,85&chdl=Ponies|Unicorns&chdlp=b&chls=2,4,1|1&chma=5,5,5,25";
	
	print "<h3>Collection</h3>This score is calculated for the following collection of citations.";
	print file_get_contents("http://www.citedin.org/indexsearch.php?pubmed_query=".$_GET["pmids"]);
}
	
		
?>
</div>
</div>
</body>
</html>	
