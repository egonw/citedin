
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
foreach ($pmids as $pmid){
    $result = mysql_query("SELECT * from InCiIUpdate where pmid=$pmid");
    if (mysql_num_rows($result)== 0){
	   $notInCache = TRUE;
	   break;
    }
}

if ($notInCache){
	print "The requested InCiI score is not in our cache, which means that it either not yet calculated, or the last calculation is out-of-date. The requested score is now being calculated in a federated search procedure, which means that each resource is checked for the latest version. This could lead to long respons times, we are working on an optimization to increase response times.";
foreach ($pmids as $pmid){
	$mysqldate = date ("Y-m-d");
	$sqlUpdate = "INSERT INTO InCiIUpdate (pmid, UpdateDate) VALUES ($pmid, $mysqldate);";
	mysql_query($sqlUpdate);
	}	
	
}

$pmids=$_GET["pmids"];
print "<script type=\"text/javascript\">
  		$(document).ready(function(){\n
	   			$(\"body\").append('<div id=\"ajaxBusy\"><p><img src=\"pix/loading.gif\"><br>Processing data...</p></div>');
     			$('#ajaxBusy').css({
				display:\"none\",
				margin:\"0px\",
				paddingLeft:\"0px\",
				paddingRight:\"0px\",
				paddingTop:\"0px\",
				paddingBottom:\"0px\",
				position:\"absolute\",
				left:\"30px\",
				top:\"130px\",
				width:\"auto\"
			});
			// Ajax activity indicator bound 
			// to ajax start/stop document events
			$(document).ajaxStart(function(){ 
				$('#ajaxBusy').show(); 
			}).ajaxStop(function(){ 
				$('#ajaxBusy').hide();
				});
				$('#graph').load(\"BiblioDataMetrics.php?pmids=$pmids\");
				});</script>";
	
				
?>
	
	<div id="graph"></div>
	</body>