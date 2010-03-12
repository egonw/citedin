<link type="text/css" href="citedin.css" rel="stylesheet">

<?php
   $pmid=$_GET["pmid"];
   $pubmed_xml= new DOMDocument;
  $pubmed_xml->loadXML(file_get_contents("http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=$pmid&retmode=xml"));
  $pubmed_xsl = new DOMDocument;
  $pubmed_xsl->load('pubmed.xsl');

// Configure the transformer
$proc = new XSLTProcessor;
$proc->importStyleSheet($pubmed_xsl); // attach the xsl rules
  
print "<hr><div id=\"row\">";

   echo $proc->transformToXML($pubmed_xml); 
print "</div>"
?>
