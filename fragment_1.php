	<?php
print "<p>Citedin finds where you are cited! Some of your papers may have been mentioned where you didn't expect that to happen: in blogs, databases, Wikipedia. Citedin finds them all.";


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
						var total=0;
						var noResources = 0;
						var datapoints = new Array();
						var datanames = new Array();
						var max = 0;
						var range = \"\";
						$(\".numberCited\").each(function(){
					        total +=parseInt($(this).text());
					    	if (parseInt($(this).text()) > max) max = parseInt($(this).text());
					        noResources++;
					        datapoints.push($(this).text());
					   		datanames.push(escape($(this).siblings(\"#sourceName\").text()+\"(\"+$(this).text()+\")\"));
						});\n
						$(\".aggregatedResults\").empty();
						$(\".aggregatedResults\").append(\"OPD-index: \"+total);
						$(\".aggregatedResults\").append(\"<br>Resources citing: \"+noResources);
						if (max >100) range = \"&chds=0,max\";
						urlimage = \"http://chart.apis.google.com/chart?cht=p&chs=512x214\"+range+\"&chtt=Citation+distribution&chd=t:\"+datapoints.join(\",\")+\"&chl=\"+datanames.join(\"|\");
						$(\".aggregatedResults\").append(\"<br><img src=\"+urlimage+\">\");
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
	<a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='Waagmeester';\">Waagmeester</a>, 
	<a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='Kelder';\">Kelder</a>, <a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='Evelo';\">Evelo</a>, or <a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='WikiPathways';\">WikiPathways</a>) or <br>
	Pubmed identifier: (<a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='15489334';\">15489334</a>, <a style=\"cursor:pointer;text-decoration: underline;\" onclick=\"document.getElementById('pmidQuery').value='18651794';\">18651794</a>)</SPAN></P>
	<center><table><tr><td>
	<form id=\"queryForm\"><input name=\"pmidQuery\" id=\"pmidQuery\" type=\"text\" size=\"75\"/></td></tr>
	<tr><td align = \"center\"><button type=\"submit\" id=\"citedinQuery\">Cited In...</button></form></td></tr></table></center><P CLASS=copyright>Citations search powered by Pubmed <button class=\"scorehelp\">?</button><br>
		<script>
		  $(document).ready(function() { 
		    $(\"button.scorehelp\").click(function () {
				        $.blockUI({  theme:     true, title: 'Citations search powered by Pubmed', message: $('#pubmedhelp'), css: { width: '275px' } });  

				    });
			$('#no').click(function() { 
					            $.unblockUI(); 
					  });
				});
		</script></P>";
print "<div id=\"startexplain\"><p>
</div>";

print "<script type=\"text/javascript\">\n
	$(document).ajaxStop($.unblockUI);
	   $(document).ajaxSuccess(function() {
		var total = 0;
		$(\"numberCited\").each(function(){
	           total +=parseInt($(this).text());
	});\n
		$(\".aggregatedResults\").empty();
	  if (total > 0){
		$(\".aggregatedResults\").append(total);
	  }
	});\n
$(document).ready(function(event){\n
		$(\"#queryForm\").submit(function(event){\n

        if (event.preventDefault) { event.preventDefault(); } else { event.returnValue = false; }	
                $(\"#startexplain\").empty();	
		var query = $(\"input#pmidQuery\").val().replace(/\s/g, \"+\");\n
     
  		var patt1=new RegExp(\"^[0-9]+$\");
 		if (!(patt1.test(query)))\n 
			{\n
				$.blockUI({ message: '<h1><img src=\"pix/wait.gif\" /> Loading data ...</h1>' });
				$(\"#pubmedDetails\").empty();
				$(\".contentf\").empty();
 				$(\"#pubmedresultaten\").load(\"indexsearch.php?callscript=citedin&pubmed_query=\"+query);\n;
			}\n
		if (patt1.test(query))\n
			{
				$(\"#pubmedresultaten\").empty();
				$(\"#pubmedDetails\").load(\"resources/getPubmed.php?pmid=\"+query);\n";
				foreach ($citedin_resources as $resource){
					$resourceInfo = ResourceRegistry::get($resource);
					$resourceName = $resourceInfo->getResourceName();
					$fileName = basename($resourceInfo->getResourceFilename());	
					print "$(\"#".basename($fileName, ".php")."\").load(\"$url"."resources/getHTML.php?pmid=\"+query+\"&resource=$resource&script=$fileName\", CitedIn.afterResourceLoad);\n";

				}
	print "	}
	}			
	);
});\n
</script>\n";

    print "<div class=\"aggregatedResults\"></div>\n";

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
	
		<div id="pubmedhelp" style="display:none; cursor: default"> 
		        
           This website uses the <a href = "http://eutils.ncbi.nlm.nih.gov" target = "_blank">E-utils</a>  of <a href ="http://www.pubmed.org" target = "_blank">Pubmed</a> to find relevant citations. The same syntaxis of queries as on Pubmed apply here. A good tutorial on searching pubmed can be found <a href ="http://www.ncbi.nlm.nih.gov/books/NBK3827/#pubmedhelp.PubMed_Quick_Start" target="_blank">here<a>(Tutorial are from pubmed and will appear on a new page. Close this page to return to this screen)<p />  

Example: To find all publication of Smith J, type "Smith J[au]"<p /> 
		        <input type="button" id="no" value="Exit" /> 
		</div>
