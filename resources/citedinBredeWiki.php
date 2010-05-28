<?php
require_once("ResourceRegistry.php");

class BredeWikiResource implements Resource {
	function getResourceName() { return "Brede Wiki: a neuroinformatics wiki"; }
	function getInfoLink() { return "http://neuro.imm.dtu.dk/wiki/Main_Page"; }
	function getResourceType() { return "Wiki"; }
	function getResourceDescription() { return "Brede Wiki is a wiki with structured information from neuroscience. It contains primarily information from published peer-reviewed neuroimaging articles."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	
		$data = new ResourceData();
		$data->setResourceName($this->getResourceName())
			->setInfoLink($this->getInfoLink());
		$contents = file_get_contents("http://neuro.imm.dtu.dk/w/api.php?format=json&action=query&list=search&srwhat=text&srsearch=$pmid");
              $json = json_decode($contents, true);	
			
			$data->setCiteCount(count($json));
			$data->setDetailsLink("http://neuro.imm.dtu.dk/wiki/Special:Search?search=$pmid");

		return $data;
	}
}

ResourceRegistry::register("BredeWiki", new BredeWikiResource());
?>
