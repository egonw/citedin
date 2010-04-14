<?php
require_once("ResourceRegistry.php");

class WikipathwaysResource implements Resource {
	function getResourceName() { return "WikiPathways"; }
	function getInfoLink() { return "http://www.wikipathways.org"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "In the new tradition of Wikipedia, WikiPathways is an open, public platform dedicated to the curation of biological pathways by and for the scientific community."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from wikipathways where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink('resources/details_wikipathways?pmid=$pmid'); 

		return $data;
	}
}

ResourceRegistry::register("Wikipathways", new WikipathwaysResource());
  
?>
