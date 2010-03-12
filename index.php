<html>
        <head>
                <title>Citedin: A webtool to explore citations on the web</title>
                <script type="text/javascript" src="jquery.js"></script>
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
foreach ($citedin_resources as $div){
	print "$(\"#".$div." p\").load(\"resources/$div?pmid=\"+pmid);\n";
}
                        print "});\n
                });\n
                </script>\n";

foreach ($citedin_resources as $div){
        print "<DIV id=\"$div\"><p></p></DIV>\n";
}

/*
if ($_POST["pmid"]!=""){
        $pmid = $_POST["pmid"];
        $doi = urlencode(getDoi($pmid));
        $resources = scandir('resources/');
        foreach ($resources as $resource){
            if (substr_count($resource, "citedin")>0){
		print file_get_contents("http://www.bigcat.unimaas.nl/~andra/citedin/resources/$resource?pmid=$pmid&doi=$doi")." <hr>";
            }
        }

}*/
?>
</body>
</html>
