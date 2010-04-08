<?php
class Pmid2Doi {
    public function getDoifromPmid($pmid){
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
}

?>