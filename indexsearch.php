<link type="text/css" href="citedin.css" rel="stylesheet">

<?php

   if (isset($_GET["pubmed_query"])){
	$query = preg_replace('/\s/', '+', $_GET["pubmed_query"]);
	$queryResults = simplexml_load_string(file_get_contents("http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&term=$query&retmax=30&usehistory=y&tool=citedin&email=andra.waagmeester@bigcat.unimaas.nl"));

	$webenv = $queryResults->WebEnv;
	$querykey = $queryResults->QueryKey;
	//
	$pmids = array();
	foreach ($queryResults->IdList->Id as $id) array_push($pmids, $id);
	print "<hr>";
	
  //  if ($_GET["callscript"]=="citedin")	print "<a href=\"loadBiblioDataMetrics.php?pmids=".implode(",", $pmids)."\" target=\"_blank\">calculate CitedIn Internet Citation Score</a><hr>";

if ($_GET["callscript"]=="citedin") print "<form action=\"loadBiblioDataMetrics.php\" method=\"get\" accept-charset=\"utf-8\">
	<input type=\"hidden\" name=\"pmids\" value=\"".implode(",", $pmids)."\" id=\"pmids\">

	<p><input type=\"submit\" class=\"button\" value=\"calculate CitedIn Internet Citation Score\"></p>
</form><hr>";
	
	$pubmed_xml= new DOMDocument;
 $pubmed_xml->loadXML(file_get_contents("http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&WebEnv=$webenv&mode=xml&query_key=$querykey&tool=citedin&email=andra.waagmeester@bigcat.unimaas.nl"));
	  
  $PubmedArticles = $pubmed_xml->getElementsByTagName('PubmedArticle');
  foreach ($PubmedArticles as $PubmedArticle){
	print "<span class='pmidResult' id='pmidResult'".$PubmedArticle->MedlineCitation->PMID->nodeValue."</span>";
	print "<span class='pubmedTitle' id='pubmedTitle'".$PubmedArticle->MedlineCitation->Article->ArticleTitle->nodeValue."</span>";
} 	   
/*	  $pubmed_xsl = new DOMDocument;
	  $pubmed_xsl->load('resources/pubmedSubmit.xsl');

	// Configure the transformer
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($pubmed_xsl); // attach the xsl rules

	print "<div id=\"row\"><button type=\"button\">Remove from set</button>";

	   echo $proc->transformToXML($pubmed_xml);
	print "</div>";
	*/
}

?>
