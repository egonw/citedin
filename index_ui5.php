<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>
			Citedin: A webtool to explore citations on the web
		</title>
		
		<script type="text/javascript" src="jquery.js"></script>  
		<script type="text/javascript">  
		$(window).load(function(){  
		      $("#pleasewait").hide();  
		})  
		</script>
		<link type="text/css" href="development-bundle/themes/base/ui.all.css" rel="stylesheet">
		<script type="text/javascript" src="highslide/highslide-with-html.js">
</script>
		<link rel="stylesheet" type="text/css" href="highslide/highslide.css">
		<script type="text/javascript" src="http://jqueryui.com/latest/jquery-1.3.2.js">
</script>
		<script type="text/javascript" src="development-bundle/ui/ui.core.js">
</script>
		<script type="text/javascript" src="development-bundle/ui/ui.tabs.js">
</script>
		<script type="text/javascript">
$(document).ready(function(){
				$("#tabs").tabs();
		});
		</script>
		<link type="text/css" href="citedin.css" rel="stylesheet">

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
					<script type="text/javascript">
						$(function() {
							$("#tabs").tabs({
								event: 'mouseover';
							});
						});
						</script>
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
										print "$(\"#$div\").load(\"resources/$div?pmid=\"+pmid);\n";
									}
									print "});\n
								</script>\n";
				}
					
					
					print "<center><link rel=\"stylesheet\" type=\"text/css\" href=\"andra.css\">
								<table><tr><td>PubMed query</td><td><input name=\"pmidQuery\" id=\"pmidQuery\" type=\"text\" value=\"Wikipathways\"\"/><input type=\"submit\" id=\"citedinQuery\" value=\"Submit\" /></td></tr><tr><td>PubMed identifier</td><td><input name=\"pmid\" id=\"pmid\" type=\"text\" value=\"$pmidGet\" /><input type=\"submit\" id=\"citedin\" value=\"Submit\" /></td></tr></table></center>";

print "							<div id=\"pleasewait\">  
							Loading content, please wait..  
							<img src=\"pix/wait.gif\" alt=\"loading..\" />  
							</div>";		

								   


								print "<script type=\"text/javascript\">\n
	
												$(document).ready(function(){\n
													    $(\"pleasewait\").hide();
														$(\"#citedin\").click(function(){\n
															var pmid = $(\"input#pmid\").val();\n"; 
															print "$(this).attr(\"disabled\", \"disabled\").val(\"Please wait...\");\n";
															
															print 		"$(\"#pubmedDetails\").load(\"resources/getPubmed.php?pmid=\"+pmid);\n";
															foreach ($citedin_resources as $div){
																print "$(\"#$div\").load(\"resources/$div?pmid=\"+pmid);\n";
															}
															
															print "});\n
															$(\"#citedinQuery\").click(function(){
																$(\"pleasewait\").show();
																var query = $(\"input#pmidQuery\").val();\n";
																															
																print 		"$(\"#resultaten\").load(\"indexsearch.php?pubmed_query=\"+query);\n;
																$(\"#pleasewait\").hide();\n
															}	
															)});\n
															
												</script>\n";
								print "<div id=\"titelresultaten\">";
								print "<DIV id=\"pubmedDetails\"></DIV></div>";
								print "<div id=\"resultaten\">";
							
								foreach ($citedin_resources as $div){
										print "<DIV id=\"$div\"></DIV>";
								}
								print "</div></div>";
								?>
			
			
			<div id="fragment-2">
				<?php include("included_resources.php"); ?>
			</div>
			<div id="fragment-3">
				If you know a resource that would enrich this website please send us an <a href="mailto:andra.waagmeester@bigcat.unimaas.nl">email</a>
			</div>
			<div id="fragment-4">
				<?php include("about_citedin.html"); ?>
			</div>
		</div>
	</body>
</html>
