<?php
require_once("ResourceRegistry.php");

class WikipathwaysResource implements Resource {
	function getResourceName() { return "WikiPathways"; }
	function getInfoLink() { return "http://www.wikipathways.org"; }
	function getResourceType() { return "Wiki"; }
	function getResourceDescription() { return "In the new tradition of Wikipedia, WikiPathways is an open, public platform dedicated to the curation of biological pathways by and for the scientific community."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
		
		$client = new
		SoapClient('http://www.wikipathways.org/wpi/webservice/webservice.php?wsdl');
	    $results = $client->findPathwaysByLiterature(array('query'=>$pmid));
	   
		    $num_rows = count($results->result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink("resources/details_wikipathways?pmid=$pmid"); 

		return $data;
	}
}

ResourceRegistry::register("Wikipathways", new WikipathwaysResource());
  
?>
	

	
