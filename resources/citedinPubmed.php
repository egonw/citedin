<?php 
require_once("ResourceFormatter.php");

if ($_GET["pmid"] != ""){
    $pmid = $_GET["pmid"];
	$results = file_get_contents("http://eutils.ncbi.nlm.nih.gov/entrez/eutils/elink.fcgi?dbfrom=pubmed&id=$pmid&cmd=neighbor&email=andra.waagmeester@bigcat.unimaas.nl");
	$doc = new DOMDocument();
	$doc->loadXML($results);
	
	$LinkSetDb = $doc->getElementsByTagName("LinkSetDb");
	for ($i=0; $i< $LinkSetDb->length; $i++){
		$linkname = $LinkSetDb->item($i)->getElementsByTagName("LinkName");
		if ($linkname->item(0)->nodeValue == "pubmed_pubmed_citedin"){
			$id = $LinkSetDb->item($i)->getElementsByTagName("Id");
			$pmidquery =array();
			for ($j=0;$j<$id->length; $j++){
				
				array_push($pmidquery, $id->item($j)->nodeValue);
			}
		//	$query=implode(",", $pmidquery);
			
			$data = new ResourceData();
			$data->setResourceName("Pubmed: Cited in Pubmed Central")
				->setCiteCount($id->length)
				->setInfoLink("http://www.pubmed.org")
				->setDetailsLink("http://www.ncbi.nlm.nih.gov/sites/entrez?holding=&db=pubmed&cmd=search&term=".implode(",", $pmidquery));
	
			print ResourceFormatter::getHTML($data);
		}
	};

		//echo $doc->saveXML();
		
}
?>
