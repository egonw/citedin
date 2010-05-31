<?php
print "Citedin finds where you are cited! Some of your papers may have been mentioned where you didn't expect that to happen: in blogs, databases, Wikipedia. Citedin finds them all.";
require_once("resources/ResourceRegistry.php");
set_time_limit(0);
ResourceRegistry::init();
$url = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]);
//print $url;
$citedin_resources = ResourceRegistry::listResources();

if (isset($_GET["pmid"])){
	    $pmidGet = $_GET["pmid"];
		print "<script>
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
						
					var pmid = $(\"input#pmid\").val();\n"; 
					print 		"$(\"#pubmedDetails\").load(\"resources/getPubmed.php?pmid=\"+$pmidGet);\n";
					foreach ($citedin_resources as $resource){
						$resourceInfo = ResourceRegistry::get($resource);
						$resourceName = $resourceInfo->getResourceName();
						$fileName = basename($resourceInfo->getResourceFilename());	
						print "$(\"#".basename($fileName, ".php")."\").load(\"$url/resources/getHTML.php?pmid=\"+$pmidGet+\"&resource=$resource&script=$fileName\", CitedIn.afterResourceLoad);\n;";
				}
					print "});\n
				</script>\n";
}

print "Through this website you can track various resources citing a PubMed Identifier. To find a pubmed identifier use this search form.<br>
<P style=\"TEXT-ALIGN: right\"><SPAN style=\"FONT-SIZE: x-small\">Examples: Pubmed query: (e.g. 
	<a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='Waagmeester';document.getElementById('queryoptions').value='Pubmed Query';\">Waagmeester</a>, 
	<a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='Kelder';\">Kelder</a>, <a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='Evelo';\">Evelo</a>, or <a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='WikiPathways';\">WikiPathways</a>) or <br>
	Pubmed identifier: (<a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='15489334';\">15489334</a>, <a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='18651794';\">18651794</a>)</SPAN></P>
	<center><img src = \"http://chart.apis.google.com/chart?cht=qr&chs=250x100&chl=http://www.citedin.org\"><br><table><tr><td>
	<form id=\"queryForm\"><input name=\"pmidQuery\" id=\"pmidQuery\" type=\"text\" size=\"75\"/></td></tr>
	<tr><td align = \"center\"><button type=\"submit\" id=\"citedinQuery\">Cited In...</button></form></td></tr></table></center>";
print "<div id=\"startexplain\"><p />

        Citedin.org is still under major development. This might cause unexpected behaviour. Comments are welcome and can be send to andra.waagmeester at bigcat.unimaas.nl</div>";
print "<script type=\"text/javascript\">\n
	$(document).ajaxStop($.unblockUI);
$(document).ready(function(event){\n
		$(\"#queryForm\").submit(function(event){\n
        if (event.preventDefault) { event.preventDefault(); } else { event.returnValue = false; }	
                $(\"#startexplain\").empty();	
		var query = $(\"input#pmidQuery\").val().replace(/\s/g, \"+\");\n
        var queryoption = $(\"select#queryoptions\").val();\n
  		var patt1=new RegExp(\"^[0-9]+$\");
 		if (!(patt1.test(query)))\n 
			{\n
				$.blockUI({ message: '<h1><img src=\"pix/wait.gif\" /> Loading data ...</h1>' });
				$(\"#pubmedDetails\").empty();
				$(\".contentf\").empty();
 				$(\"#pubmedresultaten\").load(\"indexsearch.php?pubmed_query=\"+query);\n;
			}\n
		if (patt1.test(query))\n
			{
				$(\"#pubmedresultaten\").empty();
				$(\"#pubmedDetails\").load(\"resources/getPubmed.php?pmid=\"+query);\n";
				foreach ($citedin_resources as $resource){
					
					$resourceInfo = ResourceRegistry::get($resource);
					$resourceName = $resourceInfo->getResourceName();
					$fileName = basename($resourceInfo->getResourceFilename());	
					print "$(\"#".basename($fileName, ".php")."\").load(\"$url"."resources/getHTML.php?pmid=\"+query+\"&resource=$resource&script=$fileName\", CitedIn.afterResourceLoad);\n;";
					$urlimage = "http://chart.apis.google.com/chart?cht=p&chs=512x214$range&chtt=Citation+distribution&chd=t:".trim(implode(",", $datapoints))."&chl=".implode("|",$datanames);
					
					print "$(\"$.numberInSources\").each( function(){
						total +=parseInt($(this).text());
					})";
					print "$(\"#aggregatedResults\").empty();$(\"#aggregatedResults\").append(total)\")";
			}
	print "	}
	}			
	);
});\n
</script>\n";
    print "<div id=\"aggregatedResults\"></div>\n";
	print "<div id=\"pubmedresultaten\"></div>\n";
	print "<DIV id=\"pubmedDetails\">\n</DIV>\n";
	print "<div id=\"resultaten\">\n";

	foreach ($citedin_resources as $div){
		$resourceInfo = ResourceRegistry::get($div);
		$fileName = basename($resourceInfo->getResourceFilename());
		print "<DIV id=\"".basename($fileName, ".php")."\" class=\"contentf\"></DIV>";
	}
	print "</div>";
	
	?>
