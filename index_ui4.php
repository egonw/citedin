<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>
			Citedin: A webtool to explore citations on the web
		</title>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
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
			
			var CitedIn = {};
			CitedIn.afterResourceLoad = function() {
				//Sort the results
				$("#resultaten>div").tsort("div.numberInSources", { order:"desc" });
				//Apply rounded corners
				$(this).corner();
			}
		</script>
		<script type="text/javascript" src="http://github.com/malsup/blockui/raw/master/jquery.blockUI.js?v2.31"></script>
		<link type="text/css" href="citedin.css" rel="stylesheet" />

		<script type="text/javascript">
			hs.graphicsDir = 'highslide/graphics/';
			hs.outlineType = 'rounded-white';
			hs.wrapperClassName = 'draggable-header';
		</script>	
	</head>
	<body>


		<?php

				function getDoi($pmid) {
						$results = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=$pmid&retmode=xml";
						$xml_results=file_get_contents($results);
						$doc= new DOMDocument();
						$doc->loadXML($xml_results);
						$articleid = $doc->getElementsByTagName("ArticleId");
						for ($k=0;$k<$articleid->length; $k++){
								 if ($articleid->item($k)->getAttribute("IdType")=="doi"){
										  $doi=$articleid->item($k)->nodeValue;
										   break;
								 }
						}
						return $doi;
				}
				set_time_limit(0);

				?>

		<div id="tabs">
			<ul>
				<li>
					<a href="#fragment-1"><span>Citedin</span></a>
				</li>
				<li>
					<a href="#fragment-2"><span>Resources</span></a>
				</li>
				<li>
					<a href="#fragment-3"><span>Suggest resources</span></a>
				</li>
				<li>
					<a href="#fragment-4"><span>About citedin</span></a>
				</li>
			</ul>
			<div id="fragment-1">
				Citedin finds where you are cited! Some of your papers may have been mentioned where you didn’t expect that to happen: in blogs, databases, Wikipedia. Citedin finds them all.
				<?php
				$resources = scandir('resources/');
				$citedin_resources = array();
				foreach ($resources as $resource){
					if (substr_count($resource, "citedin")>0){
						 array_push($citedin_resources, basename($resource, ".php"));
					}
				}   
				
				
				if (isset($_GET["pmid"])){
					    $pmidGet = $_GET["pmid"];
						print "<script>
						  		$(document).ready(function(){\n
										
									var pmid = $(\"input#pmid\").val();\n"; 
									print 		"$(\"#pubmedDetails\").load(\"resources/getPubmed.php?pmid=\"+pmid);\n";
									foreach ($citedin_resources as $div){
										print "$(\"#$div\").load(\"resources/$div?pmid=\"+pmid, CitedIn.afterResourceLoad);\n";
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
															foreach ($citedin_resources as $div){
																print "$(\"#$div\").load(\"resources/$div?pmid=\"+pmid, CitedIn.afterResourceLoad);\n";
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
										print "<DIV id=\"$div\" class=\"contentf\"></DIV>";
								}
								print "</div></div>";
								?>
			
			
			<div id="fragment-2">
				<?php //include("included_resources.php"); ?>
			</div>
			<div id="fragment-3">
				If you know a resource that would enrich this website please send us an <a href="mailto:andra.waagmeester@bigcat.unimaas.nl">email</a><p>
 				Three types of resources are fit to be included in citedin.org, these are: 
 				<ul>
					<li><b>Resources with webservices or an Application Programming Interface (API)</b>, which have functionality to search for pubmed identifiers. Examples with an API, are Wikipedia, Google Books, Google Blog and Connotea.</li>
					<li><b>Complete databases dumps.</b> Most of the resources in citedin.org are obtained through parsing online available database dumps.</li>
					<li><b>Supplementary data to published papers</b>. Some peer reviewed journal publication contain, next to the genereal references, appendices with (large) sets of pubmed identifiers. These citations, which are available as supplementary data are usually not considered as part of the papers bibliography. </li>
			</div>
			<div id="fragment-4">
				<?php include("about_citedin.html"); ?>
			</div>
		</div>
	</body>
</html>
