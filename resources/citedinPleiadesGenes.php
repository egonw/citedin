<?php
require_once("ResourceRegistry.php");

class PleiadesGenesResource implements Resource {
	function getResourceName() { return "Pleiades genes"; }
	function getInfoLink() { return "http://www.pleiades.org/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "Approved genes from the Pleiades project"; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from pleiades_genes where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("PleiadesGenes", new PleiadesGenesResource());

?>
