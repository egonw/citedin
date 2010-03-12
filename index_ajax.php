<html>
	<head>
		<title>Citedin</title>
		<link rel="stylesheet" type="text/css" href="andra.css" />
		<script language="javascript" type = "text/javascript">
		  function getPmid(){
			var pmid document.getElementById("pmid").value;
		  } 

		</script>
	</head>

	<body><?php

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
        <form enctype=\"multipart/form-data\" action=\"index.php\" method=\"POST\">
        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"100000\" />
        <table><tr><td>PubMed identifier</td><td><input name=\"pmid\" type=\"text\" value=\"15489334\" /><input type=\"submit\" value=\"Submit\" /></td></tr></table></center>";

$divs= scandir('resources/');
foreach ($divs as $div){
    if (substr_count($div, "citedin")>0){
        print "<DIV id=\"".basename($div, ".php")."\"></DIV>\n";
    }
}

if ($_POST["pmid"]!=""){
        $pmid = $_POST["pmid"];
        $doi = urlencode(getDoi($pmid));
        $resources = scandir('resources/');
        foreach ($resources as $resource){
            if (substr_count($resource, "citedin")>0){
		print file_get_contents("http://www.bigcat.unimaas.nl/~andra/citedin/resources/$resource?pmid=$pmid&doi=$doi")." <hr>";
            }
        }

}
?>
	</body>
</html>
