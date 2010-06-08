
<html>
<head>
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		</head>
		<body>


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