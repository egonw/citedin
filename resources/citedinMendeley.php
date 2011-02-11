<?php

require_once("ResourceRegistry.php");

class MendeleyResource implements Resource {
	function getResourceName() { return "Mendeley"; }
	function getInfoLink() { return "http://www.mendeley.com/"; }
	function getResourceType() { return "API"; }
	function getResourceDescription() { return "Organize, share, and discover research papers! Mendeley is a research management tool for desktop & web. You can also explore research trends and connect to other academics in your discipline."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
                include 'tokens.inc';
                $mendeleyCounts = json_decode(file_get_contents("http://www.mendeley.com/oapi/documents/details/$pmid?type=pmid&consumer_key=$MendeleyConsumerKey"));
		$data = new ResourceData();
		$data->setCiteCount($mendeleyCounts->stats->readers);
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink("$mendeleyCounts->mendeley_url"); 
	     
		return $data;
	}
}

ResourceRegistry::register("Mendeley", new MendeleyResource());

?>
