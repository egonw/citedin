<?php
	require_once("ResourceRegistry.php");

class CosmicResource implements Resource {
	function getResourceName() { return "Cosmic: Catalogue Of Somatic Mutations In Cancer"; }
	function getInfoLink() { return "http://www.sanger.ac.uk/genetics/CGP/cosmic/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "All cancers arise as a result of the acquisition of a series of fixed DNA sequence abnormalities, mutations, many of which ultimately confer a growth advantage upon the cells in which they have occurred. There is a vast amount of information available in the published scientific literature about these changes. COSMIC is designed to store and display somatic mutation information and related details and contains information relating to human cancers."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from cosmic where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName($this->getResourceName())
			->setCiteCount($num_rows)
	      ->setInfoLink($this->getInfoLink())
			->setDetailsLink(''); //TODO: details link

		return $data;
	}
}

ResourceRegistry::register("Cosmic", new CosmicResource());

?>
