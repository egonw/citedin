<?php
require_once("ResourceRegistry.php");

class WikipediaResource implements Resource {
	function getResourceName() { return "Wikipedia"; }
	function getInfoLink() { return "http://en.wikipedia.org"; }
	function getResourceType() { return "API"; }
	function getResourceDescription() { return "the free encyclopedia that anyone can edit."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	
		$data = new ResourceData();
		$data->setResourceName($this->getResourceName())
			->setInfoLink($this->getInfoLink());
			
		$results = "http://en.wikipedia.org/w/api.php?format=xml&action=query&list=search&srsearch=$pmid";
		//print $results;
		$headers = get_headers($results, 1);
		if ($headers[0] == "HTTP/1.1 200 OK"){ 
			$xml_results = file_get_contents($results);
			$xml = simplexml_load_string($xml_results);
			
			$data->setCiteCount($xml->query->searchinfo["totalhits"]);
			$data->setDetailLink("http://en.wikipedia.org/w/index.php?title=Special:Search&search=$pmid");
	   	} else {
	   		$data->setError($headers[0]);
		}
		return $data;
	}
}

ResourceRegistry::register("Wikipedia", new WikipediaResource());
?>
