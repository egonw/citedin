<?php 
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
				
print "<div id=\"row\"><div id=\"sourceName\">Pubmed:</div><div id=\"numberInSources\">". $id->length."</div><div id=\"details\"><a href=\"http://www.ncbi.nlm.nih.gov/sites/entrez?holding=&db=pubmed&cmd=search&term=".implode(",", $pmidquery)."\">Details</a></div></div>";

			}
		};

		//echo $doc->saveXML();
		
}
?>
