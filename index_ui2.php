<html>
        <head>
                <title>Citedin: A webtool to explore citations on the web</title>
                <script type="text/javascript" src="jquery.js"></script>
                               <link type="text/css" href="development-bundle/themes/base/ui.all.css" rel="stylesheet" />
                <script type="text/javascript" src="http://jqueryui.com/latest/jquery-1.3.2.js"></script>
                <script type="text/javascript" src="development-bundle/ui/ui.core.js"></script>
                <script type="text/javascript" src="development-bundle/ui/ui.tabs.js"></script>

		<script type="text/javascript">
		  	$(document).ready(function(){
    		 	$("#tabs").tabs();
  		});
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
        <li><a href="#fragment-1"><span>Citedin</span></a></li>
        <li><a href="#fragment-2"><span>Resources</span></a></li>
        <li><a href="#fragment-3"><span>Suggest resources</span></a></li>
        <li><a href="#fragment-4"><span>About citedin</span></a></li>
    </ul>

        <div id="fragment-1">
<?php
   print "<center><link rel=\"stylesheet\" type=\"text/css\" href=\"andra.css\">
        <table><tr><td>PubMed identifier</td><td><input name=\"pmid\" id=\"pmid\" type=\"text\" value=\"15489334\" /><input type=\"submit\" id=\"citedin\" value=\"Submit\" /></td></tr></table></center>";

$resources = scandir('resources/');
$citedin_resources = array();
        foreach ($resources as $resource){
            if (substr_count($resource, "citedin")>0){
                 array_push($citedin_resources, basename($resource, ".php"));
            }
        }

print "<script type=\"text/javascript\">\n
                $(document).ready(function(){\n
                        $(\"#citedin\").click(function(){\n
		var pmid = $(\"input#pmid\").val();\n"; 
                print "$(\"#resultpane p\").load(\"resultpane.php\");\n";
foreach ($citedin_resources as $div){
	print "$(\"#".$div." p\").load(\"resources/$div?pmid=\"+pmid);\n";
}
                        print "});\n
                });\n
                </script>\n";

print "<DIV id=\"resultpane\"><p></p></div>\n";

/*foreach ($citedin_resources as $div){
        print "<DIV id=\"$div\"><p></p></DIV>\n";
}*/

?>
 </div>
    <div id="fragment-2">
	<?php include("included_resources.php"); ?>
    </div>
    <div id="fragment-3">
       If you know a resource that contains citations to pubmed abstracts or full texts, please send an email to: <a href = "mailto:andra.waagmeester@bigcat.unimaas.nl">andra.waagmeester@bigcat.unimaas.nl</a>
    </div>
    <div id="fragment-4">
 	<?php include("about_citedin.html"); ?> 
    </div>

</div>

</body>
</html>
