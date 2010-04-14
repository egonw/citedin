<?php 

require_once("ResourceRegistry.php");

class PmcResource implements Resource {
	function getResourceName() { return "Pubmed Central"; }
	function getInfoLink() { return "http://www.ncbi.nlm.nih.gov/pmc/"; }
	function getResourceType() { return "API"; }
	function getResourceDescription() { return "PubMed Central (PMC) is the U.S. National Institutes of Health (NIH) free digital archive of biomedical and life sciences journal literature."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
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
			$data->setResourceName($this->getResourceName())
					->setCiteCount($id->length)
					->setInfoLink($this->getInfoLink())
					->setDetailsLink("http://www.ncbi.nlm.nih.gov/sites/entrez?holding=&db=pubmed&cmd=search&term=".implode(",", $pmidquery));

			return $data;
			}
		};

		//echo $doc->saveXML();

	}
}

ResourceRegistry::register("PMC", new PmcResource());
?>
