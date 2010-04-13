<?php
print "Citedin finds where you are cited! Some of your papers may have been mentioned where you didn't expect that to happen: in blogs, databases, Wikipedia. Citedin finds them all.";
require_once("resources/ResourceRegistry.php");
set_time_limit(0);
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();
/*foreach ($citedin_resources as $resource) {
	$resourceInfo = ResourceRegistry::get($resource);
	$fileName = $resourceInfo->getResourceName();
	$className = $resourceInfo->getResourceClassname();
	$fileName = basename($resourceInfo->getResourceFilename());	
	print $resource."<BR>";
	//print file_get_contents("http://localhost/citedin/resources/getHTML.php?pmid=".$_GET["pmid"]."&script=$fileName&class=$className");
	break;
	
}*/
// var_dump($citedin_resources);				
if (isset($_GET["pmid"])){
	$pmidGet = $_GET["pmid"];
	print "<script>
	$(document).ready(function(){\n

		var pmid = $(\"input#pmid\").val();\n"; 
	print 		"$(\"#pubmedDetails\").load(\"resources/getPubmed.php?pmid=\"+pmid);\n";
	foreach ($citedin_resources as $resource){
		$resourceInfo = ResourceRegistry::get($resource);
		$resourceName = $resourceInfo->getResourceName();
		$className = $resourceInfo->getResourceClassname();
		$fileName = basename($resourceInfo->getResourceFilename());
		print "$(\"#".basename($fileName, ".php")."\").load(\"http://localhost/citedin/resources/getHTML.php?pmid=\"+pmid+\"&script=$fileName&class=$className\", CitedIn.afterResourceLoad);\n";
	}
	print "});\n
		</script>\n";
}


print "<center>
	<div id=\"rowSearch\">

	<div id=\"SearchBox\"><div class=\"ui-widget-header\">Publication search</div><div class=\"box_text\">Through this website you can track various resources citing a PubMed Identifier. To find a pubmed identifier use this search form.<br>
<P style=\"TEXT-ALIGN: right\"><SPAN style=\"FONT-SIZE: x-small\">(e.g. 
	<a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='Waagmeester';\">Waagmeester</a>, 
	<a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='Kelder';\">Kelder</a>, <a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='Evelo';\">Evelo</a>, or <a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='WikiPathways';\">WikiPathways</a>)</SPAN></P><input name=\"pmidQuery\" id=\"pmidQuery\" type=\"text\" /><input type=\"submit\" id=\"citedinQuery\" value=\"Submit\" /></div></div>
<div id=\"SearchBox\"><div class=\"ui-widget-header\">Resources citing a pubmed ID</div><div class=\"box_text\"> Submit a PubMed Identifier to find resources citing this abstract. <P style=\"TEXT-ALIGN: right\"><SPAN style=\"FONT-SIZE: x-small\">(e.g. 
	<a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmid').value='15489334';\">15489334</a>, <a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmid').value='18651794';\">18651794</a>)</SPAN></P><input name=\"pmid\" id=\"pmid\" type=\"text\" value=\"$pmidGet\" /><input type=\"submit\" id=\"citedin\" value=\"Submit\" /></div></div></div></center>";






print "<script type=\"text/javascript\">\n
	$(document).ajaxStop($.unblockUI);
$(document).ready(function(){\n

$(\"#citedin\").click(function(){\n
	var pmid = $(\"input#pmid\").val();\n"; 
	//															print 		"$(\"#pubmedDetails\").load(\"resources/getPubmed.php?pmid=\"+pmid);\n";
	foreach ($citedin_resources as $resource){
		$resourceInfo = ResourceRegistry::get($resource);
		$resourceName = $resourceInfo->getResourceName();
		$className = $resourceInfo->getResourceClassname();
		$fileName = basename($resourceInfo->getResourceFilename());	
		print "$(\"#".basename($fileName, ".php")."\").load(\"http://localhost/citedin/resources/getHTML.php?pmid=\"+pmid+\"&script=$fileName&class=$className\", CitedIn.afterResourceLoad);\n";
	}
	print "});\n

	$(\"#citedinQuery\").click(function(){
		$.blockUI({ message: '<h1><img src=\"pix/wait.gif\" /> Loading data ...</h1>' });	
		var query = $(\"input#pmidQuery\").val();\n";

		print 		"$(\"#resultaten\").load(\"indexsearch.php?pubmed_query=\"+query);\n;

	}	
	)});\n

		</script>\n";
	print "<div id=\"titelresultaten\">";
	print "<DIV id=\"pubmedDetails\"></DIV></div>";
	print "<div id=\"resultaten\">";

	foreach ($citedin_resources as $div){
		$resourceInfo = ResourceRegistry::get($div);
		$fileName = basename($resourceInfo->getResourceFilename());
		//var_dump($div);
		print "<DIV id=\"".basename($fileName, ".php")."\" class=\"contentf\"></DIV>";
	}
	print "</div>";
	?>