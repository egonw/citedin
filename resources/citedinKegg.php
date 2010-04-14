<?php
require_once("ResourceRegistry.php");

class KeggResource implements Resource {
	function getResourceName() { return "KEGG: Kyoto Encyclopedia of Genes and Genomes"; }
	function getInfoLink() { return "http://www.genome.jp/kegg/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return ""; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from kegg where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("Kegg", new KeggResource());

?>
