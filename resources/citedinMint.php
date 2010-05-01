<?php
require_once("ResourceRegistry.php");

class MintResource implements Resource {
	function getResourceName() { return "MINT: the Molecular INTeraction database"; }
	function getInfoLink() { return "http://mint.bio.uniroma2.it/mint/Welcome.do"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return ""; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from mint where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink("http://mint.bio.uniroma2.it/mint/search/publication.do?pmid=$pmid"); 

		return $data;
	}
}

ResourceRegistry::register("Mint", new MintResource());

?>
