
<html>
<head>
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		</head>
		<body>
<h2>Internet Citation Index (InCiI)</h2>
The Internet Citation Index or InCiI is a vector containing the number of resources citing a publication and for a each resource the number of times one or a set of publications is cited in the specific resource. 
<p>
Since the InCiI is now calculated in a federated search procedure, which means that each resource is checked for the latest version. This could lead to long respons times, we are working on an optimization to increase response times.  

<?php


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