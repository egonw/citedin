
<html>
<head>
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		</head>
		<body>
<h2>Internet Citation Index (InCiI)</h2>
The Internet Citation Index or InCiI is a vector containing the number of resources citing a publication and for a each resource the number of times one or a set of publications is cited in the specific resource. 
<p>
  

<?php
include 'resources/connectdb.inc';
$pmids = explode(",", $_GET["pmids"]);
$result = mysql_query("SELECT * from InCiIUpdate where pmid IN (".$_GET["pmids"].");");
$incache = mysql_num_rows($result);
$notincache =  count($pmids) - $incache;
$url = "http://chart.apis.google.com/chart?cht=p3&chs=250x100&chd=t:$incache,$notincache&chl=Cache|Not+in+cache";
print $url;
print "<IMG SRC=\"$url\">";
if (mysql_num_rows($result)== 0){
	   $notInCache = TRUE;
    }


if ($notInCache){
	print "The requested InCiI score is not in our cache, which means that it either not yet calculated, or the last calculation is out-of-date. You can initiate a InCiI score calculation by completing the following form. Calculating a InCiI-score requires a federated search procedure. Different online resource are consulted. To prevent overloading these resource, we actively dose the requests. If you like to calculate the InCiI-score, you can initiate a calculation by filling the following form. An email will be sent, once the InCiI score is updated. <hr>
	<FORM action = \"UpdateIncii.php\" method =\"post\">
	<input name=\"pmids\" type=\"hidden\" value=\"".$_GET["pmids"]."\">
	<input type=\"submit\" value=\"Start InCiI-score calculation\"></form>";
}	
	
		
?>
	
