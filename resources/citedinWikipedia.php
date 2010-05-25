<?php
require_once("ResourceRegistry.php");

class WikipediaResource implements Resource {
	function getResourceName() { return "Wikipedia"; }
	function getInfoLink() { return "http://en.wikipedia.org"; }
	function getResourceType() { return "Wiki"; }
	function getResourceDescription() { return "the free encyclopedia that anyone can edit."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	
		$data = new ResourceData();
		$data->setResourceName($this->getResourceName())
			->setInfoLink($this->getInfoLink());
			
		exec("curl \"http://en.wikipedia.org/w/api.php?format=xml&action=query&list=search&srsearch=$pmid\"", $printarray);
		$xml_results = $printarray[0];	
			$xml = simplexml_load_string($xml_results);
			
			$data->setCiteCount($xml->query->searchinfo["totalhits"]);
			$data->setDetailsLink("http://en.wikipedia.org/w/index.php?title=Special:Search&search=$pmid");

		return $data;
	}
}

ResourceRegistry::register("Wikipedia", new WikipediaResource());
?>
