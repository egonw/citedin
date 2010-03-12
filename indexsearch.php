<link type="text/css" href="citedin.css" rel="stylesheet">

<?php
   if (isset($_GET["pubmed_query"])){
	$query = $_GET["pubmed_query"];
	$queryResults = simplexml_load_string(file_get_contents("http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&term=$query&retmax=30&usehistory=y&tool=citedin&email=andra.waagmeester@bigcat.unimaas.nl"));
	//print_r($queryResults);
	$webenv = $queryResults->WebEnv;
	$querykey = $queryResults->QueryKey;
	print "<hr>";
	
	$pubmed_xml= new DOMDocument;
 $pubmed_xml->loadXML(file_get_contents("http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&WebEnv=$webenv&mode=xml&query_key=$querykey&tool=citedin&email=andra.waagmeester@bigcat.unimaas.nl"));
	  $pubmed_xsl = new DOMDocument;
	  $pubmed_xsl->load('resources/pubmedSubmit.xsl');

	// Configure the transformer
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($pubmed_xsl); // attach the xsl rules

	print "<div id=\"row\">";

	   echo $proc->transformToXML($pubmed_xml);
	print "</div>";
}

?>
